@extends('layouts.pagina_master')
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
        <div class="col text-center">
            <a href="{{url('config/usuario')}}" class='btn btn-success'>Voltar</a>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="col">
            <a href="{{ url('config/role/create') }}" class="btn btn-primary">Cadastro Perfil</a>
            <br>
            <label>Busca</label>
            {{ Form::text('busca', '', ['class' => 'form form-control']) }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Label</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Opcoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perfis as $perfil)
                <tr>
                    <td scope="row">{{ $perfil->id }}</td>
                    <td scope="row">{{ $perfil->name }}</td>
                    <td scope="row">{{ $perfil->label }}</td>
                    <td scope="row">{{ $perfil->created_at }}</td>
                    <td scope="row">{{ $perfil->updated_at }}</td>
                    <td scope="row">
                        <a href='{{url('config/role/edit/'.$perfil->id)}}'><img src='{{url('imagem/icon/editar.png')}}'></a>
                        <a onclick="return confirm('Deseja apagar esse registro ?')" href='{{url('config/role/delete/'.$perfil->id)}}'><img src='{{url('imagem/icon/delete.png')}}'></a>
                        <a href='{{url('config/role/show/'.$perfil->id)}}'><img src='{{url('imagem/icon/view.png')}}'></a>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="row">
        <div class="col">
            {{ $perfis->links() }}
        </div>
    </div>
    <br>


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
