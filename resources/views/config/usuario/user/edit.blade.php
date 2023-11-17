@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

<!-- conteudo -->
@section('content')

    <legend>Editar Usuario</legend>

    <!-- mensagem de usuario desativado -->
    @if (Session::has('message'))
        <div class="mt-8 sm:rounded-lg">
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

    <div class='col-md-12'>
        {{ Form::open(['url' => 'usuarioperfil/update']) }}
        {{ Form::token() }}
        <div class='row'>
            <div class='col'>
                {{ Form::hidden('id', $usuarioperfil->id)}}
                {{ Form::label('name', '') }}:
                {{ Form::text('name', $usuarioperfil->name, ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('email', '') }}:
                {{ Form::text('email', $usuarioperfil->email, ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('ativo', 'Ativar Usuario') }}:
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='' id='ativo'>
                    <label class='form-check-label' for='ativo'>

                    </label>
                </div>
                <br>
            </div>
            <div class="col">
               <a class="btn btn-link" type="button" name="btnCadastro" id="btnCadastro" href='{{url('usuario/edit', $usuarioperfil->id)}}' title='Cadastro Permissoes de Usuario'>Permissoes</a>
            </div>
        </div>
        <br>
            
            <div class='row'>
                <div class="col">
                {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>




    <div class="row">
        <div class="col text-center">
            <a href='{{ url('usuarioperfil/index') }}' class="btn btn-success">Voltar</a>
        </div>
    </div>
@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
