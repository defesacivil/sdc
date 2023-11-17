@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config/usuario') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro Permissão</li>
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
                <a href="{{ url('config/usuario') }}" class='btn btn-success btn-sm'>Voltar</a>
            </div>
        </div>
        <div class="row">
            <br>
            <div class="col p-3">
                <a href='{{ url('config/permissao/create') }}' class="btn btn-primary">Cadastro Permissão</a>
                <br>
                <br>
                <label>Busca</label>
                {{ Form::text('busca', '', ['class' => 'form form-control']) }}
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">#</th>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Código</th>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Nome</th>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Label</th>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Criado em</th>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Atualizado em</th>
                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Opcções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissoes as $key => $permissao)
                    <tr>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td scope="row">{{ $permissao->id }}</td>
                        <td scope="row">{{ $permissao->name }}</td>
                        <td scope="row">{{ $permissao->label }}</td>
                        <td scope="row">{{ $permissao->created_at }}</td>
                        <td scope="row">{{ $permissao->updated_at }}</td>
                        <td scope="row">
                            <a href='{{ url('permissao/edit/' . $permissao->id) }}'><img src='{{ asset('imagem/icon/editar.png') }}'></a>
                            <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='{{ url('config/permissao/delete/' . $permissao->id) }}'><img src='{{ asset('imagem/icon/delete.png') }}'></a>
                            <a href='#'><img src='{{ asset('imagem/icon/view.png') }}'></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>
        <br>

    </div>


@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script></script>
@stop
