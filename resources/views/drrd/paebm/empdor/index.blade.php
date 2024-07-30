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


    <div class="row p-3">

        <div class="row">
            <div class="col text-center">
                <a class="btn btn-success btn-sm" href="{{ url('drrd') }}">Voltar</a>
            </div>
        </div>

        <div class="col-md-12">

            <!-- menu opções - novo | pesquisa |voltar-->
            <div class="row">
                <div class="col p-3">
                    <ul class="nav">
                        <li class="nav-item mr-1">
                            <a class="btn btn-primary btn-sm" href="{{ url('pae/empdor/create') }}" title="Inserir novo Registro">+ Novo Registro</a>
                        </li>
                        <li class="nav-item mr-1">
                            <a class="btn btn-warning btn-sm" id="btn_search">Pesquisar</a>
                        </li>
                        <li class="nav-item mr-1">
                            <a class="btn btn-secondary btn-sm" href="{{ url('pae/empdor/export') }}" title="Inserir novo Registro">* Exportar Excel</a>
                        </li>
                        <li class="nav-item mr-1">

                        </li>
                    </ul>

                </div>
            </div>
            <div class="row" id="div_search">
                <div class="col col-md-6">
                    <label for="serach">Busca:</label>
                    {{ Form::open(['url' => 'pae/empdor', 'method' => 'POST']) }}
                    {{ Form::token() }}
                    <div class="input-group mb-3">
                        {{ Form::text('search', '', ['class' => 'form form-control  form-control-sm col-md-3']) }}
                        <div class="input-group-append">
                            {{ Form::submit('Pesquisa', ['class' => 'btn btn-outline-secondary btn-sm']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">

                    <p class='text-right'>Total Registros : {{ $empdors->total() }}</p>
                    <table class="table table-bordered table-condensed table-sm">
                        <tr>
                            <th class="col-1 bg-secondary">CÓDIGO</th>
                            <th class="col-9 bg-secondary">EMPREENDEDOR</th>
                            <th class="col-2 bg-secondary">AÇÕES</th>
                        </tr>

                        @foreach ($empdors as $key => $empdor)
                            <tr>
                                <td>{{ $empdor->id }}</td>
                                <td>{{ $empdor->nome }}</td>

                                <td>
                                    <a href='{{ url('pae/empdor/edit/' . $empdor->id) }}'><img src='{{ asset('imagem/icon/editar.png') }}'></a>
                                    <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='#'><img src='{{ asset('imagem/icon/delete.png') }}'></a>
                                    <a href='{{ url('pae/empdor/show/' . $empdor->id) }}'><img src='{{ asset('imagem/icon/view.png') }}'></a>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" class='text-center'>
                                {{ $empdors->links() }}

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script text="javascript/text">
        $(document).ready(function() {

            $("#div_search").hide();

            $("#btn_search").click(function() {
                $("#div_search").toggle();
            });
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
            {{ session('message') }} < /div>
        @endif
        @if ($errors->any())

            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
@stop
