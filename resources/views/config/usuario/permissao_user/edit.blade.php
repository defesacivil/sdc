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
		@foreach ( $errors->all() as $error )
			<li class='error'>{{ $error }}</li>
		@endforeach
	</ul>
@endif
<div class="row">
<div class="col-12">
    <p> Nome Usuario : {{$user->nome}}</p>
</div>

</div>
    <div class='col-md-12'>

        {{ Form::open(['url' => 'config/permissao/update/'.$permission->id, 'method'=> 'POST']) }}
        {{ Form::token() }}
        @method('PUT')
        <div class='row'>
            <div class='col'>
                {{ Form::hidden('id', $permissao->id)}}
                {{ Form::label('name', '') }}:
                {{ Form::text('name', $permissao->name, ['class'=>'form form-control', 'value'=>old('name')]) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('label', '') }}:
                {{ Form::text('label', $permissao->label, ['class' => 'form form-control', 'value'=>old('label')]) }}
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
                <a href='{{url('permissao')}}' class="btn btn-success">Voltar</a>
            </div>
        </div>
        


    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')
        <script></script>
    @stop
