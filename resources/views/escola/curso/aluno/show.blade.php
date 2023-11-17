@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')

    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empdor') }}'>Voltar</a></p><br>
            <p class="text-center">
                <legend>Empreendimento</legend>
            </p>
        </div>
    </div>
    <div class="col">
        <table class="table table-bordered table-condensed table-stripped">
            <tr>
                <th>CÓDIGO</th>
                <td>{{ $empdor->id }}</td>
            </tr>
            <tr>
                <th>EMPREENDEDOR</th>
                <td>{{ $empdor->nome }}</td>
            </tr>
           

        </table>
    </div>
    </div>

    <div class="row">
        <div class="col"></div>
    </div>







@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
