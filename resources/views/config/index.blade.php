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

    <div class="container border rounded min-vh-100" style="background-color:#e9ecef;">
        <div class="row">

            <div class="col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p>

                <p class="text-center"><legend>Configurações</legend></p>
                <br>


                <div class="row">
                    
                    <div class="text-center col col-md-3">
                        <a href="config/usuario" class=''><img width="100" src="{{ asset('imagem/icon/config_user.png') }}" title="Configurações de Usuários"></a><br>
                        Configurações de Usuários
                    </div>

                    <div class="text-center col col-md-3">
                        <a href="log-viewer" class=''><img width="100" src="{{ asset('imagem/icon/report.png') }}" title="Relatórios Log's"></a>
                        <br>
                        Relatórios e Log's
                    </div>


                    {{-- Limpeza de Cache --}}
                    <div class="col col-md-3 text-center">
                        <a href="config/index" class="" title="Manutenção"><img width="100" src="{{ asset('imagem/icon/clean.png') }}" title="Manutenção do Cache"></a>
                        <br>
                        Cache
                    </div>

                    <hr>

                    <div class="col col-md-3 text-center">
                        <a href="msg" class="" title="Msg Alert"><img width="100" src="{{ asset('imagem/icon/mensagem.png') }}" title="Mensagens Alerta do sistema /Usuários"></a>
                        <br>
                        Mensagens / Alertas Padrão
                    </div>

                    <div class="col col-md-3 text-center">
                        <a href="config/info" class="" title="Msg Alert"><img width="100" src="{{ asset('imagem/icon/info.png') }}" title="Mensagens"></a>
                        <br>
                        Informações
                    </div>

                    <div class="col col-md-3 text-center">
                        <a href="config/view_field" class="" title="Msg Alert"><img width="100" src="{{ asset('imagem/icon/db.png') }}" title="Lista DB"></a>
                        <br>
                        Campos Tabela BD
                    </div>

                    <div class="col col-md-3 text-center">
                        <a href="docs/api" class="" title="Msg Alert"><img width="100" src="{{ asset('imagem/icon/doc.png') }}" title="Documentação API"></a>
                        <br>
                        Documentação API
                    </div>
                </div>
                <br>
                <br>

                {{ Carbon\Carbon::now() }}

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
