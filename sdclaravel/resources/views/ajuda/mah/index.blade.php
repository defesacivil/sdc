@extends('layouts.pagina_master')

{{-- header --}}
@section('header')


    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pedido Ajuda Humanitária</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row flex-fill">

            <div class="col-md-12">

                <div class="row">

                    <!-- menu opções - novo | pesquisa |voltar-->
                    <ul class="nav">
                        <!-- ####### Acesso COMPDEC ###### -->
                        @can('compdec')
                            <li class="nav-item mr-1">
                                <a class="btn btn-primary btn-sm" href="{{ url('pae/empdor/create') }}"
                                    title="Inserir novo Registro">+
                                    Novo Registro</a>
                            </li>
                        @endcan
                        <li class="nav-item mr-1">

                            <!-- #######  acesso CEDEC ####### -->
                            @can('cedec')
                                <a class="btn btn-info btn-sm" id="btn_search" href='mah/busca'>Pesquisar</a>
                            @endcan

                            <!-- ####### Acesso COMPDEC ###### -->
                            @can('compdec')
                                <a class="btn btn-info btn-sm" id="btn_search1">Pesquisar</a>
                            @endcan
                        </li>

                        @can('cedec')
                            <li class="nav-item mr-1">
                                <a class="btn btn-secondary btn-sm" href="{{ url('pae/empdor/export') }}"
                                    title="Inserir novo Registro">* Exportar Excel</a>
                            </li>
                            <li class="nav-item mr-1">
                                <a class="btn btn-warning btn-sm" href="{{ url('mah/config') }}"
                                    title="Configurações do Módulo">Configurações do Módulo</a>
                            </li>
                        @endcan
                        <li class="nav-item mr-1">
                            <a class="btn btn-success btn-sm" href="{{ url('ajuda') }}">Voltar</a>
                        </li>
                    </ul>

                </div>
                <p></p>
                <div class="row p-3">

                    <br>
                    <?php
                    /* backend
                        pmda
                            lista para analise - editar /validar comunidade / visualizar
                            busca - editar /validar comunidade / visualizar
                        conformidade


                        frontend
                        novo pmda
                        index processos  - editar / visualizar / mensagem / enviar
                        */
                    ?>

                    <!-- #######  CEDEC ####### -->
                    @can('cedec')
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card text-start p-3">
                                <img class="" width="25" src="{{ url('imagem/icon/care25.png') }}" alt="Processos Atendidos">
                                <div class="card-body">
                                    <h4 class="card-title">Processos Atendidos</h4>
                                    <p class="card-text">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>150</h3>
                                            <p>Atendidos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">Mais Informações <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card text-start p-3">
                                <img class="" width="25" src="{{ url('imagem/icon/care25.png') }}" alt="Processos em Edição">
                                <div class="card-body">
                                    <h4 class="card-title">Processos em Edição</h4>
                                    <p class="card-text">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>150</h3>
                                            <p>Em Edição</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">Mais Informações <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-start p-3">
                                <img class="" width="25" src="{{ url('imagem/icon/care25.png') }}" alt="Processos em Análise">
                                <div class="card-body">
                                    <h4 class="card-title">Processos em Análise</h4>
                                    <p class="card-text">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>150</h3>
                                            <p>Em Análise</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">Mais Informações <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-start p-3">
                                <img class="" width="25" src="{{ url('imagem/icon/care25.png') }}"
                                    alt="Processos Prestação de Contas">
                                <div class="card-body">
                                    <h4 class="card-title">Processos em Prestação de Contas</h4>
                                    <p class="card-text">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>150</h3>
                                            <p>Prestação de Contas</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">Mais Informações <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endcan



                    <!-- ######  COMPDEC ###### -->
                    @can('compdec')
                        <legend>Processos Pedido Ajuda Humanitária : <i>{{ Session::get('user')['municipio'] }}</i></legend>
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th class="bg-secondary">#</th>
                                <th class="bg-secondary">Número Processo</th>
                                <th class="bg-secondary">Data Entrada</th>
                                <th class="bg-secondary">Status</th>
                                <th class="bg-secondary">Cobrade</th>
                                <th class="bg-secondary">Opções</th>
                            </tr>

                            @foreach ($pedidos_compdec as $key => $pedido)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pedido->numero . '-' . substr($pedido->data_entrada_sistema, 0, 4) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pedido->data_entrada_sistema)->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ status_pedido_ah($pedido->status) }}</td>
                                    <td>{{ $pedido->cobrade->descricao }} - {{ $pedido->cobrade->codigo }}</td>
                                    <td>

                                        @if($pedido->status == 0)
                                            <a href="{{ url('mah/pedido/edit/' . $pedido->id) }}"><img src='{{ asset('imagem/icon/editar.png') }}'></a>
                                            <a href="#"><img src='{{ asset('imagem/icon/delete.png') }}'></a>
                                        @elseif($pedido->status == 1)

                                        @elseif($pedido->status == 2)
                                        
                                        @elseif($pedido->status == 3)
                                        @elseif($pedido->status == 4)
                                        @elseif($pedido->status == 5)
                                        @elseif($pedido->status == 6)
                                        @elseif($pedido->status == 7)
                                        @elseif($pedido->status == 8)
                                        @elseif($pedido->status == 9)

                                        @endif
                                        <a href="#"><img src='{{ asset('imagem/icon/view.png') }}'></a>
                                    </td>

                                </tr>
                            @endforeach


                        </table>

                    @endcan

                </div>
            </div>
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
