@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')

<div class="col-md-12 text-center">
    <div class="col-md-6">
        <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "cadastroEmpr") ?>' class='btn btn-success' title="Cadastrar novo acesso de  Empreendedor">Novo Usuário Externo</a></p>
    </div>

    <div class="col-md-6">
        <p style="text-center"><a href='<?= FuncaoBase::geraLink("index", "index", "paebmindex") ?>' class='btn btn-primary'>Voltar</a></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="#" method="POST" name="frmPesquisa" id="frmPesquisa">
            <label>Pesquisa</label><br>
            <input type="text" class="form form-control" name="pesquisa" id="pesquisa"><br>
            <input type="submit" class="btn btn-primary" name="btn" value="Pesquisar">
        </form>
    </div>
</div>
    <div class="row">
        <div class="row">
            <div class="col p-3">
                <p class='text-center'><a class='btn btn-success' href='dashboard'>Voltar</a></p><br>
                <p class="text-center"><legend>PAEBM - PROTOCOLO</legend></p>
            </div>
        </div>
        <div class="row">
            <div class="col">Protocolo</div>
            <div class="col"></div>
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
