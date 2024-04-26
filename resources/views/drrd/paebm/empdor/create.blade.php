@extends('layouts.pagina_master')

{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro Empreendedor</li>
        </ol>
    </nav>
@endsection

<!-- conteudo -->
@section('content')

    <!-- validadação -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li class='error'>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="row flex-fill">

        <div class="col-md-12">


            <div class="row">
                <div class="p-3 col">
                    @if (request()->has('voltar') == 'empnto')
                        <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empnto/create') }}'>Voltar</a></p><br>
                    @else
                        <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empdor') }}'>Voltar</a></p><br>
                    @endif
                    <legend>Cadastro Empreendedor</legend>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <div class='col-md-6'>

                {{ Form::open(['url' => 'pae/empdor/store', 'method' => 'POST']) }}
                {{ Form::token() }}

                <div class='p-2 row'>
                    <div class='col'>
                        {{ Form::label('nome', '') }}:
                        {{ Form::text('nome', '', ['class' => 'form form-control form-control-sm', 'value' => old('nome')]) }}
                    </div>
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

@section('js')


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
