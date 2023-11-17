@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')

    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='{{url('drrd')}}'>Voltar</a></p><br>
            <p class="text-center">
                <legend>Analise de PAEBM</legend>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col p-3">
            <label for="serach">Busca:</label>
            {{ Form::open(['url' => 'pae/analise', 'method' => 'POST']) }}
            {{ Form::token() }}
            {{ Form::text('search', '', ['class' => 'form form-control', 'value' => old('nome')]) }}
             <br>
            {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
    <div class="col">
        <table class="table table-bordered table-condensed">
            <tr>
                <th>CÓDIGO</th>
                <th>PROTOCOLO</th>
                <th>EMPREENDIMENTO</th>
                <th>DATA</th>
                <th>FASE</th>
                <th>AÇÕES</th>
            </tr>
           
            @foreach ($analises as $key => $analise)
                
                <tr>
                    <td>{{ $analise->id }}</td>
                    <td>{{$analise->nome}}</td>
                    
                    <td>
                        <a href='{{url('pae/analise/edit/'.$analise->id)}}'><img src='{{asset('imagem/icon/editar.png')}}'></a>
                        <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='#'><img src='{{asset('imagem/icon/delete.png')}}'></a>
                        <a href='{{url('pae/analise/show/'.$analise->id)}}'><img src='{{asset('imagem/icon/view.png')}}'></a>

                    </td>
                </tr>
                
            @endforeach
            <tr>
                <td colspan="7" class='text-center'>
                    {{ $analises->links() }}

                </td>
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
