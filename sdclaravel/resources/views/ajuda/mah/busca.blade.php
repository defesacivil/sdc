@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    @php
        $tab = isset($active_tab) ? $active_tab : 'dados_pedidos-tab';
    @endphp

    {{ Session::get('active-tab') }}
    <!-- ATIVAR TAB APOS RELOAD -->
    @if (Session::has('active_tab'))
        @php
            $tab = Session::get('active_tab');
        @endphp
    @else
        @php
            $tab = '#-dados_pedidos-tab';
        @endphp
    @endif

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/mah') }}">Pedido Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Busca Pedido AH</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class='text-center'><a class='btn btn-success btn-sm' href='{{ url('mah') }}'>Voltar</a></p><br>
                <div>
                </div>
                @can('cedec')
                    <div class="row">
                        <div class="col-md-6">

                            {{ Form::open(['url' => 'mah/busca']) }}
                            {{ Form::token() }}

                            {{ Form::label('txtBusca', 'Busca') }} :
                            {{ Form::text('txtBusca', '', ['class' => 'form form-control form-control-sm col-12']) }}
                            <br>

                            {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary btn-sm']) }}

                            {{ Form::close() }}

                        </div>
                    </div>
                    <br>

                    @if (isset($pedidos))
                        <table class='table table-bordered table-sm'>
                            <tr>
                                <th>Num</th>
                                <th>Data Entrada</th>
                                <th>Municipio</th>
                                <th>Cobrade</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->numero }}-{{ substr($pedido->data_entrada_sistema, 0, 4) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pedido->data_entrada_sistema)->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $pedido->municipio }}</td>
                                    <td>{{ $pedido->descricao_cobrade }}</td>
                                    <td>{{ status_pedido_ah($pedido->status) }}</td>
                                    <td>
                                        {{-- Editar --}}
                                        <a href='{{ url('mah/pedido/edit', ['id' => $pedido->id]) }}'><img width="25px;"
                                                src='{{ asset('/imagem/icon/editar.png') }}' alt=""
                                                title="Editar / Despachar / Tramitar Processo"></a>

                                        {{-- Visualizar --}}
                                        <a href='{{ url('mah/pedido/show', ['id' => $pedido->id]) }}'><img width="25px;"
                                                src='{{ asset('/imagem/icon/view.png') }}' alt=""
                                                title="Visualizar Processo"></a>

                                        {{-- Impressao --}}
                                        <a href='{{ url('mah/pedido/print', ['id' => $pedido->id]) }}'><img width="25px;"
                                                src='{{ asset('/imagem/icon/print.png') }}' alt=""
                                                title="Impressão Processo"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                @endcan
                {{-- fim cedec --}}

                @can('compdec')

                    <br>

                    {{ $pedidos_compdec }}
                    @if (isset($pedidos_compdec))
                        <table class='table table-bordered table-sm'>
                            <tr>
                                <th>Número</th>
                                <th>Data Entrada</th>
                                <th>Municipio</th>
                                <th>Cobrade</th>
                                <th>Status</th>
                                <th>Opções</th>
                            </tr>
                            @foreach ($pedidos_compdec as $pedido)
                                <tr>
                                    <td>{{ $pedidos_compdec->numero }}-{{ substr($pedidos_compdec->data_entrada_sistema, 0, 4) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($pedidos_compdec->data_entrada_sistema)->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td>{{ $pedidos_compdec->municipio }}</td>
                                    <td>{{ $pedidos_compdec->descricao_cobrade }}</td>
                                    <td>{{ status_pedidos_compdec_ah($pedidos_compdec->status) }}</td>
                                    <td>
                                        <a href='{{ url('mah/pedido/edit', ['id' => $pedidos_compdec->id]) }}'><img
                                                src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                @endcan
                {{-- fim cedec --}}

            </div>

        </div>
    </div>


@stop

@section('css')
@stop

@section('code')
