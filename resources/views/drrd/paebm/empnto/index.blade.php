@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('cedec', 'redec')
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            @endcan()
            <li class="breadcrumb-item active" aria-current="page">Empreendedor</li>
        </ol>
    </nav>
@endsection
<!-- conteudo -->
@section('content')


    <div class="row flex-fill">

        <div class="col-md-12">

            <div class="row">
                <div class="col">
                    <p class='p-3 text-center'><a class='btn btn-success' href='{{ url('drrd') }}'>Voltar</a></p>
                    <p class="text-center">
                        <legend>Cadastro Empreendimento</legend>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="serach">Busca:</label>
                    {{ Form::open(['url' => 'pae/empnto', 'method' => 'POST']) }}
                    {{ Form::token() }}
                    <div class="mb-3 input-group">
                        {{ Form::text('search', '', ['class' => 'form form-control col-md-3']) }}
                        <div class="input-group-append">
                            {{ Form::submit('Pesquisa', ['class' => 'btn btn-outline-secondary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- BUTTON NOVO REGISTRO -->

                    @can('cedec')
                    <p class=""><a class="btn btn-primary" href="{{ url('pae/empnto/create') }}" title="Inserir novo Registro">+ Novo Registro</a></p>
                    @endcan()
                    <p class='text-right'>Total Registros : {{ $empntos->total() }}</p>
                    <table class="table table-bordered table-condensed">
                        <tr>
                            <th>#</th>
                            <th>EMPREENDIMENTO</th>
                            <th>MUNICÍPIO</th>
                            <th>EMPREENDEDOR</th>
                            <th>MATERIAL</th>
                            <th>VOLUME</th>
                            <th>ÚLTIMA AT.</th>
                            <th>AÇÕES</th>
                        </tr>
                        @foreach ($empntos as $key => $empnto)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $empnto->nome }}</td>
                                <td>{{ $empnto->municipio->nome }}</td>
                                <td>{{ $empnto->empreendedor->nome }}</td>
                                <td>{{ $empnto->material }}</td>
                                <td>{{ $empnto->volume }}</td>
                                <td>{{ $empnto->user_update }}</td>
                                <td>
                                    @can('cedec')
                                    <a href='{{ url('pae/empnto/edit/' . $empnto->id) }}'><img
                                            src='{{ asset('imagem/icon/editar.png') }}'></a>
                                    <a onclick="return confirm('Deseja realmente apagar esse Registro !')"
                                        href='#'><img src='{{ asset('imagem/icon/delete.png') }}'></a>
                                    @endcan()
                                    <a href='{{ url('pae/empnto/show/' . $empnto->id) }}'><img
                                            src='{{ asset('imagem/icon/view.png') }}'></a>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" class='text-center'>
                                {{ $empntos->links() }}

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col"></div>
            </div>




        </div>
    </div>

    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')

    <script text="javascript/text">

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
                    {{ session('message') }} </div>
            @endif
            @if ($errors->any())
    
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}")
                @endforeach
            @endif
        </script>
    @stop

