@extends('layouts.pagina_master')

{{-- header --}}
@section('breadcrumb')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pedido Ajuda Humanitária</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="shadow p-3">
        <div class="row">

            <div class="col-md-12">

                <div class="row">

                    <div class="col text-center">
                        <a class="btn btn-success btn-sm" href="{{ url('ajuda') }}">Voltar</a>
                    </div>

                    <!-- menu opções - novo | pesquisa |voltar-->

                    {{-- Prezado Coordendor,

                    Para continuar a usar o sistema é necessário fazer as atualizações necessárias abaixo
                    <div class="table-responsive table-bordered">
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th class="text-center"><img=''></th>
                                    <th class="text-center">X</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <th class="text-center">Atualização DocumentosX</th>
                                    <th class="text-center">A equipe do compdec não tem um funcionário com a função Coordenador</th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div> --}}

                    <ul class="nav">

                        <!-- ####### Acesso COMPDEC ###### -->
                        @if(auth()->user()->hasRole('compdec'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('mah/pedido/create') }}" title="Inserir novo Registro">+ Novo Registro</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <!-- #######  acesso CEDEC ####### -->
                            @can('cedec')
                                <a class="nav-link" id="btn_search" href='mah/busca'>Pesquisar</a>
                            @endcan

                            <!-- ####### Acesso COMPDEC ###### -->
                            @can('compdec')
                                <a class="nav-link" id="btn_search1">Pesquisar</a>
                            @endcan
                        </li>

                        @can('cedec')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('pae/empdor/export') }}"
                                    title="Inserir novo Registro">Exportar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('mah/config') }}"
                                    title="Configurações do Módulo">Configurações</a>
                            </li>
                        @endcan                        
                    </ul>


                    


                </div>

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

                                        @if ($pedido->status == 0)
                                            <a href="{{ route('pedido/edit', [$pedido->id]) }}"><img src='{{ asset('imagem/icon/editar.png') }}'></a>
                                            <a href="{{ route('pedido/delete', [$pedido->id]) }}" onclick="return confirm('Deseja Excluir esse Pedido Nº {{ $pedido->numero }}/{{ substr($pedido->data_entrada_sistema, 0, 4) }} ?')"><img src='{{ asset('imagem/icon/delete.png') }}'></a>
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
                                        <a href="{{ url('mah/pedido/show/' . $pedido->id) }}"><img src='{{ asset('imagem/icon/view.png') }}'></a>
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
