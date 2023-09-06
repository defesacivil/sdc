@extends('adminlte::page')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />-->


@stop

@section('content')

    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empdor') }}'>Voltar</a></p><br>
            <legend>Edição Empreendedor</legend>
        </div>
    </div>
        <div class="row">
            <div class="col-12">
                
            </div>
        </div>
        <div class='col-md-12'>

            {{ Form::open(['url' => 'pae/empdor/update', 'method' => 'POST']) }}
            {{ Form::token() }}

            <div class='row p-2'>
                <div class='col'>
                    {{ Form::hidden('id', $empdor->id) }}
                    {{ Form::label('nome', '') }}:
                    {{ Form::text('nome', $empdor->nome, ['class' => 'form form-control', 'value' => old('nome')]) }}
                </div>
            </div>
            <div class='row p-2'>
                <div class='col'>
                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                </div>{{ Form::close() }}

            </div>
        </div>
    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')

    <script>
        toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": "800",
                }
        @if (session('message'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true,
                    "showDuration": "600",
                }
  		        toastr.success("{{ session('message') }}");
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if ($errors->any())
                
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}")
                    @endforeach
               
            @endif

    </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <script>
            /* autocomplete regiao */
            var path1 = "{{ route('regiao.autocomplete') }}";
            $("#regiao_search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path1,
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
                    $('#regiao_search').val(ui.item.label);
                    $('#regiao_id').val(ui.item.id);
                    return false;
                }
            });


            /* autocomplete municipios */
            var path2 = "{{ route('municipio.autocomplete') }}";
            $("#municipio_search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path2,
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
                    $('#municipio_search').val(ui.item.label);
                    $('#municipio_id').val(ui.item.id);
                    return false;
                }
            });

            /* autocomplete empreendedor  */
            var path3 = "{{ route('empdor.autocomplete') }}";
            $("#empdor_search").autocomplete({
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
                    $('#empdor_search').val(ui.item.label);
                    $('#pae_empdor_id').val(ui.item.id);
                    return false;
                }
            });

            /* autocomplete coordenador  */
            var path4 = "{{ route('coordenador.autocomplete') }}";
            $("#coordenador_search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: path4,
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
                    $('#coordenador_search').val(ui.item.label);
                    $('#pae_coordenador_id').val(ui.item.id);
                    return false;
                }
            });
        </script>

    @stop
