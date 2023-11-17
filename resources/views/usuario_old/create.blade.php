@extends('adminlte::page')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

<!-- conteudo -->
@section('content')
    <legend>Cadastro Usuario</legend>


{{$usuario}}

    <div class="row">
        <div class="col text-center">
            <a href='{{ url('dashboard') }}' class="btn btn-success">Voltar</a>
        </div>
    </div>
@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
