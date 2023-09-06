@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
    </nav>

@endsection

@section('content')
    <div class="row flex-fill">


        <div class="col-md-3"></div>
        <div class="col-md-6">

            <p style='text-align:center' class="pt-5"><a class='btn btn-success btn-sm' href={{ url('config') }}>Voltar</a></p>
            <br>

            <div class="row">
                <br>
                <div class="col text-center">
                    <div class="card text-center">
                        <div class="card-body">
                            <a href="{{ url('usuario') }}">
                                <img class="" src="{{ asset('imagem/icon/user_icon.png') }}" width="100" height="100" title="Cadastro de Usuários">
                            <br>
                            Cadastro Usuário</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card text-center">
                        <div class="card-body">
                            <a href="{{ url('role') }}" class="">
                                <img class="" src="{{ asset('imagem/icon/perfil.png') }}" width="100" height="100" title='Cadastrar Perfis'>
                            <br>
                            Perfil</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card text-center">
                        <div class="card-body">
                            <a href="{{ url('permissao') }}" class="">
                                <img class="" src="{{ asset('imagem/icon/permissao.png') }}" width="100" height="100" title='Cadastrar as Permissoes'>
                            <br>
                            Permissões</a>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card text-center">
                        <div class="card-body">
                            <a href="{{ url('role_user') }}" class="" title='Relacionamento Perfil Usuario'>
                                <img class="" src="{{ asset('imagem/icon/user.png') }}" width="100" height="100" title='Atribuir perfis aos usuários'>
                            <br>
                            Add. Perfil Usuario</a>
                        </div>
                    </div>
                </div>

            </div>

            <br>

        </div>
        <div class="col-md-3"></div>
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
