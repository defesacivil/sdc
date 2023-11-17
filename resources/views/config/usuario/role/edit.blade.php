@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro Perfil</li>
        </ol>
    </nav>

@endsection

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
		@foreach ( $errors->all() as $error )
			<li class='error'>{{ $error }}</li>
		@endforeach
	</ul>
@endif
    <div class='col-md-12'>
        {{ Form::open(['url' => 'config/role/update/'.$perfil->id, 'method'=> 'POST']) }}
        {{ Form::token() }}
        @method('PUT')
        <div class='row'>
            <div class='col'>
                {{ Form::hidden('id', $perfil->id)}}
                {{ Form::label('name', '') }}:
                {{ Form::text('name', $perfil->name, ['class'=>'form form-control', 'value'=>old('name')]) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('label', '') }}:
                {{ Form::text('label', $perfil->label, ['class' => 'form form-control', 'value'=>old('label')]) }}
                <br>
            </div>
        </div>
        <div class='row'>
        </div>
        <div class='row'>
            <div class='row'>
                {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
            </div>{{ Form::close() }}

        </div>
        <br>
        <div class='row'>
            <div class="col text-center">
                <a href='{{url('role')}}' class="btn btn-success">Voltar</a>
            </div>
        </div>
        


    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')
        <script></script>
    @stop
