@extends('layouts/master')


<!-- conteudo -->
@section('content')

    <!-- validadação -->
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

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/mah') }}">Pedido de Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configurações do Módulo</li>
        </ol>
    </nav>

    <!-- menu opções - novo | pesquisa |voltar-->
    <div class="row">
        <div class="col p-3">
            <ul class="nav">
                <li class="nav-item mr-1">
                    <a class="btn btn-primary btn-sm" href="{{ url('pae/empdor/create') }}" title="Inserir novo Registro">+
                        Novo Registro</a>
                </li>
                <li class="nav-item mr-1">
                    <a class="btn btn-info btn-sm" id="btn_search">Pesquisar</a>
                </li>
                <li class="nav-item mr-1">
                    <a class="btn btn-secondary btn-sm" href="{{ url('pae/empdor/export') }}"
                        title="Inserir novo Registro">* Exportar Excel</a>
                </li>
                <li class="nav-item mr-1">
                    <a class="btn btn-success btn-sm" href="{{ url('mah') }}">Voltar</a>
                </li>
            </ul>

        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col">

                <label>Prazo máximo prestação de Contas (Dias)</label>
                <input type="number" class="form form-control form-control-sm" id="prazo_pest" name="prazo_prest">
            </div>
            <div class="col">
                <span>Nota:<br>Os materiais desta lista são disponibilizados para o município fazer o pedido</span><br>
                <p><label for="">Permissão de Materiais</label></p>

                <div class="table-responsive-sm">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Material</th>
                                <th scope="col">Opção</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                @foreach ($permissao_materiais as $key=>$permissao_material)
                                    <td scope="row">{{$key}}</td>
                                    <td>{{$permissao_material->material}}</td>
                                    <td><a href="{{url('ajuda/permissao.mat/delete'.$permissao_material->id)}}"></a></td>
                                    
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>

        </div>


    </div>





@stop

@section('css')

@stop

@section('js')
    <script text="javascript/text">
        $(document).ready(function() {


        });
    </script>

@stop
