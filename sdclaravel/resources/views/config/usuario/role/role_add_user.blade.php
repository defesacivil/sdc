@extends('layouts.pagina_master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

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
    <div class="col-md-12">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class='col-md-12'>
        {{ Form::open(['url' => 'role_add_user/store']) }}
        {{ Form::token() }}
        <div class='row'>
            <div class="col">
                {{ Form::label('Situacao', '') }}:
                {{ Form::select('ativo', ['1'=>'Ativo', '0'=>'Inativo'], $user->ativo, ['id'=>'ativo', 'placeholder'=> 'Situação do Usuario', 'class' => 'form form-control']) }}
            </div>
            <div class='col'>
                {{ Form::label('Perfil', '') }}:
                {{ Form::hidden('user_id', $user->id ) }}
                {{ Form::select('role_id', $roles, '', ['id'=>'sel_role', 'placeholder'=> 'Selecione o Perfill', 'class' => 'form form-control']) }}
            </div>

        </div>
        <div class='row'>
            <div class='col p-2'>
                {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
            </div>{{ Form::close() }}

        </div>
        

        <div class="row">
            <div class="col">
                <table class='table table-bordered table-condensed'>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Opções</th>

                    </tr>
                    @foreach ($user->roles as $key=>$role)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$role->id}}</td>
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


    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')
        <script></script>
    @stop
