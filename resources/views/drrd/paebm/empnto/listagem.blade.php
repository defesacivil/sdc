@extends('layouts.pagina_master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')

    <div class="row">
        <div class="p-3 col">
            <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empnto') }}'>Voltar</a></p><br>
            <p class="text-center">
                <legend>Empreendimento</legend>
            </p>
        </div>
    </div>
    <div class="col">
        <table class="table table-bordered table-condensed table-stripped">
            <tr>
                <th>Código</th>
                <th>Empreendimento</th>
                <th>Município</th>
                <th>Empreendedor</th>
                <th>Material</th>
                <th>Nome da Mina</th>
                <th>Finalidade</th>
                <th>Volume</th>
                <th>População da ZAS</th>
                <th>Órgão Fiscalizador</th>
                <th>Coordenador PAE</th>
            </tr>

            @foreach ( $empntos as $empnto )
                
            <tr>
                <td>{{ $empnto->id }}</td>
                <td>{{ $empnto->nome }}</td>
                <td>{{ $empnto->municipio->nome }}</td>
                <td>{{ $empnto->empreendedor['nome'] }}</td>
                <td>{{ $empnto->material }}</td>
                <td>{{ $empnto->mina }}</td>
                <td>{{ $empnto->finalidade }}</td>
                <td>{{ $empnto->volume }}</td>
                <td>{{ $empnto->pop_zas }}</td>
                <td>{{ $empnto->orgao_fisc }}</td>
                <td>{{ $empnto->coordenador }}</td>
            </tr>
            
            @endforeach
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

@stop
