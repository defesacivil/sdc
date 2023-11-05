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
            <div class="col p-3">
                <a href="{{ url('config/role/create') }}" class="btn btn-primary">Cadastro Perfil</a>
                <br>
                <br>
                <label>Busca Perfil:</label>
                {{ Form::text('busca', '', ['class' => 'form form-control']) }}
            </div>
        </div>
        <div class="row">
            <div class="col p-3">
                <table class="table table-bordered table-sm ">
                    <thead>
                        <tr>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">#<br><br></th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Nome</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Label</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Criado em</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Atualizado em</th>
                            <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Opcoes</th>
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
                                    <a href='{{ url('config/role/edit/' . $perfil->id) }}'><img src='{{ url('imagem/icon/editar.png') }}'></a>
                                    <a onclick="return confirm('Deseja apagar esse registro ?')" href='{{ url('config/role/delete/' . $perfil->id) }}'><img src='{{ url('imagem/icon/delete.png') }}'></a>
                                    <a href='{{ url('config/role/show/' . $perfil->id) }}'><img src='{{ url('imagem/icon/view.png') }}'></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>



        <div class="row">
            <div class="col">
                {{ $perfis->links() }}
            </div>
        </div>
        <br>

    </div>


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
