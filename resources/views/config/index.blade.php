@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configurações</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div class="container p-3 border min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p>

                <p class="text-center"><legend>Configurações</legend></p>
                <br>
                <div class="row">
                    <div class="text-center col">
                        <a href="config/usuario" class=''><img width="120" src="{{ url('imagem/icon/users.png') }}" title="Usuários"></a><br>
                        Usuários
                    </div>
                    <div class="text-center col">
                        <a href="config/usuario" class=''><img width="120" src="{{ url('imagem/icon/config_user.png') }}" title="Configurações"></a><br>
                        Configurações
                    </div>
                    <div class="text-center col">
                        <a href="config/usuario" class=''><img width="120" src="{{ url('imagem/icon/report.png') }}" title="Relatórios Log's"></a>
                        <br>
                        Relatórios e Log's
                    </div>
                </div>
                <br>
                <br>

                <table class="table p-3">
                    <tr>
                        <td>app_path:</td><td>{{ app_path() }}</td>
                    </tr>
                    <tr>
                        <td>base_path:</td><td>{{ base_path() }}</td>
                    </tr>
                    <tr>
                        <td>config_path:</td><td>{{ config_path() }}</td>
                    </tr>
                    <tr>
                        <td>database_path:</td><td>{{ database_path() }}</td>
                    </tr>
                    <tr>
                        <td>public_path:</td><td>{{ public_path() }}</td>
                    </tr>
                    <tr>
                        <td>resource_path:</td><td>{{ resource_path() }}</td>
                    </tr>
                    <tr>
                        <td>storage_path:</td><td>{{ storage_path() }}</td>
                    </tr>
                </table>


            </div>

        </div>
    </div>
@stop

@section('css')
@stop

@section('code')


    <script type="text/javascript">
        $(document).ready(function() {



        })
    </script>

@endsection
