@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/estoque') }}">Controle de Estoque</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/estoque/cadastro') }}">Cadastros</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fornecedor</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('estoque/cadastro') }}>Voltar</a>
            <a class='btn btn-info btn-sm' href={{ url('estoque/fornecedor/create') }} title="Criar novo Registro">+ Novo</a></p>

            <legend>Cadastro de Fornecedores</legend>

            <div class="table table-responsive table-sm">
                <table class="table table-striped
                table-hover	
                table-borderless
                table-primary
                align-middle">
                    <thead class="table-light">
                        <caption></caption>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($fornecedores as $key => $fornecedor)
                                <tr class="table-primary" >
                                    <td scope="row">{{$fornecedor->nome}}</td>
                                    <td>{{$fornecedor->tel}}</td>
                                    <td>{{$fornecedor->email}}</td>
                                    <td>
                                        <a href="{{url('estoque/fornecedor/edit/'.$fornecedor->id)}}"><img width="25" src={{asset('/imagem/icon/editar.png')}}></a>
                                        <a href="{{url('estoque/fornecedor/show/'.$fornecedor->id)}}"><img width="25" src={{asset('/imagem/icon/view.png')}}></a>
                                    </td>
                                </tr>
                            @endForeach
                            
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                </table>
            </div>
            {{ $fornecedores->links() }}


        </div>
    </div>

@stop

@section('css')

@stop

@section('code')

    <script type="text/javascript">
        $(document).ready(function() {



        })
    </script>

@endsection
