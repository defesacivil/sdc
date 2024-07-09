@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            <li class="breadcrumb-item active" aria-current="page">Empreendimento</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row flex-fill">

        <div class="col-md-12">

            <div class="row">
                <div class="p-3 col">
                    @if (request()->has('voltar') == 'protocolo')
                        <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo/create') }}'>Voltar</a></p><br>
                    @else
                        <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empdor') }}'>Voltar</a></p><br>
                    @endif
                    <legend>Cadastro Empreendimento</legend>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class='col-md-12'>

                {{ Form::open(['url' => 'pae/empnto/store', 'method' => 'POST']) }}
                {{ Form::token() }}

                <div class='p-2 row'>
                    <div class='col'>
                        {{ Form::label('nome', 'Nome da Estrutura') }}:
                        {{ Form::text('nome', '', ['class' => 'form form-control', 'value' => old('nome')]) }}
                    </div>
                </div>
                <div class="row p-2">
                    <div class='col'>
                        {{ Form::label('Empreendedor', 'Empreendedor ( Digite parte do nome para fazer a Busca)') }}:
                        {{ Form::text('empdor_search', '', ['class' => 'form form-control', 'id' => 'empdor_search']) }}
                        {{ Form::hidden('pae_empdor_id', '', ['id' => 'pae_empdor_id']) }}
                    </div>
                </div>
                <div class='p-2 row'>
                    <div class="col">
                        {{ Form::label('Município', 'Município ( Digite parte do nome para fazer a busca)') }}:
                        {{ Form::text('municipio_search', '', ['class' => 'typeahead form form-control', 'id' => 'municipio_search']) }}
                        {{ Form::hidden('municipio_id', '', ['id' => 'municipio_id']) }}
                    </div>
                    <div class="col">
                        {{ Form::label('Regiao', '') }}:
                        {{ Form::text('regiao_search', '', ['class' => 'typeahead form form-control', 'id' => 'regiao_search']) }}
                        {{ Form::hidden('regiao_id', '', ['id' => 'regiao_id']) }}
                    </div>
                    <div class="col">
                        {{ Form::label('Nome da Mina', '') }}:
                        {{ Form::text('mina', '', ['class' => 'form form-control', 'id' => 'mina', 'maxlength' => 100]) }}
                    </div>
                </div>
                <div class="p-2 row">
                    <div class='col'>
                        {{ Form::label('Metodo de Construção', '') }}:
                        {{ Form::select('m_construcao', $m_construcao, '', ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>

                    <div class='col'>
                        {{ Form::label('Material da Barragem', '') }}:
                        {{ Form::select('material', $material, '', ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>
                    <div class='col'>
                        {{ Form::label('Finalidade', '') }}:
                        {{ Form::select('finalidade', $finalidade, '', ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>
                </div>
                <div class="p-2 row">
                    <div class='col'>
                        {{ Form::label('Volume³', '') }}:
                        {{ Form::text('volume', '', ['class' => 'form form-control', 'value' => old('volume')]) }}
                    </div>
                    <div class="col">
                        {{ Form::label('População da ZAS', '') }}:
                        {{ Form::text('pop_zas', '', ['class' => 'form form-control', 'value' => old('pop_zas')]) }}
                    </div>
                    <div class="col">
                        {{ Form::label('Orgão Fiscalizador', '') }}:
                        {{ Form::select('orgao_fisc', $orgao_fisc, '', ['placeholder' => 'Selecione a Opção', 'class' => 'form form-control']) }}
                    </div>
                </div>
                <div class="p-2 row">
                    <div class="col">
                        {{ Form::label('Nome Coordenador', '') }}:
                        {{ Form::text('coordenador', '', ['class' => 'form form-control', 'id' => 'coordenador', 'maxlength' => 100]) }}
                    </div>
                    <div class="col">
                        {{ Form::label('coordenador_sub', 'Coordenador Substituto', ['class' => 'font-italic text-secondary']) }}:
                        {{ Form::text('coordenador_sub', '', ['class' => 'form form-control', 'id' => 'coordenador_sub']) }}
                    </div>
                </div>

                <div class="p-2 row">
                    <div class="col">
                        {{ Form::label('Tel. Coordenador', '') }}:
                        {{ Form::text('tel_coordenador', '', ['class' => 'form form-control', 'id' => 'tel_coordenador']) }}
                    </div>
                    <div class="col">
                        {{ Form::label('tel_coordenador_sub', 'Tel Coordenador Substituto', ['class' => 'font-italic text-secondary']) }}:
                        {{ Form::text('tel_coordenador_sub', '', ['class' => 'form form-control', 'id' => 'tel_coordenador_sub']) }}
                    </div>
                </div>

                <div class="p-2 row">
                    <div class="col">
                        {{ Form::label('email_coord', 'Email do Coordenador') }}:
                        {{ Form::email('email_coord', '', ['class' => 'form form-control', 'id' => 'email_coord']) }}
                    </div>
                    <div class="col-6">
                        {{ Form::label('email_coord_sub', 'Email do Coordenador Substituto', ['class' => 'font-italic text-secondary']) }}:
                        {{ Form::email('email_coord_sub', '', ['class' => 'form form-control', 'id' => 'email_coord_sub']) }}
                    </div>
                    {{-- <div class="col">
                    {{ Form::label('Coordenador', '') }}:
                    {{ Form::text('coordenador_search', '', ['class' => 'typeahead form form-control', 'id' => 'coordenador_search']) }}
                    {{ Form::hidden('pae_coordenador_id', '', ['id' => 'pae_coordenador_id']) }}
                </div> --}}
                </div>
                <div class='p-2 row'>
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
    <script src="{{ asset('vendor/inputmask/jquery.inputmask.js') }}"></script>



    <script>
        $("#tel_coordenador").inputmask('(99) 9999[9]-9999');
        $("#tel_coordenador_sub").inputmask('(99) 9999[9]-9999');
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
            {{ session('message') }}
                <
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
                        if (!data.length) {
                            var result = [{
                                label: "Empreendedor não encontrado, clique aqui para cadastrar !",
                                value: "{{ url('pae/empdor/create') }}"
                            }];
                            response(result);
                        } else {
                            response(data);
                        }
                    }
                });
            },
            select: function(event, ui) {
                if (ui.item.label === "Empreendedor não encontrado, clique aqui para cadastrar !") {
                    var result = confirm('deseja cadastrar um Empreendedor ?');
                    if (result) {
                        window.location.href = ui.item.value + "?voltar=empnto";
                    }
                } else {
                    $('#empdor_search').val(ui.item.label);
                    $('#pae_empdor_id').val(ui.item.id);
                }
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
