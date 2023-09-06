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
            <a href="{{ url('config/role_user/create') }}" class="btn btn-primary">Cadastro Perfil_Usuário</a>
            <br>
            <label>Busca</label>
            {{ Form::text('busca', '', ['class' => 'form form-control']) }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Id Perfil</th>
                <th>Id Usuário</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Opcoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($role_users as $role_user)

                <tr>
                    <td scope="row">{{ $role_user->id }}</td>
                    <td scope="row">{{ $role_user->role_id }} </td>
                    <td scope="row">{{ $role_user->user_id }}</td>
                    <td scope="row">{{ $role_user->created_at }}</td>
                    <td scope="row">{{ $role_user->updated_at }}</td>
                    <td scope="row">
                        <a href='{{url('config/role/edit/'.$role_user->id.'')}}'><img src='{{url('imagem/icon/editar.png')}}'></a>
                        <a onclick="return confirm('Deseja apagar esse registro ?')" href='{{url('config/role/delete/'.$role_user->id.'')}}''><img src='{{url('imagem/icon/delete.png')}}'></a>
                        {{-- <a href='#'>{!! config('constantes.icon.visualizar') !!}</a> --}}
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="row">
        <div class="col">
            {{ $role_users->links() }}
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
