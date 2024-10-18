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
                <th>CÓDIGO</th>
                <td>{{ $empnto->id }}</td>
            </tr>
            <tr>
                <th>EMPREENDIMENTO</th>
                <td>{{ $empnto->nome }}</td>
            </tr>
            <tr>
                <th>MUNICÍPIO</th>
                <td>{{ $empnto->municipio->nome }}</td>
            </tr>
            <tr>
                <th>EMPREENDEDOR</th>
                <td>{{ $empnto->empreendedor['nome'] }}</td>
            </tr>
            <tr>
                <th>MATERIAL</th>
                <td>{{ $empnto->material }}</td>
            </tr>
            <tr>
                <th>NOME DA MINA</th>
                <td>{{ $empnto->mina }}</td>
            </tr>
            <tr>
                <th>FINALIDADE</th>
                <td>{{ $empnto->finalidade }}</td>
            </tr>
            <tr>
                <th>VOLUME</th>
                <td>{{ $empnto->volume }}</td>
            </tr>
            <tr>
                <th>POP_ZAS</th>
                <td>{{ $empnto->pop_zas }}</td>
            </tr>
            <tr>
                <th>ORGAO_FISC</th>
                <td>{{ $empnto->orgao_fisc }}</td>
            </tr>
            <tr>
                <th>MUNICIPIO_ID</th>
                <td>{{ $empnto->municipio->nome }}</td>
            </tr>
            <tr>
                <th>REGIAO_ID</th>
                <td>{{ $empnto->regiao->nome }}</td>
            </tr>
            <tr><td colspan="2"><hr></td></tr>
            <tr>
                <th>PAE_COORDENADOR</th>
                <td>{{ $empnto->coordenador }}</td>
            </tr>
            <tr>
                <th>E-MAIL COORDENADOR</th>
                <td>{{ $empnto->email_coord }}</td>
            </tr>
            <tr>
                <th>TEL COORDENADOR</th>
                <td>{{ $empnto->tel_coordenador }}</td>
            </tr>
            <tr><td colspan="2"><hr></td></tr>
            <tr>
                <th>COORDENADOR SUBSTITUTO</th>
                <td>{{ $empnto->coordenador_sub }}</td>
            </tr>
            <tr>
                <th>E-MAIL COORDENADOR SUBSTITUTO</th>
                <td>{{ $empnto->email_coord_sub }}</td>
            </tr>
            <tr>
                <th>TEL COORDENADOR SUBSTITUTO</th>
                <td>{{ $empnto->tel_coordenador_sub }}</td>
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
    
@stop
