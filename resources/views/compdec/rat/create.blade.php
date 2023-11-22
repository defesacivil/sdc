@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <style>
        .capitalise {
            text-transform: capitalize;
        }
    </style>

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
    <div class="p-2 text-center">
        <p class=''><a class='btn btn-success btn-sm' href='{{ url('rat') }}'>Voltar</a></p>
    </div>
    <div class="container p-2 border">
        <div class="">

            <legend>RELATÓRIO DE ATIVIDADES DE DEFESA CIVIL</legend>
            <br>
            <div class="p-2 row">
                <div class="text-left col-md-6">
                    <h4 class=""> Número : {{ $numero . ' / ' . date('Y') }}</h4>
                </div>
                <div class="text-left col-md-6">
                    <h5>Operador : @if (isset(Session::get('user')['usuario']->nome))
                            {{ Session::get('user')['usuario']->nome }}
                        @elseif (isset(Session::get('user')['municipio']))
                            {{ Session::get('user')['municipio'] }}
                        @endif

                    </h5>

                </div>


                {{ Form::open(['url' => 'rat/store', 'id' => 'form_rat']) }}
                {{ Form::token() }}

            </div>
            <div class="col-md-12 bg-light">
                <fieldset class="p-2 border">
                    <legend class="w-auto">Data/Município</legend>

                    <div class="p-2 col-3">
                        {{ Form::label('dt_ocorrencia', 'Data da Ocorrência') }}:
                        {{ Form::input('dateTime-local', 'dt_ocorrencia', '', ['class' => 'form form-control', 'value' => old('dt_ocorrencia'), 'id' => 'dt_ocorrencia']) }}
                        {{ Form::hidden('operador_id', Auth::user()->id, ['class' => '', 'value' => old('dt_ocorrencia'), 'id' => 'operador_id']) }}
                        {{ Form::hidden('num_ocorrencia', $numero, ['class' => '', 'id' => 'num_ocorrencia']) }}
                    </div>

                    <div class="p-2 col-md-12">
                        {{ Form::label('municipio_id', 'Nome do Município') }}:
                        {{ Form::select('municipio_id', $optionMunicipio, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'municipio_id', 'placeholder' => 'Nome do Município', 'data-municipio_id' => '']) }}
                    </div>
                </fieldset>
                <br>
                <fieldset class="p-2 border">
                    <legend class="w-auto">Natureza</legend>

                    <div class="row">
                        <div class="p-3 col-md-6">
                            {{ Form::label('ocorrencia_id', 'Código Ocorrência') }}:
                            {{ Form::select('ocorrencia_id', $optionOcorrencia, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'ocorrencia_id', 'placeholder' => 'Código da Ocorrência', 'data-ocorrencia_id' => '']) }}
                        </div>

                        <div class="p-3 col-md-6">
                            {{ Form::label('alvo_id', 'Alvo do Evento') }}:
                            {{ Form::select('alvo_id', $ratAlvo, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'alvo_id', 'placeholder' => 'Alvo da Ocorrencia', 'data-alvo_id' => '']) }}
                        </div>

                        <div class="p-3 col-md-6">
                            {{ Form::label('cobrade_id', 'Código Cobrade') }}:
                            {{ Form::select('cobrade_id', $optionCobrade, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'cobrade_id', 'placeholder' => 'Código Brasileiro de Desastre', 'data-cobrade_id' => '']) }}
                        </div>

                        <div class="p-3 col-md-6">
                            {{ Form::label('nome_operacao', 'Nome da Operação') }}:
                            {{ Form::text('nome_operacao', '', ['class' => 'form form-control', 'id' => 'nome_operacao', 'placeholder' => 'Nome da Operação', 'maxlength' => '110']) }}
                        </div>

                        <div class="p-3 col-md-12">
                            {{ Form::label('envolvidos', 'Envolvidos (Opcional - pessoas, empresas, etc)') }}:
                            {{ Form::textarea('envolvidos', '', ['class' => 'form form-control', 'id' => 'envolvidos', 'placeholder' => 'Envolvidos (Opcional - Pessoas, Empresas, Etc.)', 'rows' => '4', 'maxlength' => '255']) }}
                        </div>

                    </div>
                </fieldset>

                <br>
                <fieldset class="p-2 border">
                    <legend class="w-auto">Local</legend>
                    <div class="row">
                        <div class="p-3 col-md-3">
                            {{ Form::label('cep', 'Cep') }}:
                            {{ Form::text('cep', '', ['class' => 'form form-control', 'id' => 'cep', 'placeholder' => 'Cep', 'maxlength' => '10']) }}
                        </div>
                        <div class="p-3 col-md-8">
                            {{ Form::label('endereco', 'Endereço da Ocorrência') }}:
                            {{ Form::text('endereco', '', ['class' => 'form form-control', 'id' => 'endereco', 'placeholder' => 'Endereço da Ocorrência', 'maxlength' => '100']) }}
                        </div>
                        <div class="p-3 col-md-2">
                            {{ Form::label('numero', 'Número') }}:
                            {{ Form::text('numero', '', ['class' => 'form form-control', 'id' => 'numero', 'placeholder' => 'Número', 'maxlength' => '10']) }}
                        </div>
                        <div class="p-3 col-md-5">
                            {{ Form::label('bairro', 'Bairro') }}:
                            {{ Form::text('bairro', '', ['class' => 'form form-control', 'id' => 'bairro', 'placeholder' => 'Bairro', 'maxlength' => '50']) }}
                        </div>
                        <div class="p-3 col-md-5">
                            {{ Form::label('estado', 'Estado') }}:
                            {{ Form::text('estado', '', ['class' => 'form form-control', 'id' => 'estado', 'placeholder' => 'Estado', 'maxlength' => '20']) }}
                        </div>

                        <div class="p-3 col-md-12">
                            {{ Form::label('referencia', 'Ponto de Referência') }}:
                            {{ Form::text('referencia', '', ['class' => 'form form-control', 'id' => 'referencia', 'placeholder' => 'Ponto de Referência', 'maxlength' => '100']) }}
                        </div>
                    </div>
                </fieldset>

                <div class="p-3 row">
                    <div class="p-2 col h-100">
                        {{ Form::label('acoes', 'Histórico da Ocorrência') }}: ( <span>Caracteres Restantes: </span> <span id='caracteres'>0</span> )
                        {{ Form::textarea('acoes', '', ['class' => 'form form-control', 'id' => 'acoes', 'maxlength' => '15000']) }}
                    </div>
                </div>

                <div class="p-3 row">
                    <div class="p-2 col-md-12">
                        <label>Upload de Imagens</label>
                        <input type="file"
                            class="filepond img_rat"
                            name="filepond[]"
                            multiple
                            data-allow-reorder="true"
                            data-max-file-size="3MB"
                            data-max-files="4">
                    </div>
                </div>
                <br>

                {{ Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'btnEditar']) }}
                {{ Form::close() }}



            </div>
        </div>




    @stop
    @section('css')


    @stop
    @section('code')

        <link href="{{ asset('vendor/select2/dist/css/select2.css') }}" rel="stylesheet" />
        <script src="{{ asset('vendor/select2/dist/js/select2.full.js') }}"></script>
        
        <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.css') }}" />
        <script src="{{ asset('summernote/summernote-bs4.js') }}"></script>

        <!-- For Bootstrap 3 -->
        {{-- <link rel="stylesheet" href="{{ asset('summernote/summernote.css') }}" />
    <script src="{{ asset('summernote/summernote.js') }}'"></script> --}}

        <!-- Without any framework -->
        <link rel="stylesheet" href="{{ asset('summernote/summernote-lite.css') }}" />
        <script src="{{ asset('summernote/summernote-lite.js') }}"></script>



        <script type="text/javascript">
            $(document).ready(function() {


                $("#btnEditar").hover(function() {

                });

                // $("#cep1").blur(function() {
                //     var cep = '31870440';
                //     $.ajax({
                //         url: 'http://h-apigateway.conectagov.estaleiro.serpro.gov.br/api-cep/v1/consulta/cep/' + cep,
                //         type: 'GET',
                //         dataType: 'JSON',
                //         contentType: false,
                //         cache: false,
                //         processData: false,
                //     }).done(function(data) {
                //         console.log(data);
                //     });



                // });


                // Turn input element into a pond with configuration options
                $('.img_rat').filepond({
                    allowMultiple: true,
                    maxFiles: '4',
                    locale: 'pt_BR',
                    maxParallelUploads: '2',
                    credits: 'CEDEC-MG',
                    labelIdle: 'Para Adicionar, Arraste o arquivo e solte aqui ou <span class="filepond--label-action"> Clique Aqui </span>',
                });

                // Set allowMultiple property to true
                //$('.my-pond').filepond('allowMultiple', true);

                // Listen for addfile event
                // $('.my-pond').on('FilePond:addfile', function(e) {
                //     console.log('file added event', e);
                // });

                // Manually add a file using the addfile method
                // $('.my-pond')
                //     .filepond('addFile', 'index.html')
                //     .then(function(file) {
                //         console.log('file added', file);
                //     });

                $("#form_rat").on('submit', function(e) {

                    var formdata = new FormData(this);

                    var pondFiles = $('.img_rat').filepond('getFiles');

                    for (var i = 0; i < pondFiles.length; i++) {
                        // append the blob file
                        formdata.append('file[]', pondFiles[i].file);
                    }

                    $.ajax({
                        url: '{{ url('rat/store') }}',
                        type: 'POST',
                        data: formdata,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data.error) {
                                Object.values(data.error).forEach((x) => {
                                    toastr.error(x);
                                });
                            } else {
                                window.location.href = data.view;
                                
                            }
                        },
                        error: function(data) {
                            console.log(data + "erro");
                        }
                    });

                    e.preventDefault();
                });

                $('.js-example-basic-single').select2();
                
                $('input.select2-search__field').focus();

                // $("#acoes").keyup(function() {
                //     alert();
                //     var leng = $("#acoes").text();
                //     $("#caracteres").text(leng);
                // });


                function registerSummernote(element, placeholder, max, callbackMax) {
                    $(element).summernote({
                        height: 400,
                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']]
                        ],
                        placeholder,
                        callbacks: {
                            onKeydown: function(e) {
                                var t = e.currentTarget.innerText;
                                if (t.length >= max) {
                                    //delete key
                                    if (e.keyCode != 8)
                                        e.preventDefault();
                                    // add other keys ...
                                }
                            },
                            onKeyup: function(e) {
                                var t = e.currentTarget.innerText;
                                if (typeof callbackMax == 'function') {
                                    callbackMax(max - t.length);
                                }
                            },
                            onPaste: function(e) {
                                var t = e.currentTarget.innerText;
                                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                                e.preventDefault();
                                var all = t + bufferText;
                                document.execCommand('insertText', false, all.trim().substring(0, 15000));
                                if (typeof callbackMax == 'function') {
                                    callbackMax(max - t.length);
                                }
                            }
                        }
                    });
                }

                $(function() {
                    registerSummernote('#acoes', 'Digite o Histórico da Ocorrência', 15000, function(max) {
                        $('#caracteres').text(max)
                    });
                });

            
                $("#cep").inputmask('99999-999');
            })
        </script>
    @endsection
