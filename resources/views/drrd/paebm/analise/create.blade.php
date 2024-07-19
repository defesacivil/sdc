@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/pae/protocolo') }}">Protocolo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Análise</li>
        </ol>
    </nav>
@endsection

@section('content')

        <div class="col col-md-12">

            <div class="row">
                <div class="col p-3">
                    <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo') }}'>Voltar</a></p><br>
                    <legend>Análise PAEBM - Protocolo : {{ $protocolo[0]->num_protocolo }}</legend>
                    <p>Empreendedor: <b>{{ $protocolo[0]->empreendimento->empreendedor->nome }}</b></p>
                    <p>Empreendimento: <b>{{ $protocolo[0]->empreendimento->nome }}</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class='col-md-12'>

                {{ Form::open(['url' => 'pae/analise/store', 'method' => 'POST', 'files' => 'true']) }}
                {{ Form::token() }}

                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('Parecer', '' , ['class'=>'fw-bolder']) }}:
                        {{ Form::textarea('parecer', '', ['class' => 'ckeditor form form-control', 'value' => old('parecer'), 'id' => 'wysiwyg-editor']) }}
                        {{ Form::hidden('user_id', Auth::user()->id) }}
                        {{ Form::hidden('pae_protocolo_id', $protocolo[0]->id) }}
                    </div>
                </div>
                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('anexo', '', ['class'=>'fw-bolder']) }}:
                        {{ Form::file('anexo', ['class' => 'form form-control']) }}
                    </div>
                </div>
                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::label('obs', '', ['class'=>'fw-bolder']) }}:
                        {{ Form::textarea('obs', '', ['class' => 'form form-control', 'value' => old('obs'), 'rows' => '3']) }}
                    </div>
                </div>

                <div class='row p-2'>
                    <div class='col col-md-6'>
                        {{ Form::label('tipo', '', ['class'=>'fw-bolder']) }}:
                        {{ Form::select(
                            'tipo',
                            [
                                '' => 'Selecione o Tipo da Análise',
                                '1' => 'Analise 1',
                                '2' => 'Analise 2',
                                '3' => 'Analise 3',
                                '4' => 'Analise 4',
                            ],
                            '',
                            ['class' => 'form form-control form-select'],
                        ) }}
                    </div>
                
                    <div class='col col-md-6'>
                        {{ Form::label('situacao', '', ['class'=>'fw-bolder']) }}:
                        {{ Form::select(
                            'situacao',
                            [
                                '' => 'Selecione a Situação',
                                '1' => 'Aprovado',
                                '0' => 'Reprovado',
                                '2' => 'Em Regularização',
                            ],
                            '',
                            ['class' => 'form form-control form-select'],
                        ) }}
                    </div>
                </div>

                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>{{ Form::close() }}

                </div>
            </div>
    </div>

    
        @stop

        @section('css')
            <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
        @stop

        @section('js')


            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('.ckeditor').ckeditor();
                });
            </script>
            <script>
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "showDuration": "800",
                }
                @if (session('message'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "showDuration": "600",
                    }
                    toastr.success("{{ session('message') }}"); <
                    div class = "alert alert-success" >
                        {{ session('message') }} <
                        /div>
                @endif
                @if ($errors->any())

                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}")
                    @endforeach
                @endif
            </script>

            <script>
                /* autocomplete empreendimento  */
                var path3 = "{{ route('empreendimento.autocomplete') }}";
                $("#empnto_search").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: path3,
                            type: 'GET',
                            dataType: "json",
                            data: {
                                search: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        $('#empnto_search').val(ui.item.label);
                        $('#pae_empnto_id').val(ui.item.id);
                        return false;
                    }
                });
            </script>

        @stop
