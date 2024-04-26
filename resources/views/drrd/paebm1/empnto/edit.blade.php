@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empreendedor</li>
        </ol>
    </nav>
@endsection
<!-- conteudo -->
@section('content')

    <div class="row flex-fill">

        <div class="col-md-12">

            <div class="row">
                <div class="col p-3">
                    <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empnto') }}'>Voltar</a></p><br>
                    <legend>Edição Empreendimento</legend>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class='col-md-12'>

                {{ Form::open(['url' => 'pae/empnto/update', 'method' => 'POST']) }}
                {{ Form::token() }}

                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::hidden('id', $empnto->id) }}
                        {{ Form::label('nome', '') }}:
                        {{ Form::text('nome', $empnto->nome, ['class' => 'form form-control', 'value' => old('nome')]) }}
                    </div>
                </div>
                <div class='col'>
                    {{ Form::label('Empreendedor', '') }}:
                    {{ Form::text('empdor_search', $empnto->empreendedor->nome, ['class' => 'form form-control', 'id' => 'empdor_search']) }}
                    {{ Form::hidden('pae_empdor_id', $empnto->pae_empdor_id, ['id' => 'pae_empdor_id']) }}
                </div>
                <div class='row p-2'>
                    <div class="col">
                        {{ Form::label('Município', '') }}:
                        {{ Form::text('municipio_search', $empnto->municipio->nome, ['class' => 'typeahead form form-control', 'id' => 'municipio_search']) }}
                        {{ Form::hidden('municipio_id', $empnto->municipio_id, ['id' => 'municipio_id']) }}
                    </div>
                    <div class="col">
                        {{ Form::label('Regiao', '') }}:
                        {{ Form::text('regiao_search', $empnto->regiao->nome, ['class' => 'typeahead form form-control', 'id' => 'regiao_search']) }}
                        {{ Form::hidden('regiao_id', $empnto->regiao_id, ['id' => 'regiao_id']) }}
                    </div>
                </div>
                <div class="row p-2">
                    <div class='col'>
                        {{ Form::label('Metodo de Construção', '') }}:
                        {{ Form::select('m_construcao', $m_construcao, $empnto->m_construcao, ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>

                    <div class='col'>
                        {{ Form::label('Material da Barragem', '') }}:
                        {{ Form::select('material', $material, $empnto->material, ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>
                    <div class='col'>
                        {{ Form::label('Finalidade', '') }}:
                        {{ Form::select('finalidade', $finalidade, $empnto->finalidade, ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>
                </div>
                <div class="row p-2">
                    <div class='col'>
                        {{ Form::label('Volume', '') }}:
                        {{ Form::text('volume', $empnto->volume, ['class' => 'form form-control', 'value' => old('volume')]) }}
                    </div>
                    <div class="col">
                        {{ Form::label('População da ZAS', '') }}:
                        {{ Form::text('pop_zas', $empnto->pop_zas, ['class' => 'form form-control', 'value' => old('pop_zas')]) }}
                    </div>
                    <div class="col">
                        {{ Form::label('Orgão Fiscalizador', '') }}:
                        {{ Form::select('orgao_fisc', $orgao_fisc, $empnto->orgao_fisc, ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col">
                        {{ Form::label('Coordenador', '') }}:
                        {{ Form::text('coordenador', $empnto->coordenador, ['class' => 'form form-control', 'id' => 'coordenador']) }}
                        {{-- {{ Form::text('coordenador_search', $empnto->coordenador->nome, ['class' => 'typeahead form form-control', 'id' => 'coordenador_search']) }}
                        {{ Form::hidden('pae_coordenador_id', $empnto->pae_coordenador_id, ['id' => 'pae_coordenador_id']) }} --}}
                    </div>
                    <div class="col">
                        {{ Form::label('Tel Coordenador', '') }}:
                        {{-- {{ Form::text('coordenador_search', $empnto->coordenador->nome, ['class' => 'typeahead form form-control', 'id' => 'coordenador_search']) }}
                        {{ Form::hidden('pae_coordenador_id', $empnto->pae_coordenador_id, ['id' => 'pae_coordenador_id']) }} --}}
                         {{ Form::text('tel_coordenador', $empnto->tel_coordenador, ['class' => 'typeahead form form-control', 'id' => 'tel_coordenador']) }}
                    </div>
                </div>
                <div class='row p-2'>
                    <div class='col'>
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>{{ Form::close() }}

                </div>
            </div>
        </div>
    </div>


    @stop

        @section('css')
            <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
        @stop

        @section('code')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="{{ asset('vendor/inputmask/jquery.inputmask.js')}}"></script>

        <script>
            $("#tel_coordenador").inputmask('(99) 9999[9]-9999');

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
