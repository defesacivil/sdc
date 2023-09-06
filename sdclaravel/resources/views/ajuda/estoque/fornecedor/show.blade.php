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
        @can('cedec')
        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('estoque/fornecedor') }}>Voltar</a>


                <legend>Dados do Fornecedores</legend>

            <div class="table table-responsive table-sm">
                <table class="table table-striped">
                    <tr>
                        <th>Nome :</th>
                        <th>{{$fornecedor->nome}}</th>
                    </tr>
                    <tr>
                        <th>CPF CNPJ :</th>
                        <th>{{$fornecedor->cpfcnpj}}</th>
                    </tr>
                    <tr>
                        <th>Endereço :</th>
                        <th>{{$fornecedor->endereco}}</th>
                    </tr>
                    <tr>
                        <th>Município :</th>
                        <th>{{$fornecedor->municipio}}</th>
                    </tr>
                    <tr>
                        <th>Estado :</th>
                        <th>{{$fornecedor->estado}}</th>
                    </tr>
                    <tr>
                        <th>Telefone :</th>
                        <th>{{$fornecedor->tel}}</th>
                    </tr>
                    <tr>
                        <th>Email :</th>
                        <th>{{$fornecedor->email}}</th>
                    </tr>

                </table>
            </div>
            @endcan

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
