@extends('layouts/master')

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
    <div class='col-md-12'>
        <div class='row m-3'>
            <div class="col text-center">
                <a href='{{ url('config/role') }}' class="btn btn-success">Voltar</a>
            </div>
        </div>

        <div class='row'>
            <table class="table table-bordered table-condensed">
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                </tr>
                <tr>
                    <td>{{$perfil->id}}</td>
                    <td>{{$perfil->name}}</td>
                </tr>
            </table>


        </div>
        

    </div>



@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
