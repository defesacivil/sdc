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
    <div class="container p-3 border min hv-100" style="background-color:#e9ecef;">
        <div class="row p-3">

            <div class="col-md-12 text-center">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('mah/busca') }}>Voltar</a></p>
            </div>
        </div>

        <div class="row rounded shadow bd-body">

            <div class="col">

                <p class="text-center">
                    <legend>Dados do Pedido de Ajuda Humanitária</legend>
                </p>

                <div class="row p-3">
                    <div class="col"><label>Códido do Pedido :</label></div>
                    <div class="col">{{ $pedido->id }}</div>
                </div>

                <div class="row p-3">
                    <div class="col"><label>Número do Pedido :</label></div>
                    <div class="col">{{ $pedido->numero }}/{{ $pedido->ano }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Data de Entrada do Pedido :</label></div>
                    <div class="col">{{ $pedido->data_entrada_sistema }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Município :</label></div>
                    <div class="col">{{ $pedido->municipio_id }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Região de Defesa Civil :</label></div>
                    <div class="col">{{ $pedido->regiao_id }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Coordenador Municipal :</label></div>
                    <div class="col">{{ $pedido->nome_coordenador }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Telefone do Coordenador :</label></div>
                    <div class="col">{{ $pedido->tel_coordenador }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Celular do Coordenador :</label></div>
                    <div class="col">{{ $pedido->cel_coordenador }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>E-mail do Coordenador :</label></div>
                    <div class="col">{{ $pedido->email_coordenador }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Nome do Prefeito :</label></div>
                    <div class="col">{{ $pedido->nome_prefeito }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Telefone do Prefeito :</label></div>
                    <div class="col">{{ $pedido->tel_prefeito }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Celular do Prefeito :</label></div>
                    <div class="col">{{ $pedido->cel_prefeito }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>E-mail do Prefeito :</label></div>
                    <div class="col">{{ $pedido->email_prefeito }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Código Brasileiro de Desastres :</label></div>
                    <div class="col">{{ $pedido->cobrade->codigo }} / {{ $pedido->cobrade->descricao }}</div>
                </div>
                <div class="row p-3">
                    <div class="col"><label>Número de Pessoas a Serem Atendidas :</label></div>
                    <div class="col">{{ $pedido->pop_atendida }}</div>
                </div>

                @if ($pedido->decreto_se_ecp_vig == 1)
                    <div class="row p-3">
                        <div class="col"><label>Existe Decreto Vigente : ?</label></div>
                        <div class="col">{{ $pedido->decreto_se_ecp_vig == 1 ? 'Sim' : 'Não' }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col"><label>Número do Decreto :</label></div>
                        <div class="col">{{ $pedido->numero_decreto }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col"><label>Data de Vigência do Decreto :</label></div>
                        <div class="col">{{ $pedido->data_vigencia }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col"><label>Tipo do Decreto :</label></div>
                        <div class="col">{{ $pedido->tipo_decreto }}</div>
                    </div>
                @endif
                <div class="row p-3">
                    <div class="col"><label>Esforços Realizados Pelo Município : </label></div>
                    <div class="col text-justfy">{{ $pedido->esforcos_realizados }}</div>
                </div>

            </div>
            <div class="row">

                <div class="col">
                    <hr>

                    <!-- MATERIAIS -->
                    @if ($materiais)

                        <p class="text-center">
                            <legend>Materiais do Pedido </legend>
                        </p>

                        <table class="table table-bordered table-primary">
                            <tr>
                                <th>#</th>
                                <th>Material</th>
                                <th>Quantidade</th>
                                <th>Famílias Atendidas</th>
                            </tr>

                            @foreach ($materiais as $key => $material)
                                <tr>
                                    <td>{{ $material->$key + 1 }}</td>
                                    <td>{{ $material->codigo }} / </td>
                                    <td>{{ $material->quantidade }}</td>
                                    <td>{{ $material->familia_at }}</td>
                                </tr>
                        </table>
                    @endforeach
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col">

                    <!-- ANEXOS -->
                    @if ($anexos)
                        <p class="text-center">
                            <legend>Arquivos Anexos </legend>
                        </p>

                        <table class="table table-bordered table-primary">
                            <tr>
                                <th>#</th>
                                <th>Material</th>
                                <th>Quantidade</th>
                                <th>Famílias Atendidas</th>
                            </tr>


                            @foreach ($anexos as $key => $anexo)
                                <tr>
                                    <td>{{ $material->$key + 1 }}</td>
                                    <td>{{ $anexo->data }} / </td>
                                    <td>{{ $material->quantidade }}</td>
                                    <td>{{ $material->familia_at }}</td>
                                </tr>
                                <div class="row border p-3">
                                    <div class="row">
                                        <div class="col">#</div>
                                        <div class="col">{{ $anexo->$key + 1 }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">Data Upload</div>
                                        <div class="col">{{ $anexo->data }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col">Nome Anexo</div>
                                        <div class="col">{{ $anexo->filename }}</div>
                                    </div>
                                </div>
                            @endforeach
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col">




                    <hr>
                    <!-- DESPACHOS -->
                    @if ($despachos)
                        <p class="text-center">
                            <legend>Despachos </legend>
                        </p>

                        @foreach ($despachos as $key => $despacho)
                            <div class="row border p-3">
                                <div class="row">
                                    <div class="col">#</div>
                                    <div class="col">{{ $despacho->$key + 1 }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">Data</div>
                                    <div class="col">{{ $despacho->data }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">Parecer/Despacho</div>
                                    <div class="col">{{ $despacho->despacho }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">Tipo</div>
                                    <div class="col">{{ $despacho->situacao }}</div>
                                </div>

                            </div>
                        @endforeach
                    @endif

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
