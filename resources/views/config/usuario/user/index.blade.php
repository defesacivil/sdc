@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config/usuario') }}">Usuários</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro Usuários</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div class="container border p-3 minmin-vh-100" style="background-color:#e9ecef;">

        <div class="row">
            <div class="col text-center p-3">
                <a href='{{ url('config/usuario') }}' class="btn btn-success">Voltar</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <legend>Cadastro Usuario</legend>

                <table class="table table-bordered table-sm data-table table-striped">
                    <tr>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">#<br><br></th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Nome</th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Email</th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">CPF</th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Situacao</th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Tipo</th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Perfis</th>
                        <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Ações</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td scope="row">{{ $user->id }}</td>
                            <td scope="row">{{ $user->name }}</td>
                            <td scope="row">{{ $user->email }}</td>
                            <td scope="row">{{ $user->cpf }}</td>
                            <td scope="row">{{ $user->ativo == 0 ? 'Inativo' : 'Ativo' }}</td>
                            <td scope="row">{{ $user->tipo }}</td>
                            <td scope="row">
                                @if (count($user->roles) > 0)
                                    @foreach ($user->roles as $role)
                                        <a href='{{ url('role/' . $role->id) }}' class='badge badge-success' title='Clique para ver as permissões deste Perfil !'>{{ $role->name }}</a>
                                    @endforeach
                                @else
                                    <span class="badge badge-danger">No role</span>
                                @endif
                            </td>

                            <td scope="row">
                                <a href='{{ url('role_add_user/' . $user->id) }}'><img
                                        src='{{ asset('imagem/icon/editar.png') }}'></a>
                                <a onclick="return confirm('Deseja realmente apagar esse Registro !')"
                                    href='{{ url('config/permissao/delete/' . $user->id) }}'><img
                                        src='{{ asset('imagem/icon/delete.png') }}'></a>
                                <a href='#'><img src='{{ asset('imagem/icon/view.png') }}'></a>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="7">
                                <!-- PERMISSOES INICIO-->

                                <legend>Permissões</legend>

                                <table class="table table-bordered table-sm data-table">
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Permissos</th>
                                        <th>Ações</th>
                                    </tr>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td scope="row">{{ $role->id }}</td>
                                            <td scope="row">{{ $role->name }}</td>
                                            <td scope="row">
                                                @if (count($role->permissions) > 0)
                                                    @foreach ($role->permissions as $permission)
                                                        <span class='badge badge-success'>{{ $permission->name }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="badge badge-danger">Sem Permissão</span>
                                                @endif
                                            </td>

                                            <td scope="row">

                                                <a href='{{ url('permission/role/create/' . $role->id . '/' . $user->id) }}'><img src='{{ asset('imagem/icon/editar.png') }}'></a>

                                                <a href='{{ url('permission_role/delete/' . $user->id) }}' onclick="return confirm('Deseja realmente apagar esse Registro !')"><img src='{{ asset('imagem/icon/delete.png') }}'></a>

                                                <a href='#'><img src='{{ asset('imagem/icon/view.png') }}'></a>

                                            </td>

                                        </tr>
                                    @endforeach
                                </table>
                                <!-- PERMISSOES FIM-->
                                <hr class="pt-3">
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@stop
