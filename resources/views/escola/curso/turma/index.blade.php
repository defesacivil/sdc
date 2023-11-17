@extends('adminlte::page')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop
<!-- conteudo -->
@section('content')

<!-- validadação -->
@if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
	<ul class='errors'>
		@foreach ( $errors->all() as $error )
			<li class='error'>{{ $error }}</li>
		@endforeach
	</ul>
@endif

<!-- breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{url('/drrd')}}">Drrd</a></li>
    <li class="breadcrumb-item active" aria-current="page">Empreendedor</li>
  </ol>
</nav>

<!-- menu opções - novo | pesquisa |voltar-->
  <legend class="text-center alert alert-success alert-sm">Cadastro Empreendedor</legend>
    <div class="row">
        <div class="col p-3">
            <ul class="nav">
                <li class="nav-item m-1">
                  <a class="nav-link btn btn-primary btn-sm" href="{{url('pae/empdor/create')}}" title="Inserir novo Registro">+ Novo Registro</a>
                </li>
                <li class="nav-item p-1">
                  <a class="nav-link btn btn-info btn-sm" id="btn_search">Pesquisar</a>
                </li>
                <li class="nav-item p-1">
                  <a class="nav-link btn btn-secondary btn-sm" href="{{url('pae/empdor/export')}}" title="Inserir novo Registro">* Exportar Excel</a>
                </li>
                <li class="nav-item p-1">
                  <a class="nav-link btn btn-success btn-sm" href="{{url('drrd')}}">Voltar</a>
                </li>
              </ul>

        </div>
    </div>
    <div class="row" id="div_search">
        <div class="col">
            <label for="serach">Busca:</label>
            {{ Form::open(['url' => 'pae/empdor', 'method' => 'POST']) }}
            {{ Form::token() }}
            <div class="input-group mb-3">
                {{ Form::text('search', '', ['class' => 'form form-control col-md-3']) }}
                <div class="input-group-append">
                    {{ Form::submit('Pesquisa', ['class' => 'btn btn-outline-secondary']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="col">
        
        <p class='text-right'>Total Registros : {{$empdors->total()}}</p>
        <table class="table table-bordered table-condensed table-sm">
            <tr>
                <th class="col-1">CÓDIGO</th>
                <th class="col-10">EMPREENDEDOR</th>
                <th class="col-1">AÇÕES</th>
            </tr>
           
            @foreach ($empdors as $key => $empdor)
                
                <tr>
                    <td>{{ $empdor->id }}</td>
                    <td>{{$empdor->nome}}</td>
                    
                    <td>
                        <a href='{{url('pae/empdor/edit/'.$empdor->id)}}'><img src='{{asset('imagem/icon/editar.png')}}'></a>
                        <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='#'><img src='{{asset('imagem/icon/delete.png')}}'></a>
                        <a href='{{url('pae/empdor/show/'.$empdor->id)}}'><img src='{{asset('imagem/icon/view.png')}}'></a>

                    </td>
                </tr>
                
            @endforeach
            <tr>
                <td colspan="7" class='text-center'>
                    {{ $empdors->links() }}

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
    <script text="javascript/text">
        $(document).ready(function(){
        
          $("#div_search").hide(); 
        
          $("#btn_search").click(function(){
            $("#div_search").toggle();
           });
        });
    </script>
@stop
