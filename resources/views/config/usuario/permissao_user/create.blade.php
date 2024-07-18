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
            <li class="breadcrumb-item active" aria-current="page">Associação de Papeis</li>
        </ol>
    </nav>

@endsection

<!-- conteudo -->
@section('content')
    <br>
    <br>
    {{-- @if (session('message'))
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
    @endif --}}
    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">

        <div class='row p-3'>
            <div class="col text-center">
                <a href='{{ url('usuario') }}' class="btn btn-success btn-sm">Voltar</a>
            </div>
        </div>

        <p class="text-center">
            <legend>Associação Papeis e Permissões</legend>
        </p>
        <br>
        <div class='col-md-12'>
            {{ Form::open(['url' => 'usuario/permission/add/store']) }}
            {{ Form::token() }}
            <div class='row'>
                <div class='col-12'>
                    {{ Form::label('Nome da Permissão', '') }}:
                    {{ Form::text('name', $user->name, ['class' => 'form form-control', 'readonly']) }}
                    {{ Form::hidden('user_id', $user->id, ['readonly']) }}
                    <br>
                </div>
                <div class='col-6 col-md-6 p-3'>
                    Permissões:<br>

                    @foreach ($permissions_user as $permission)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="permissao_{{ $permission['permission_id'] }}" value="{{ $permission['permission'] }}" {{ $permission['checked'] == 'true' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineCheckbox1">{{ $permission['permission'] }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class='row'>
            </div>
            <div class='row'>
                <div class='col'>
                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                </div>{{ Form::close() }}

            </div>



        </div>

    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')
        <script></script>
    @stop
