@extends('layouts/master')
@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

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
    <li class="breadcrumb-item"><a href="{{url('/equipe')}}">Equipe</a></li>
    <li class="breadcrumb-item active" aria-current="page">Registro DSP</li>
  </ol>
</nav>

<!-- menu opções - novo | pesquisa |voltar-->
    <div class="row">
        <div class="col p-3">
            <ul class="nav">
                <li class="nav-item mr-1">
                  <a class="btn btn-primary btn-sm" href="{{url('dsp/dsp/create')}}" title="Inserir novo Registro">+ Novo Registro</a>
                </li>
                <li class="nav-item mr-1">
                  <a class="btn btn-primary btn-sm" href="{{url('dsp/viatura/create')}}" title="Inserir novo Registro">+ Nova Viatura</a>
                </li>
                <li class="nav-item mr-1">
                  <a class="btn btn-info btn-sm" id="btn_search">Pesquisar</a>
                </li>
                <li class="nav-item mr-1">
                  <a class="btn btn-secondary btn-sm" href="{{url('pae/empdor/export')}}" title="Inserir novo Registro">* Exportar Excel</a>
                </li>
                <li class="nav-item mr-1">
                  <a class="btn btn-success btn-sm" href="{{url('equipe')}}">Voltar</a>
                </li>
              </ul>

        </div>
    </div>

    @can('cedec')

    <div class="row">
        <div class="col" id="div_search">
            {{ Form::open(['url' => 'dsp']) }}
        {{ Form::token() }}

        {{ Form::label('txtBusca', 'Busca DSP') }} :
        {{ Form::text('txtBusca', '', ['class' => 'form form-control form-control-sm m-1']) }}

        {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary btn-sm']) }}

        {{ Form::close() }}

        </div>
    </div>
        
        <br>

        @if (isset($dsps))

        

            <table class='table table-bordered table-sm'>
                <tr>
                    <th>Cod</th>
                    <th>Data</th>
                    <th>Localidade At.</th>
                    <th>Cobrade</th>
                    <th>Opções</th>
                </tr>
                @foreach ($dsps as $dsp)
                    <tr>
                        <td>{{ $dsp->id }}</td>
                        <td>{{ $dsp->data_hora }}</td>
                        <td>{{ 'localidade' }}</td>
                        <td>{{ 'Evento' }}</td>

                        <td>
                            <a href='{{ url('dsp/edit', ['id' => $dsp->id]) }}'><img
                                    src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                        </td>
                    </tr>
                @endforeach
            </table>

        @endif
    @endcan



@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        $("document").ready(function(){
            $("#div_search").hide();

            $("#btn_search").click(function(){
                $("#div_search").toggle();
            });

        });
    </script>
@stop
