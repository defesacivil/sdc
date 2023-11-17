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

    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p>

                <p class="text-center"><legend>Configurações</legend></p>
                <br>
                <div class="row">
                    <div class="col text-center">
                        <a href="config/usuario" class=''><img width="120" src="{{ url('imagem/icon/users.png') }}" title="Usuários"></a><br>
                        Usuários
                    </div>
                    <div class="col text-center">
                        <a href="config/usuario" class=''><img width="120" src="{{ url('imagem/icon/config_user.png') }}" title="Configurações"></a><br>
                        Configurações
                    </div>
                    <div class="col text-center">
                        <a href="config/usuario" class=''><img width="120" src="{{ url('imagem/icon/report.png') }}" title="Relatórios Log's"></a>
                        <br>
                        Relatórios e Log's
                    </div>
                </div>
                <br>
                <br>



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
