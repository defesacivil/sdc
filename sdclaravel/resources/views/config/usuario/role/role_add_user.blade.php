@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config/usuarios') }}">Usuários</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/usuario') }}">Cadastro Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar Permissão ao Usuário</li>
        </ol>
    </nav>

@endsection


<!-- conteudo -->
@section('content')
    <br>
    <br>
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


    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nome: {{ $user->name }}
                            <p class="card-text">E-mail: {{ $user->email }}</p>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-md-12'>
                {{ Form::open(['url' => 'role_add_user/store']) }}
                {{ Form::token() }}
                <div class='row'>
                    <div class="col-12">
                        {{ Form::label('Situacao', '') }}:
                        {{ Form::select('ativo', ['1' => 'Ativo', '0' => 'Inativo'], $user->ativo, ['id' => 'ativo', 'placeholder' => 'Situação do Usuario', 'class' => 'form form-control']) }}
                    </div>
                    <div class='col-12'>
                        {{ Form::label('Perfil', '') }}:
                        {{ Form::hidden('user_id', $user->id) }}
                        {{ Form::select('role_id', $roles, '', ['id' => 'sel_role', 'placeholder' => 'Selecione o Perfill', 'class' => 'form form-control']) }}
                    </div>

                </div>
                <div class='row'>
                    <div class='col p-2'>
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>{{ Form::close() }}

                </div>

            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <table class='table table-bordered table-condensed table-sm'>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Opções</th>

                        </tr>
                        @foreach ($user->roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td><a href='{{ url('role_add_user/delete') }}'><img
                                            src='{{ asset('imagem/icon/delete.png') }}'></a></td>
                            </tr>
                        @endforeach

                    </table>


                </div>
            </div>

            <br>
            <div class='row'>
                <div class="col text-center">
                    <a href='{{ url('config/usuario') }}' class="btn btn-success">Voltar</a>
                </div>
            </div>

        </div>


    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')
        <script></script>
    @stop
