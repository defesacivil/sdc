@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config/usuario') }}">Usuários</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/role') }}">Cadastro Perfil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastrar Perfil</li>
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
        <div class='col-md-12'>
            <div class='row'>
                <div class="col text-center">
                    <a href='{{ url('role') }}' class="btn btn-success btn-sm">Voltar</a>
                </div>
            </div>
            <p class="text-center p-3">
                <legend>Cadastro de Regra</legend>
            </p>

            {{ Form::open(['url' => 'config/role/store']) }}
            {{ Form::token() }}
            <div class='row'>
                <div class='col-12'>
                    {{ Form::label('name', '') }}:
                    {{ Form::text('name', '', ['class' => 'form form-control', 'value' => old('name')]) }}
                    <br>
                </div>
                <div class='col-12'>
                    {{ Form::label('label', '') }}:
                    {{ Form::text('label', '', ['class' => 'form form-control', 'value' => old('label')]) }}
                    <br>
                </div>
            </div>
            <div class='row'>
                <div class='col'>
                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
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
