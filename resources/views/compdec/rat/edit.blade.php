@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('rat') }}">Rat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Registro</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="text-center p-2">
        <p class=''><a class='btn btn-success btn-sm' href='{{ url('rat') }}'>Voltar</a></p>
    </div>
    <div class="container border p-2">
        <div class="text-center">

            <legend>RELATÓRIO DE ATIVIDADES DE DEFESA CIVIL</legend>
            <br>
            <div class="row p-2">
                <div class="col-md-6  text-left">
                    <h4 class=""> Número : {{ $rat->num_ocorrencia . ' / ' . \Carbon\Carbon::parse($rat->dt_ocorrencia)->year }}</h4>
                </div>
                <div class="col-md-6 text-left">
                    <h5>Operador : {{ $rat->operador->name }}</h5>
                </div>
            </div>


            {{ Form::open(['url' => 'rat/update', 'files' => true]) }}
            {{ Form::token() }}

        </div>
        <div class="col-md-12">


            <div class="col-3 p-3">
                {{ Form::label('dt_ocorrencia', 'Data da Ocorrência') }}:
                {{ Form::input('dateTime-local', 'dt_ocorrencia', $rat->dt_ocorrencia, ['class' => 'form form-control', 'value' => old('dt_ocorrencia'), 'id' => 'dt_ocorrencia']) }}
                {{ Form::hidden('operador_id', Auth::user()->id, ['class' => '', 'value' => old('dt_ocorrencia'), 'id' => 'operador_id']) }}
            </div>

            <div class="col-md-12 p-3">
                {{ Form::label('municipio_id', 'Nome do Município') }}:
                {{ Form::select('municipio_id', $optionMunicipio, $rat->municipio_id, ['class' => 'js-example-basic-single form form-control', 'id' => 'municipio_id', 'placeholder' => 'Nome do Município', 'data-municipio_id' => '']) }}
            </div>

            <h5> Natureza</h5>

            <div class="row">
                <div class="col-md-6 p-3">
                    {{ Form::label('ocorrencia_id', 'Código Ocorrência') }}:
                    {{ Form::select('ocorrencia_id', $optionOcorrencia, $rat->ocorrencia_id, ['class' => 'js-example-basic-single form form-control', 'id' => 'ocorrencia_id', 'placeholder' => 'Código da Ocorrência', 'data-ocorrencia_id' => '']) }}
                </div>

                <div class="col-md-6 p-3">
                    {{ Form::label('alvo_id', 'Alvo do Evento') }}:
                    {{ Form::select('alvo_id', $ratAlvo, $rat->alvo_id, ['class' => 'js-example-basic-single form form-control', 'id' => 'alvo_id', 'placeholder' => 'Alvo da Ocorrencia', 'data-alvo_id' => '']) }}
                </div>

                <div class="col-md-6 p-3">
                    {{ Form::label('cobrade_id', 'Código Cobrade') }}:
                    {{ Form::select('cobrade_id', $optionCobrade, $rat->cobrade_id, ['class' => 'js-example-basic-single form form-control', 'id' => 'cobrade_id', 'placeholder' => 'Código Brasileiro de Desastre', 'data-cobrade_id' => '']) }}
                </div>
                <div class="col-md-12 p-3">
                    {{ Form::label('envolvidos', 'Envolvidos (Opcional - pessoas, empresas, etc)') }}:
                    {{ Form::textarea('envolvidos', $rat->envolvidos, ['class' => 'form form-control', 'id' => 'envolvidos', 'placeholder' => 'Envolvidos (Opcional - Pessoas, Empresas, Etc.)', 'rows' => '4', 'maxlength' => '255']) }}
                </div>

                <div class="col-md-12 p-3">
                    {{ Form::label('nome_operacao', 'Nome da Operação') }}:
                    {{ Form::text('nome_operacao', $rat->nome_operacao, ['class' => 'form form-control', 'id' => 'nome_operacao', 'placeholder' => 'Nome da Operação', 'maxlength' => '110']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 p-3">
                    {{ Form::label('cep', 'Cep') }}:
                    {{ Form::text('cep', $rat->cep, ['class' => 'form form-control', 'id' => 'cep', 'placeholder' => 'Cep', 'maxlength' => '10']) }}
                </div>
                <div class="col-md-12 p-3">
                    {{ Form::label('endereco', 'Endereço da Ocorrência') }}:
                    {{ Form::text('endereco', $rat->endereco, ['class' => 'form form-control', 'id' => 'endereco', 'placeholder' => 'Endereço da Ocorrência', 'maxlength' => '100']) }}
                </div>
                <div class="col-md-2 p-3">
                    {{ Form::label('numero', 'Número') }}:
                    {{ Form::text('numero', $rat->numero, ['class' => 'form form-control', 'id' => 'numero', 'placeholder' => 'Número', 'maxlength' => '10']) }}
                </div>
                <div class="col-md-5 p-3">
                    {{ Form::label('bairro', 'Bairro') }}:
                    {{ Form::text('bairro', $rat->bairro, ['class' => 'form form-control', 'id' => 'bairro', 'placeholder' => 'Bairro', 'maxlength' => '50']) }}
                </div>
                <div class="col-md-5 p-3">
                    {{ Form::label('estado', 'Estado') }}:
                    {{ Form::text('estado', $rat->estado, ['class' => 'form form-control', 'id' => 'estado', 'placeholder' => 'Estado', 'maxlength' => '20']) }}
                </div>

                <div class="col-md-12 p-3">
                    {{ Form::label('referencia', 'Ponto de Referência') }}:
                    {{ Form::text('referencia', $rat->referencia, ['class' => 'form form-control', 'id' => 'referencia', 'placeholder' => 'Ponto de Referência', 'maxlength' => '100']) }}
                </div>
            </div>

            <div class="row p-3">
                <div class="p-2 col h-100">
                    {{ Form::label('acoes', 'Histórico da Ocorrência') }}: ( <span>Caracteres Restantes: </span> <span id='caracteres'>0</span> )
                    {{ Form::textarea('acoes', $rat->acoes, ['class' => 'form form-control', 'id' => 'acoes', 'maxlength' => '15000']) }}
                </div>
            </div>

            <div class="row p-3 border">
                @if ($files)
                    <legend> Imagens </legend>
                    @foreach ($files as $file)
                        <div class="col-md-6 text-center border p-2">
                            <img class="w-100" src="{{ asset('storage/rat_uploads/' . $rat->id . '/' . basename($file)) }}">
                            <p class="text-center p-1"><button class="btn btn-danger btn-sm btnRemove" data-file="{{ $file }}" type="button">Remover</button></p>
                        </div>
                    @endForeach
                @endif
            </div>
            <br>
            <div class="row p-3 border">
                <div class="col-md-12">
                    <input type="file"
                        class="filepond my-pond"
                        name="filepond[]"
                        id="filepond"
                        multiple
                        data-allow-reorder="true"
                        data-max-file-size="3MB"
                        data-max-files="{{ 4 - $total_rat_files }}">
                </div>
            </div>
            <div class="row p-3 borderr">
                <div class="col-md-12 text-center">
                    {{ Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'btnEditar']) }}
                    {{ Form::close() }}
                    <div class="col-md-12">

                    </div>
                </div>
            </div>


        @stop

        @section('css')

        @stop

        @section('code')

            <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
            <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>


            <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.css') }}" />
            <script src="{{ asset('summernote/summernote-bs4.js') }}"></script>

            <!-- For Bootstrap 3 -->
            {{-- <link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}" />
    <script src="{{ asset('summernote/summernote.js') }}'"></script> --}}

            <!-- Without any framework -->
            <link rel="stylesheet" href="{{ asset('summernote/summernote-lite.css') }}" />
            <script src="{{ asset('summernote/summernote-lite.js') }}"></script>

            <script src="{{ asset('vendor/filePond/filepond.min.js') }}"></script>
            <script src="{{ asset('vendor/filePond/filepond.jquery.js') }}"></script>
            <link href="{{ asset('vendor/filePond/filepond.css') }}" rel="stylesheet" />
            <link href="{{ asset('vendor/filePond/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />
            <script src="{{ asset('vendor/filePond/filepond-plugin-image-preview.min.js') }}"></script>
            <script src="{{ asset('vendor/filePond/filepond-plugin-file-validate-size.min.js') }}"></script>

            <script type='modulo' src="{{ asset('vendor/filePond/locale/pt-br.js') }}"></script>

            <script type="text/javascript">
                $(document).ready(function() {

                    $('#caracteres').text($('#acoes').val().length);

                    $('#acoes').summernote({
                        height: 400,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['para', ['ul', 'ol', 'paragraph']],
                        ]
                    });

                    $('#acoes').keyup(function() {
                        var qtd = $(this).val().length;
                        $('#caracteres').text(14800 - qtd);
                        //console.log(qtd);
                        if (qtd > 14800) {
                            swal.fire('Prezado operador, \n você atingiu o número máximo de caracteres do campo Histórico da Ocorrência !');
                        }
                    });


                    /* delete */
                    $(".btnRemove").click(function(e) {

                        var formdata = new FormData();

                        var file = $(this).data('file');
                        var id = '{{ $rat->id }}';

                        formdata.append('file', file);
                        formdata.append('id', id);
                        formdata.append('_token', "{{ csrf_token() }}");

                        var url = '{{ url('rat/deleteImagem') }}';

                        var confirm_delete = confirm('Deseja realmente apagar esta imagem ?');

                        if (confirm_delete) {

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: formdata,
                                dataType: 'JSON',
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    //console.log(data);
                                    window.location.href = "{{ url('rat/edit/' . $rat->id) }}";
                                },
                                error: function(data) {
                                    console.log(data + "erro");
                                }
                            });
                            e.preventDefault();
                        }

                    });

                    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
                    //$.fn.filepond.registerPlugin(FilePondPluginImageValidateSize);
                    $.fn.filepond.registerPlugin(FilePondPluginFileValidateSize);

                    $.fn.filepond.setDefaults({
                        maxFileSize: '3MB',
                    });

                    // Turn input element into a pond with configuration options
                    $('.my-pond').filepond({
                        allowMultiple: true,
                        maxFiles: {{ 4 - $total_rat_files }},
                        locale: 'pt_BR',
                        maxParallelUploads: '2',
                        credits: 'CEDEC-MG',
                        labelIdle: 'Para Adicionar, Arraste o arquivo e solte aqui ou <span class="filepond--label-action"> Clique Aqui </span>',
                    });

                    $("form").on('submit', function(e) {

                        var formdata = new FormData(this);

                        var pondFiles = $('.my-pond').filepond('getFiles');

                        //formdata.append('pondFiles', pondFiles);

                        for (var i = 0; i < pondFiles.length; i++) {
                            // append the blob file
                            formdata.append('file[]', pondFiles[i].file);
                        }

                        $.ajax({
                            url: '{{ url('rat/update/' . $rat->id) }}',
                            type: 'POST',
                            data: formdata,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                        }).done(function(data) {
                            if (data.error) {
                                Object.entries(data.error).forEach((x) => {
                                    toastr.error(x[1]);
                                    $("#" + x[0]).addClass('is-invalid');
                                    $("#" + x[0]).parent().append('<div class="invalid-feedback">'+x[1]+'</div>');
                                });
                            } else {
                                window.location.href = data.view;
                            }
                        });

                        e.preventDefault();
                    });

                    $('.js-example-basic-single').select2();


                    $("#cep").inputmask('99999-999');

                })
            </script>
        @endsection
