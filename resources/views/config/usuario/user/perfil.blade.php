@extends('layouts.pagina_master')

{{-- header --}}
@section('header')


    <!-- breadcrumb -->
    <div class="row" style="background-color: #C0D6DF">
        <div class="col">
                <nav aria-label="breadcrumb" class="border-botton align-middle">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/config/usuario') }}">Usuários</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil / Permissões</li>
                    </ol>
                </nav>

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-12 text-center p-3">
            <a href='{{ url('config/usuario') }}' class="btn btn-success">Voltar</a>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-12">
            <legend>Cadastro de Perfis e Permissões</legend>
        </div>
    </div>

    <div class="row" id="corpo1">
        <div class="col-12 col-md-6 p-3">

            <form method="POST" class="form-inline" action="{{ url('/usuario') }}" name="frmSerach" id="frmSearch">
                <input class="form form-control" type="text" name="search" id="search" maxlength="50"><br>
                @csrf
                <button class="btn btn-primary" type="submit" name="btnSearch" id="btnSearch">Pesquisar</button>

            </form>
        </div>
    </div>

    @isset($users)
        <div class="row p-2">
            <div class="col-12">
                <div class="row">

                    <div class="col-12 col-md-6 p-3 inline">
                        Legenda:
                        <span class="badge bg-success">PERFIL</span>
                        <span class="badge bg-danger">Permissões</span>
                        <span class="badge bg-warning">Sem Perfil</span>
                    </div>
                </div>

                <table class="table table-bordered table-sm data-table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Situacao</th>
                        <th>Tipo</th>
                        <th>Perfil / Permissão</th>
                        <th>Ações</th>
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
                                        <a href='{{ url('role/' . $role->id) }}' title='Clique para ver as permissões deste Perfil !'><span class='badge bg-success'>{{ Str::upper($role->name) }} </a>
                                    @endforeach
                                    <br>

                                    @foreach ($user->permissions as $permission)
                                        <span class="badge bg-danger">{{ $permission->name }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-warning">sem Perfil</span>
                                @endif
                            </td>

                            <td scope="row">
                                <a href='{{ url('usuario/role/add/' . $user->id) }}' title="Adicionar Perfil"><img src='{{ asset('imagem/icon/role.png') }}' width="30"></a>
                                <a href='{{ url('usuario/permission/add/' . $user->id) }}' title='Adicionar Permissão'><img src='{{ asset('imagem/icon/permissao.png') }}' width="30"></a>
                                <a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='{{ url('config/permissao/delete/' . $user->id) }}'><img src='{{ asset('imagem/icon/delete.png') }}'></a>
                                <a href='#'><img src='{{ asset('imagem/icon/view.png') }}'></a>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endisset

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
