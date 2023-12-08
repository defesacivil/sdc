@extends('layouts.pagina_master')
{{-- header --}}

    @section('header')

    <style>
        @page {
            size: A4;
            /* auto is the initial value */
            margin: 5%;
        }
    </style>

        <!-- breadcrumb -->
        <nav aria-label="breadcrumb" class="print">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/vistoria/menu') }}">Vistoria - Interdição</a></li>
                <li class="breadcrumb-item"><a href="{{ url('vistoria') }}">Vistoria</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cadastro Vistoria</li>
            </ol>
        </nav>
    @endsection

@section('content')
    <div class="container" style="background-color: #edf1ed">

        <div class="row">
            <div class="col">

                {{-- Não impressao dos botoes em PDF --}}
                @if(!isset($pdf))
                <p class=''>
                    <a class='btn btn-success btn-sm print' href='{{ url('vistoria') }}' title="Voltar para a página anterior">Voltar</a>
                    {{-- <a class='btn btn-primary btn-sm print' href='{{ url('send-email-vistoria/'.$vistoria->id.'/pdf') }}' title='Salvar Documento em PDF'>Salvar PDF</a> --}}
                    {{-- <a class='btn btn-warning btn-sm print' href='{{ url('send-email-vistoria/'.$vistoria->id.'/email') }}' title='Enviar Vistoria por E-mail'>Envio E-mail</a> --}}
                </p><br>
                @endif

                <p class="text-center h2">
                    RELATÓRIO DE VISTORIA DE ATENDIMENTO

                </p>
                <h4>Nº : {{ $vistoria->numero }}</h4>
                <h4>Município : {{ $vistoria->municipio->nome }}</h4>

                <br>
                <div class="row">
                    <div class="col">
                        <fieldset class="p-2 border">
                            <legend class="w-auto">CARACTERIZAÇÃO DA VISTORIA</legend>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Nome do Município : </h5>
                                </div>
                                <div class="p-3 border col">
                                    {{ $vistoria->municipio->nome }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Data da vistoria : </h5>
                                </div>
                                <div class="p-3 border col">
                                    {{ \Carbon\Carbon::parse($vistoria->dt_vistoria)->format('d/m/Y H:1:s') }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Tipo da Ocorrência : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->tp_ocorrencia }}
                                </div>
                                <div class="p-3 border col-md-3">
                                    <h5>Tipo de Imóvel : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->tp_imovel }}
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col">
                        <fieldset class="p-2 border">
                            <legend class="w-auto">CARACTERIZAÇÃO DOS MORADORES</legend>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Proprietário/Morador : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->prop }}
                                </div>
                                <div class="p-3 border col-md-3">
                                    <h5>Contato/Telefone : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->cel }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Número de Moradores : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->num_morador }}
                                </div>
                                <div class="p-3 border col-md-3">
                                    <h5>Há Idosos ?: </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->idosos == 0 ? 'Não' : 'Sim' }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Há Crianças ? : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->criancas == 0 ? 'Não' : 'Sim' }}
                                </div>
                                <div class="p-3 border col-md-3">
                                    <h5>Há Pessoas com Dificuldade de Locomoção ?: </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->pess_dif_loc == 0 ? 'Não' : 'Sim' }}
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <fieldset class="p-2 border">
                            <legend class="w-auto">LOCALIZAÇÃO DO IMÓVEL</legend>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Endereço do Imóvel : </h5>
                                </div>
                                <div class="p-3 border col">
                                    {{ $vistoria->endereco }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Bairro : </h5>
                                </div>
                                <div class="p-3 border col">
                                    {{ $vistoria->bairro }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Município da Vistoria : </h5>
                                </div>
                                <div class="p-3 border col">
                                    {{ $vistoria->municipio_dono->nome }}
                                </div>
                                <div class="p-3 border col-md-3">
                                    <h5>Cep : </h5>
                                </div>
                                <div class="p-3 border col">
                                    {{ $vistoria->cep }}
                                </div>
                            </div>

                            <div class="p-2 row">
                                <div class="p-3 border col-md-3">
                                    <h5>Latitude : </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->latitude }}
                                </div>
                                <div class="p-3 border col-md-3">
                                    <h5>Longitude: </h5>
                                </div>
                                <div class="p-3 border col-md-3">
                                    {{ $vistoria->longitude }}
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <fieldset class="p-3 border">
                            <legend class="w-auto">CARACTERÍSTICA DO TERRENO E INFRAESTRUTURA</legend>

                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Abastecimento de Água ? : </h5>
                                </div>
                                <div class="p-3 border col-md-9">
                                    {{ $vistoria->abast_agua }}
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Esgotamento Sanitário : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">
                                        @if ($vistoria->ck_esgo_sant_canalizado == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Canalizado</li>
                                        @endif
                                        @if ($vistoria->ck_esgo_sant_fossa_similar == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Fossa/Similar</li>
                                        @endif
                                        @if ($vistoria->ck_esgo_sant_superficie == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Em superfície</li>
                                        @endif
                                    </ul>

                                </div>
                            </div>

                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Sistema Drenagem Superficial ? : </h5>
                                </div>
                                <div class="p-3 border col-md-9">
                                    {{ $vistoria->sist_drenag }}
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Sistema Viário e de Acesso : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">
                                        @if ($vistoria->ck_sis_viar_acesso_estrada == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Estrada</li>
                                        @endif
                                        @if ($vistoria->ck_sis_viar_acesso_av_rua == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Avenida/Rua</li>
                                        @endif
                                        @if ($vistoria->ck_sis_viar_acesso_beco_viela == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Becos/ Vielas</li>
                                        @endif
                                        @if ($vistoria->ck_sis_viar_acesso_trilhas == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Trilhas</li>
                                        @endif
                                    </ul>

                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Tipo de Revestimentos : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">
                                        @if ($vistoria->ck_tp_revest_via_asfaldo == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Asfalto</li>
                                        @endif
                                        @if ($vistoria->ck_sis_viar_acesso_av_rua == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Paralelepípedo/Pedras</li>
                                        @endif
                                        @if ($vistoria->ck_tp_revest_via_n_asfalto == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Não Asfaltado</li>
                                        @endif
                                    </ul>

                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Condições de Acesso : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">
                                        @if ($vistoria->ck_cond_acesso_veicular == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Veicular</li>
                                        @endif
                                        @if ($vistoria->ck_cond_acesso_veicular4x4 == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Veicular 4x4</li>
                                        @endif
                                        @if ($vistoria->ck_cond_acesso_veicula2_rodas == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Veicular 2 Rodas</li>
                                        @endif
                                        @if ($vistoria->ck_cond_acesso_a_pe == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> A pé</li>
                                        @endif
                                    </ul>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Número de Moradias no Terreno : </h5>
                                </div>
                                <div class="p-3 border col-md-9">
                                    {{ $vistoria->nr_moradias }}
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Distância da Encosta : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">
                                        @if ($vistoria->ck_dist_encosta_menor_2_m == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Menor que 2 metros</li>
                                        @endif
                                        @if ($vistoria->ck_dist_encosta_2_4_m == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> de 2 a 4 metros</li>
                                        @endif
                                        @if ($vistoria->ck_dist_encosta_4_6_m == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> de 4 a 6 metros</li>
                                        @endif
                                        @if ($vistoria->ck_dist_encosta_maior_6_m == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Maior qie 6 metros</li>
                                        @endif

                                    </ul>

                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Material Construtivo : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">
                                        @if ($vistoria->ck_mat_constr_alvenaria == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Alvenaria</li>
                                        @endif
                                        @if ($vistoria->ck_mat_constr_madeira == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Madeira</li>
                                        @endif
                                        @if ($vistoria->ck_mat_contr_mist_plas_mad_lata == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Misto (Plástico/Madeirite/Lata)</li>
                                        @endif

                                    </ul>

                                </div>
                            </div>
                            <br>


                            <div class="row">
                                <div class="p-3 border col-md-3">
                                    <h5>Conservação Estrutural : </h5>
                                </div>
                                <div class="p-3 text-center border col-md-9">
                                    <ul class="list-group">

                                        @if ($vistoria->ck_cons_estr_baixa == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Baixa</li>
                                        @endif
                                        @if ($vistoria->ck_cons_estr_media == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Média</li>
                                        @endif
                                        @if ($vistoria->ck_cons_estr_alta == 1)
                                            <li class="list-group-item"><img width='20' src='{{ url('imagem/icon/check.png') }}'> Alta</li>
                                        @endif

                                    </ul>

                                </div>
                            </div>
                            <br>

                        </fieldset>
                    </div>
                </div>

                <br><br>
                <div class="row">
                    <div class="col">
                        <fieldset class="p-2 border">
                            <legend class="w-auto">CARACTERÍSTICA DAS ANOMALIAS ESTRUTURAIS E PROCESSOS GEODINÂMICOS</legend>
                            <div class="p-2 row">
                                <div class="col">
                                    <div class="p-2 row">

                                        <div class="p-3 border col-md-3">
                                            <h5>Elementos Estruturais : </h5>
                                        </div>
                                        <div class="p-3 text-center border col-md-9">
                                            <ul class="list-group">
                                                <li class="list-group-item">{!! $vistoria->ck_el_str_trinc_pilar == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Trincas nos Pilares |" : '' !!}
                                                    {!! $vistoria->ck_el_str_trinc_viga == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Trinca em Vigas |" : '' !!}
                                                    {!! $vistoria->ck_el_str_trinc_lage == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Trinca na Lage |" : '' !!} </li>

                                                <li class="list-group-item">{!! $vistoria->ck_el_str_incl_muro == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Inclinação de Muros |" : '' !!}
                                                    {!! $vistoria->ck_el_str_mur_pared_def == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Muros/Paredes Deformadas |" : '' !!}
                                                    {!! $vistoria->ck_el_str_cic_desliza == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Cicatriz de Deslizamento |" : '' !!} </li>

                                                <li class="list-group-item">{!! $vistoria->ck_el_str_degr_abat == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Degraus de Abatimento |" : '' !!}
                                                    {!! $vistoria->ck_el_str_inclin_arv == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Inclinação de Árvores |" : '' !!}
                                                    {!! $vistoria->ck_el_str_incl_poste == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Inclinação de Postes |" : '' !!} </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="p-3 border col-md-3">
                                            <h5>Elementos Construtivos : </h5>
                                        </div>
                                        <div class="p-3 text-center border col-md-9">
                                            <ul class="list-group">
                                                <li class="list-group-item">{!! $vistoria->ck_el_constr_trinc_parede == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Trincas nas Paredes |" : '' !!}
                                                    {!! $vistoria->ck_el_constr_trinc_piso == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Trinca no Piso |" : '' !!}
                                                    {!! $vistoria->ck_el_constr_trinc_muro == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Trincas no Muro |" : '' !!} </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <br>


                                    <div class="row">
                                        <div class="p-3 border col-md-3">
                                            <h5>Agentes Potencializadores : </h5>
                                        </div>
                                        <div class="p-3 text-center border col-md-9">
                                            <ul class="list-group">
                                                <li class="list-group-item">{!! $vistoria->ck_ag_pot_lixo_entulho == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Lixo/Entulho |" : '' !!}
                                                    {!! $vistoria->ck_ag_pot_aterr_bot_fora == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Aterro/Bota Fora |" : '' !!}
                                                    {!! $vistoria->ck_ag_pot_veg_inadeq == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Vegeração Inadequada |" : '' !!} </li>

                                                <li class="list-group-item">{!! $vistoria->ck_ag_pot_cort_vert == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Cortes Verticalizados |" : '' !!}
                                                    {!! $vistoria->ck_ag_pot_tubl_romp == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Tubulação Rompida |" : '' !!}
                                                    {!! $vistoria->ck_ag_pot_conc_flux_superfic == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Concentração de Fluxo Superficial |" : '' !!} </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="p-3 border col-md-3">
                                            <h5>Processos Geodinámicos : </h5>
                                        </div>
                                        <div class="p-3 text-center border col-md-9">
                                            <ul class="list-group">
                                                <li class="list-group-item">{!! $vistoria->ck_proc_geo_desliza == 1 ? " <img width='20' src='" . url('imagem/icon/check.png') . "'> Deslizamento |" : '' !!}
                                                    {!! $vistoria->ck_proc_geo_qued_rolam_bloc == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Queda Rolamento de Blocos |" : '' !!}
                                                    {!! $vistoria->ck_proc_geo_inundac == 1 ? "<img width='20' src='" . url('imagem/icon/check.png') . "'> Inundações |" : '' !!} </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>


        <br><br>
        <div class="row">
            <div class="col">
                <fieldset class="p-2 border">
                    <legend class="w-auto">VULNERABILIDADE</legend>

                    @if ($vistoria->ck_vuln_baixa == 1)
                        <div class="row align-items-center" style="background-color: #CEF6CE;">
                            <div class="p-2 text-center col-md-3">Baixa</div>
                            <div class="col-md-9">Danos Estruturais não previsíveis</div>
                        </div>
                    @endif
                    @if ($vistoria->ck_vuln_media == 1)
                        <div class="row align-items-center" style="background-color: #F3F781;">
                            <div class="p-2 text-center col-md-3">Média</div>
                            <div class="col-md-9">Danos esperados relacionados a trincas e colapso nas paredes</div>
                        </div>
                    @endif
                    @if ($vistoria->ck_vuln_alta == 1)
                        <div class="row align-items-center" style="background-color: #FE642E">
                            <div class="p-2 text-center col-md-3">Alta</div>
                            <div class="col-md-9">Danos Estruturais esperados com excessivas deformacoes das estruturas, colapso parcial dos domicílios</div>
                        </div>
                    @endif
                    @if ($vistoria->ck_vuln_muito_alta == 1)
                        <div class="row align-items-center" style="background-color: #DF3A01">
                            <div class="p-2 text-center col-md-3">Muito Alta</div>
                            <div class="col-md-9">Danos estruturais esperados com comprometimento integral estrutural e possibilidade de colapso total dos domicílios</div>
                        </div>
                    @endif

                </fieldset>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col">
                <fieldset class="p-2 border">
                    <legend class="w-auto">CLASSIFICAÇÃO DE RISCO</legend>

                    @if ($vistoria->ck_clas_risc_baixa == 1)
                        <div class="row align-items-center" style="background-color: #CEF6CE;">
                            <div class="p-2 text-center col-md-3">Baixa</div>
                            <div class="col-md-9">Manutenção do uso e ocupação</div>
                        </div>
                    @endif
                    @if ($vistoria->ck_clas_risc_media == 1)
                        <div class="row align-items-center" style="background-color: #F3F781;">
                            <div class="p-2 text-center col-md-3">Média</div>
                            <div class="col-md-9">Necessidade obras de restauração</div>
                        </div>
                    @endif
                    @if ($vistoria->ck_clas_risc_alta == 1)
                        <div class="row align-items-center" style="background-color: #FE642E">
                            <div class="p-2 text-center col-md-3">Alta</div>
                            <div class="col-md-9">Interdição temporária/Necessidade de obras emergênciais</div>
                        </div>
                    @endif
                    @if ($vistoria->ck_clas_risc_muito_alta == 1)
                        <div class="row align-items-center" style="background-color: #DF3A01">
                            <div class="p-2 text-center col-md-3">Muito Alta</div>
                            <div class="col-md-9">Interdição/Condenação</div>
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
    </div>

    <div class="container">
        
        {{-- Imagens Elementos Estruturais --}}
        @if (count($img_el_estrs) > 0)
            <div class="page-break"><hr></div>
            <div class="row">
                <div class="col">
                    <fieldset class="p-2 border">
                        <legend class="w-auto"> Imagens Elementos Estruturais</legend>

                        <div class="p-3 row">
                            @foreach ($img_el_estrs as $img_el_estr)
                                <div class="p-3 text-center border col-md-6 img-rel">
                                    <img width="320" src='{{ asset('storage/' . $img_el_estr) }}'>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </div>
        @endif

        {{-- Imagens Elementos Construtivos --}}
        @if (count($img_el_constrs) > 0)
            <div class="page-break"><hr></div>
            <div class="row">
                <div class="col">
                    <fieldset class="p-2 border">
                        <legend class="w-auto"> Imagens Elementos Construtivos</legend>
                        <div class="p-3 row">
                            @foreach ($img_el_constrs as $img_el_constr)
                                <div class="p-3 text-center border col-md-6 img-rel">
                                    <img class="img-fluid" width="400px" src='{{ asset('storage/' . $img_el_constr) }}'>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </div>
        @endif

        {{-- Imagens Agentes Potencializadores --}}
        @if (count($img_ag_potens) >0)
            <div class="page-break"><hr></div>
            <div class="row">
                <div class="col">
                    <fieldset class="p-2 border">
                        <legend class="w-auto"> Imagens Agentes Potencializadores</legend>

                        
                        <div class="p-3 row">
                            @foreach ($img_ag_potens as $img_ag_poten)
                                <div class="p-3 text-center border col-md-6 img-rel">
                                    <img width="320" src='{{ asset('storage/'. $img_ag_poten) }}'>
                                </div>
                            @endforeach
                        </div>

                    </fieldset>
                </div>
            </div>
        @endif

        {{-- Imagens Processos Geondinâmicos --}}
        @if (count($img_proc_geos) >0)
            <div class="page-break"><hr></div>
            <div class="row">
                <div class="col">
                    <fieldset class="p-2 border">
                        <legend class="w-auto"> Imagens Processos Geondinâmicos</legend>

                        <div class="p-3 row">
                            @foreach ($img_proc_geos as $img_proc_geo)
                                <div class="p-3 text-center border col-md-6 img-rel">
                                    <img width="320" src='{{ asset('storage/'. $img_proc_geo) }}'>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            </div>
        @endif
    </div>

    
    <!-- interdicao -->
    <div class="container interdicao-text">
        <div class="col-md-12">
            @if ($interdicao)
            <div class="page-break"></div>
                <p class="m-4 text-center h2">
                    TERMO DE INTERDIÇÃO
                        Nº 0{{ $interdicao->numero }} 
                </p>

                <div class="row">
                    <div class="p-3 border col-md-12">
                        <p class="fs-3" style="font-size: 15pt">
                            Vistoria realizada em <strong>{{ \Carbon\Carbon::parse($interdicao->dt_registro)->format('d/m/Y') }} </strong> equipe de Proteção e Defesa Civil de <strong>{{ $interdicao->municipio->nome }}/MG</strong>, relacionado com o Relatório de Vistoria nº
                            <strong>{{ $interdicao->ids_vistoria }}/{{ \Carbon\Carbon::parse($interdicao->dt_registr)->year }}</strong>.
                        </p>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="p-3 border col-md-12">
                        <p class="text-center">
                            <legend>Local de Vistoria</legend>
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Logradouro:</h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $interdicao->endereco }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <h5>Bairro : </h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $interdicao->bairro }}</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <h4>Municipio : </h5>
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $interdicao->municipio_id }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="p-3 border col-md-12">
                        <p class="text-center">
                            <legend>Indentificação do Notificado</legend>
                        </p>
                        <h5>Nome:_______________________________________________ RG:______________________________</h5>
                        <h5>Endereço:________________________________________________________________ Nº:_________</h5>
                        <h5>Complemento:___________________________ Bairro:_______________________________________</h5>
                        <h5>Cidade:____________________________________ Contato/Telefone:_________________________</h5>

                    </div>
                </div>

                <br>
                <div class="border row">
                    <div class="text-justify col-md-12 p-0">
                        <p class="text-center">
                            <legend>Motivo da Interdição</legend>
                        </p>

                        <p class="pl-3 p-2" style="font-size: 10pt; text-align: justify;">Em decorrência das anomalias constatadas na edificação/solo pelo vistoriador de Proteção e
                            Defesa Civil e relatadas no relatório de vistoria nº <strong>{{ $interdicao->ids_vistoria }}/{{ \Carbon\Carbon::parse($interdicao->dt_registr)->year }}</strong>, fica INTERDITADO o imóvel da
                            <strong>{{ $interdicao->endereco . ' ' . $interdicao->bairro }} </strong> manifestações
                            patológicas comprometem o desempenho da construção e colocam em risco à vida de seus
                            moradores/usuários.
                            O notificado deve providenciar a remoção imediata de todos os moradores e seus usuários,
                            devendo a edificação permanecer INTERDITADA até que as condições de segurança e
                            habitabilidade sejam restabelecidas.
                            O vistoriador atesta que a presente interdição obedece criteriosamente aos princípios da Lei
                            Federal Nº 12.608, de 10 de abril de 2012, que aduz no Art.2º a seguinte redação:
                            Art. 2º É dever da União, dos Estados, do Distrito Federal e dos Municípios adotar as medidas
                            necessárias à redução dos riscos de desastre.
                            § 2o A incerteza quanto ao risco de desastre não constituirá óbice para a adoção das medidas
                            preventivas e mitigadoras da situação de risco.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col"><br><br><br>
                        <p class="">_________________________________________________________</p>
                            <span class="m-50">Nome:</span>
                    </div>
                    <div class="col-md-4"></div>
                </div>
        </div>
        @endif
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
