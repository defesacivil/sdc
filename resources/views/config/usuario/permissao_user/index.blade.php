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
        <div class="col text-center p-2">
            <a href="{{url('usuario')}}" class='btn btn-success'>Voltar</a>
        </div>
    </div>
    
    <p>
        <span>Permissões do Perfil : <b>{{$role->name}} - {{$role->label}}</b></span>
    </p>
    <div class="row">
        <br>
        <div class="col col-md-6">
            {{ Form::open(['url' => 'role/add_permission/store']) }}
            {{ Form::token() }}
            {{ Form::label('Busca :', '')}}
            {{ Form::select('permissons', $permissions_all, "-", ['placeholder'=> 'Selecione a permissão', 'name'=>'permissions', 'class' => 'form form-control']) }}
            {{ Form::hidden('role_id', $role->id) }}
            {{ Form::submit('Gravar', ['class'=>'btn btn-success']) }}
            {{ Form::close() }}
            
        </div>
    </div>
    <br>
    <div class="row">
    <div class="col col-md-6">
    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Label</th>
                <th>Opção</th>
                
                {{-- <th>Opcoes</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions_role as $key=> $permission_role)

                <tr>
                    <td scope="row">{{($key+1)}}</td>
                    <td scope="row">{{$permission_role->id}}</td>
                    <td scope="row">{{$permission_role->name}}</td>
                    <td scope="row">{{$permission_role->label}}</td>
                    
                    <td scope="row">
                        <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='{{url('role/remove_permission/'.$permission_role->pivot->permission_id)}}'><img src='{{asset('imagem/icon/delete.png')}}'></a>
                    </td>
                    
                </tr>

            @endforeach
        </tbody>

    </table>
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
