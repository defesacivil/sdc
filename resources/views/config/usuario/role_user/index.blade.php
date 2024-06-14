@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config/usuario') }}">Usuários</a></li>
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
            @foreach ($errors->all() as $error)
                <li class='error'>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row">
            <div class="col text-center">
                <a href="{{ url('config/usuario') }}" class='btn btn-success'>Voltar</a>
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
                    <th>Tipo Modelo</th>
                    <th>Criado em</th>
                    <th>Atualizado em</th>
                    <th>Opcoes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model_has_roles as $key=>$model_has_role)
                    <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td scope="row">{{ $model_has_role->role_id }} - {{ $model_has_role->role }} </td>
                        <td scope="row">{{ $model_has_role->model_id }} -{{ $model_has_role->name }}</td>
                        <td scope="row">{{ $model_has_role->model_type }}</td>
                        <td scope="row">{{ $model_has_role->created_at }}</td>
                        <td scope="row">{{ $model_has_role->updated_at }}</td>
                        <td scope="row">
                            <a href='{{ url('config/role/edit/' . $model_has_role->role_id . '') }}'><img src='{{ url('imagem/icon/editar.png') }}'></a>
                            <a onclick="return confirm('Deseja apagar esse registro ?')" href='{{ url('config/role/delete/' . $model_has_role->role_id . '') }}''><img src='{{ url('imagem/icon/delete.png') }}'></a>
                            {{-- <a href='#'>{!! config('constantes.icon.visualizar') !!}</a> --}}
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

        <div class="row">
            <div class="col">
                {{ $model_has_roles->links() }}
            </div>
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
