@extends('layouts.pagina_master')

{{-- header --}}
@section('header')
    <style>
        @media print {
            #breadcrumb {
                display: none;
            }

            #btn {
                display: none;
            }
        }
    </style>


    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('compdec/vistoria') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row flex-fill m-4">
        <div class="flex-fill logo"></div>
        <div class="flex-fill logo">
            <img class="logo" width="100" src="{{ url('/imagem/DEFESACIVILMG_400.png') }}" alt="">
        </div>
        <div class="flex-fill logo"></div>
        <div class="flex-fill text-right logo">
            <img class="logo" width="100" src="{{ url('/imagem/brasao.png') }}" alt="">
        </div>
        <div class="flex-fill logo"></div>

        @can('cedec')
            <div class="col-md-12">
                <p class="pt-4" id="btn">
                    <a class='btn btn-success btn-sm' href={{ url('vistoria') }} title="Voltar para página Index">Voltar</a>
                    <a class='btn btn-primary btn-sm' onclick="window.print()" title="Imprimir Documento">Imprimir</a>
                </p>
                <p class="text-center m-4">
                    <legend>TERMO DE VISTORIA</legend>
                </p>

                <legend>1) - DADOS GERAIS</legend>
                <div class="table table-responsive table">
                    <table class="table table-striped border">
                        <tr>
                            <th>Número :</th>
                            <th>{{ $vistoria->numero }}</th>
                        </tr>
                        <tr>
                            <th>Prorietário / Morador :</th>
                            <th>{{ $vistoria->prop }}</th>
                        </tr>
                        <tr>
                            <th>Endereço do Local da Vistoria :</th>
                            <th>{{ $vistoria->endereco }}</th>
                        </tr>
                        <tr>
                            <th>Município :</th>
                            <th>{{ $vistoria->municipio->nome }}</th>
                        </tr>
                        <tr>
                            <th>Contato Telefônico :</th>
                            <th>{{ $vistoria->tel }}</th>
                        </tr>
                        <tr>
                            <th>Data da Vistoria :</th>
                            <th>{{ $vistoria->dt_vistoria }}</th>
                        </tr>
                        <tr>
                            <th>Tipo da Ocorrência :</th>
                            <th>{{ $vistoria->tp_ocorrencia }}</th>
                        </tr>
                        <tr>
                            <th>Tipo do Imóvel :</th>
                            <th>{{ $vistoria->tp_imovel }}</th>
                        </tr>

                    </table>
                </div>

                <legend>2) - CONDIÇÃO DO LOCAL</legend>
                <div class="table table-responsive table">
                    <table class="table table-striped border">
                        <!-- Trincas nos Elementos Estruturais -->
                        <tr>
                            <th><strong>Trincas nos Elementos Estruturais</strong></th>
                            <th><strong>Sim</strong></th>
                            <th><strong>Não</strong></th>
                        </tr>
                        <tr>
                            <td>Pilar</td>
                            <td>{{ $vistoria->tr_pilar == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->tr_pilar == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Viga</td>
                            <td>{{ $vistoria->tr_viga == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->tr_viga == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Laje</td>
                            <td>{{ $vistoria->tr_laje == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->tr_laje == 0 ? 'Não' : '-' }}</td>
                        </tr>

                        {{-- Trincas nos Elementos Construtivos --}}
                        <tr>
                            <td colspan="3">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <th><strong> Trincas nos Elementos Construtivos</strong></th>
                            <th><strong>Sim</strong></th>
                            <th><strong>Não</strong></th>
                        </tr>
                        <tr>
                            <td>Parede</td>
                            <td>{{ $vistoria->parede == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->parede == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Piso</td>
                            <td>{{ $vistoria->piso == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->piso == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Muro</td>
                            <td>{{ $vistoria->muro == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->muro == 0 ? 'Não' : '-' }}</td>
                        </tr>

                        {{-- Risco de Colapso --}}
                        <tr>
                            <td colspan="3">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <th><strong>Risco de Colapso</strong></th>
                            <th><strong>Sim</strong></th>
                            <th><strong>Não</strong></th>
                        </tr>
                        <tr>
                            <td>Elemento Estruturais</td>
                            <td>{{ $vistoria->r_col_estrutural == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_col_estrutural == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Elementos Construtivos</td>
                            <td>{{ $vistoria->r_col_construtivo == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_col_construtivo == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Riscos Externos</td>
                            <td>{{ $vistoria->r_externo == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_externo == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Vazamentos</td>
                            <td>{{ $vistoria->r_vazamento == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_vazamento == 0 ? 'Não' : '-' }}</td>
                        </tr>

                        {{-- Risco de Colapso --}}
                        <tr>
                            <td colspan="3">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <th><strong>Risco de Colapso</strong></th>
                            <th><strong>Sim</strong></th>
                            <th><strong>Não</strong></th>
                        </tr>
                        <tr>
                            <td>Elemento Estruturais</td>
                            <td>{{ $vistoria->r_col_estrutural == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_col_estrutural == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Elementos Construtivos</td>
                            <td>{{ $vistoria->r_col_construtivo == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_col_construtivo == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Riscos Externos</td>
                            <td>{{ $vistoria->r_externo == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_externo == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Vazamentos</td>
                            <td>{{ $vistoria->r_vazamento == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->r_vazamento == 0 ? 'Não' : '-' }}</td>
                        </tr>


                        {{-- Agentes Externos --}}
                        <tr>
                            <td colspan="3">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <th><strong>Agentes Externos</strong></th>
                            <th><strong>Sim</strong></th>
                            <th><strong>Não</strong></th>
                        </tr>
                        <tr>
                            <td>Deformações no Muro</td>
                            <td>{{ $vistoria->ae_muro == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->ae_muro == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Ruptura de Redes Hidráulicas</td>
                            <td>{{ $vistoria->ae_rede_hidraulica == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->ae_rede_hidraulica == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Deslizamentos de Encosta/Talude</td>
                            <td>{{ $vistoria->ae_deslizamento == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->ae_deslizamento == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Inundação</td>
                            <td>{{ $vistoria->ae_inundacao == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->ae_inundacao == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Outros</td>
                            <td>{{ $vistoria->ae_outros == 1 ? 'Sim' : '-' }}</td>
                            <td>{{ $vistoria->ae_outros == 0 ? 'Não' : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Outras Anomalias ( Detalhar )</td>
                            <td colspan="3">{{ $vistoria->ae_outros_txt }}</td>
                        </tr>
                    </table>

                    <br>
                    <!-- 3 SEÇÃO  -->
                    <legend>3) - CARACTERIZAÇÃO DO LOCAL - (Relatar qual a condição do terreno onde está a edificação)</legend>
                    <div style="min-height:150px" class="border p-2">
                        <div class="h-100">
                            {{ $vistoria->caracterizacao }}
                        </div>
                    </div>

                    <br>
                    <!-- 4 SEÇÃO  -->
                    <legend>4) - PARECER/CONCLUSÃO</legend>
                    <div style="min-height:150px"  class="border p-2">
                        <div class="h-100">
                            {{ $vistoria->parecer }}
                        </div>
                    </div>

                    <br>
                    <!-- 5 SEÇÃO  -->
                    <legend>5) - RECOMENDAÇÃO/CONSIDERAÇÃO</legend>
                    <h5>5.1 Providências imediatas</h5>
                    <div style="min-height:100px"  class="border p-2">
                        <div class="h-100">
                            {{ $vistoria->rec_prov_imediata }}
                        </div>
                    </div>

                    <h5>5.2 Medidas para recuperação</h5>
                    <div style="min-height:100px" class="border">
                        <div class="h-100">
                            {{ $vistoria->rec_medidas_recuperacao }}
                        </div>
                    </div>

                    <br>
                    <!-- 6 SEÇÃO  -->
                    <legend>6) - CONSIDERAÇÕES FINAIS</legend>
                    <div style="min-height:150px"  class="border p-2">
                        <div class="h-100">
                            {{ $vistoria->considera_finais }}
                        </div>
                    </div>

                    <br>
                    <!-- 7 SEÇÃO  -->
                    <legend>7) - RESPONSÁVEL/VISTORIADOR</legend>
                    <div style="min-height:50px" class="border p-2">
                        <div class="h-100">
                            {{ $vistoria->resp_vistoriador }}
                        </div>
                    </div>
                @endcan


                Obs: colocar o endereco, e verificar o municipio na entrada de novos registros, escolher o municipío


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
