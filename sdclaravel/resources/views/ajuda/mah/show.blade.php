@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('mah/busca') }}">Busca Pedido AH</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualização Pedido Ajuda Humanitária</li>
        </ol>
    </nav>

@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 text-center">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('mah/busca') }}>Voltar</a></p>
            </div> 
        </div>

        <div class="row">
            <div class="col-12">

                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <td>Número do Pedido</td>
                        <td>{{ $pedido->numero }}/{{$pedido->ano}}</td>
                    </tr>
                    <tr>
                        <td>Data de Entrada no Sistema</td>
                        <td>{{ $pedido->data_entrada_sistema }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->municipio_id }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->regiao_id }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->nome_coordenador }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->tel_coordenador }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->cel_coordenador }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->email_coordenador }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->nome_prefeito }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->tel_prefeito }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->cel_prefeito }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->email_prefeito }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->cobrade_id }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->pop_atendida }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->decreto_se_ecp_vig }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->numero_decreto }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->data_vigencia }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->tipo_decreto }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->esforcos_realizados }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->data_hora_envio }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->status }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $pedido->ano }}</td>
                    </tr>
                </table>
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
