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
            <a href='{{ url('config/permissao/create') }}' class="btn btn-primary">Cadastro Permissão</a>
            <br>
            <label>Busca</label>
            {{ Form::text('busca', '', ['class' => 'form form-control']) }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Label</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Opcoes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissoes as $key=>$permissao)
                <tr>
                    <td scope="row">{{($key+1)}}</td>
                    <td scope="row">{{$permissao->id}}</td>
                    <td scope="row">{{$permissao->name}}</td>
                    <td scope="row">{{$permissao->label}}</td>
                    <td scope="row">{{$permissao->created_at}}</td>
                    <td scope="row">{{$permissao->updated_at}}</td>
                    <td scope="row">
                        <a href='{{url('permissao/edit/'.$permissao->id)}}'><img src='{{asset('imagem/icon/editar.png')}}'></a>
                        <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='{{url('config/permissao/delete/'.$permissao->id)}}'><img src='{{asset('imagem/icon/delete.png')}}'></a>
                        <a href='#'><img src='{{asset('imagem/icon/view.png')}}'></a>
                    </td>
                    
                </tr>

            @endforeach
        </tbody>

    </table>




    <br>


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
