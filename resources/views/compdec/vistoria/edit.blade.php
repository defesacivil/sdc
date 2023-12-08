@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vistoria/menu') }}">Vistoria - Interdição</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vistoria') }}">Vistoria</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro Vistoria</li>
        </ol>
    </nav>
@endsection
@section('content')

    <div class="container">

        <div class="row">
            <div class="col">

                <p class='text-center'><a class='btn btn-success btn-sm' href='{{ url('vistoria') }}'>Voltar</a></p><br>

                <p class="text-center">
                    <legend>RELATÓRIO DE VISTORIA DE ATENDIMENTO</legend>
                </p>
                <h4>Nº {{ $vistoria->numero }}/<?= date('Y') ?></h4>

                {{ Form::open(['url' => '/vistoria/update']) }}
                {{ Form::token() }}
                {{ Form::hidden('municipio_id', $vistoria->municipio_id, ['maxlenght' => '6']) }}
                {{ Form::hidden('numero', $vistoria->numero, ['maxlenght' => '15']) }}
                {{ Form::hidden('id', $vistoria->id, ['maxlenght' => '15']) }}


                <br>
                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">CARACTERIZAÇÃO DA VISTORIA</legend>
                            <div class="col p-2">
                                {{ Form::label('dt_vistoria', 'Data da vistoria') }} :
                                {{ Form::input('dateTime-local', 'dt_vistoria', $vistoria->dt_vistoria, ['class' => 'form form-control', 'value' => old('dt_vistoria'), 'id' => 'dt_vistoria']) }}
                            </div>
                            <div class="col p-2">
                                {{ Form::label('tp_ocorrencia', 'Tipo da Ocorrência') }} :
                                {{ Form::select(
                                    'tp_ocorrencia',
                                    [
                                        'Normal' => 'Normal',
                                        'Emergencial' => 'Emergencial',
                                    ],
                                    $vistoria->tp_ocorrencia,
                                    ['class' => 'form form-control', 'id' => 'tp_ocorrencia', 'maxlength' => '50'],
                                ) }}
                            </div>
                            <div class="col p-2">
                                {{ Form::label('tp_imovel', 'Tipo de Imóvel') }} :
                                {{ Form::select(
                                    'tp_imovel',
                                    [
                                        'Casa' => 'Casa',
                                        'Apartamento' => 'Apartamento',
                                        'Predio' => 'Predio',
                                        'Galpão' => 'Galpão',
                                        'Lote' => 'Lote',
                                        'Praça' => 'Praça',
                                    ],
                                    $vistoria->tp_imovel,
                                    ['class' => 'form form-control', 'id' => 'tp_imovel', 'placeholder' => ''],
                                ) }}
                            </div>
                        </fieldset>
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">CARACTERIZAÇÃO DOS MORADORES</legend>
                            <div class="col-md-12 p-2">
                                {{ Form::label('prop', 'Proprietário/Morador') }} :
                                {{ Form::text('prop', $vistoria->prop, ['class' => 'form form-control', 'maxlenght' => '70']) }}
                            </div>
                            <div class="row p-2">
                                <div class="col p-2">
                                    {{ Form::label('cel', 'Contato/Telefone') }}:
                                    {{ Form::text('cel', $vistoria->cel, ['class' => 'form form-control', 'id' => 'tel', 'maxlength' => '15', 'placehold' => 'Telefone de Contato']) }}
                                </div>

                            </div>
                            <div class="col-md-12 p-2">
                                {{ Form::label('num_morador', 'Número de Moradores') }} :
                                {{ Form::number('num_morador', $vistoria->num_morador, ['class' => 'form form-control', 'maxlength' => '4']) }}

                            </div>

                            <div class="col-md-12 p-2">
                                {{ Form::label('idosos', 'Há Idosos ?') }} :
                                {{ Form::select('idosos', ['1' => 'Sim', '0' => 'Não'], $vistoria->idosos, ['class' => 'form form-control', 'id' => 'idosos', 'placeholder' => '']) }}
                            </div>

                            <div class="col-md-12 p-2">
                                {{ Form::label('criancas', 'Há Crianças ?') }} :
                                {{ Form::select('criancas', ['1' => 'Sim', '0' => 'Não'], $vistoria->criancas, ['class' => 'form form-control', 'id' => 'criancas', 'placeholder' => '']) }}
                            </div>

                            <div class="col-md-12 p-2">
                                {{ Form::label('pess_dif_loc', 'Há Pessoas com Dificuldade de Locomoção ?') }} :
                                {{ Form::select('pess_dif_loc', ['1' => 'Sim', '0' => 'Não'], $vistoria->pess_dif_loc, ['class' => 'form form-control', 'id' => 'pess_dif_loc', 'placeholder' => '']) }}
                            </div>
                        </fieldset>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">LOCALIZAÇÃO DO IMÓVEL</legend>
                            <div class="col-md-12 p-2">
                                {{ Form::label('endereco', 'Endereço do Imóvel') }} :
                                {{ Form::text('endereco', $vistoria->endereco, ['class' => 'form form-control', 'id' => 'endereco', 'maxlength' => '110', 'placeholder' => 'Endereço do Imóvel']) }}
                            </div>

                            <div class="col-md-12 p-2">
                                {{ Form::label('bairro', 'Bairro') }} :
                                {{ Form::text('bairro', $vistoria->bairro, ['class' => 'form form-control', 'id' => 'bairro', 'maxlength' => '50', 'placeholder' => 'Bairro']) }}
                            </div>

                            <div class="row p-2">
                                <div class="col-md-8 p-2">
                                    {{ Form::label('nom_municipio', 'Município') }} :
                                    {{ Form::text('nom_municipio', $vistoria->nom_municipio, ['class' => 'form form-control', 'id' => 'nom_municipio', 'maxlength' => '70', 'placeholder' => 'Município']) }}
                                </div>
                                <div class="col-md-4 p-2">
                                    {{ Form::label('cep', 'Cep') }} :
                                    {{ Form::text('cep', $vistoria->cep, ['class' => 'form form-control', 'id' => 'cep', 'maxlength' => '15', 'placeholder' => 'Cep']) }}
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col-md-6 p-2">
                                    {{ Form::label('latitude', 'Latitude') }} :
                                    {{ Form::text('latitude', $vistoria->latitude, ['class' => 'form form-control', 'id' => 'latitude', 'maxlength' => '10', 'placeholder' => 'Latitude']) }}
                                </div>
                                <div class="col-md-6 p-2">
                                    {{ Form::label('longitude', 'Longitude') }} :
                                    {{ Form::text('longitude', $vistoria->longitude, ['class' => 'form form-control', 'id' => 'longitude', 'maxlength' => '10', 'placeholder' => 'Longitude']) }}
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>

                <br>


                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">CARACTERÍSTICA DO TERRENO E INFRAESTRUTURA</legend>

                            <div class="col-md-12 p-2">
                                {{ Form::label('abast_agua', 'Abastecimento de Água ?') }} :
                                {{ Form::select('abast_agua', ['Existente' => 'Existente', 'Inexistente' => 'Inexistente'], $vistoria->abast_agua, ['class' => 'form form-control', 'id' => 'abast_agua', 'placeholder' => '']) }}
                            </div>
                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Esgotamento Sanitário</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_esgo_sant_canalizado', 1, $vistoria->ck_esgo_sant_canalizado, ['id' => 'ck_esgo_sant_canalizado']) }}
                                        {{ Form::label('ck_esgo_sant_canalizado', 'Canalizado') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_esgo_sant_fossa_similar', 1, $vistoria->ck_esgo_sant_fossa_similar, ['id' => 'ck_esgo_sant_fossa_similar']) }}
                                        {{ Form::label('ck_esgo_sant_fossa_similar', 'Fossa/Similar') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_esgo_sant_superficie', 1, $vistoria->ck_esgo_sant_superficie, ['id' => 'ck_esgo_sant_superficie']) }}
                                        {{ Form::label('ck_esgo_sant_superficie', 'Em superfície') }} :
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                {{ Form::label('sist_drenag', 'Sistema de Drenagem Superficial') }} :
                                {{ Form::select(
                                    'sist_drenag',
                                    [
                                        'Existente' => 'Existente',
                                        'Precario' => 'Precário',
                                        'Inexistente' => 'Inexistente',
                                    ],
                                    $vistoria->sist_drenag,
                                    ['class' => 'form form-control', 'id' => 'sist_drenag', 'placeholder' => ''],
                                ) }}
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Sistema Viário e de Acesso</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_sis_viar_acesso_estrada', 1, $vistoria->ck_sis_viar_acesso_estrada, ['id' => 'ck_sis_viar_acesso_estrada']) }}
                                        {{ Form::label('ck_sis_viar_acesso_estrada', 'Estrada') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_sis_viar_acesso_av_rua', 1, $vistoria->ck_sis_viar_acesso_av_rua, ['id' => 'ck_sis_viar_acesso_av_rua']) }}
                                        {{ Form::label('ck_sis_viar_acesso_av_rua', 'Avenida/Rua') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_sis_viar_acesso_beco_viela', 1, $vistoria->ck_sis_viar_acesso_beco_viela, ['id' => 'ck_sis_viar_acesso_beco_viela']) }}
                                        {{ Form::label('ck_sis_viar_acesso_beco_viela', 'Becos/ Vielas') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_sis_viar_acesso_trilhas', 1, $vistoria->ck_sis_viar_acesso_trilhas, ['id' => 'ck_sis_viar_acesso_trilhas']) }}
                                        {{ Form::label('ck_sis_viar_acesso_trilhas', 'Trilhas') }} :
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Tipo de Revestimentos</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_tp_revest_via_asfaldo', 1, $vistoria->ck_tp_revest_via_asfaldo, ['id' => 'ck_tp_revest_via_asfaldo']) }}
                                        {{ Form::label('ck_tp_revest_via_asfaldo', 'Asfalto') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_tp_revest_via_parale_pedra', 1, $vistoria->ck_tp_revest_via_parale_pedra, ['id' => 'ck_tp_revest_via_parale_pedra']) }}
                                        {{ Form::label('ck_tp_revest_via_parale_pedra', 'Paralelepípedo/Pedras') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_tp_revest_via_n_asfalto', 1, $vistoria->ck_tp_revest_via_n_asfalto, ['id' => 'ck_tp_revest_via_n_asfalto']) }}
                                        {{ Form::label('ck_tp_revest_via_n_asfalto', 'Não Asfaltado') }} :

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Condições de Acesso</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_cond_acesso_veicular', 1, $vistoria->ck_cond_acesso_veicular, ['id' => 'ck_cond_acesso_veicular']) }}
                                        {{ Form::label('ck_cond_acesso_veicular', 'Veicular') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_cond_acesso_veicular4x4', 1, $vistoria->ck_cond_acesso_veicular4x4, ['id' => 'ck_cond_acesso_veicular4x4']) }}
                                        {{ Form::label('ck_cond_acesso_veicular4x4', 'Veicular 4x4') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_cond_acesso_veicula2_rodas', 1, $vistoria->ck_cond_acesso_veicula2_rodas, ['id' => 'ck_cond_acesso_veicula2_rodas']) }}
                                        {{ Form::label('ck_cond_acesso_veicula2_rodas', 'Veicular 2 Rodas') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_cond_acesso_a_pe', 1, $vistoria->ck_cond_acesso_a_pe, ['id' => 'ck_cond_acesso_a_pe']) }}
                                        {{ Form::label('ck_cond_acesso_a_pe', 'A pé') }} :

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                {{ Form::label('nr_moradias', 'Número de Moradias no Terreno') }} :
                                {{ Form::number('nr_moradias', $vistoria->nr_moradias, ['class' => 'form form-control', 'maxlenght' => '4', 'id' => 'nr_moradias']) }}
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Distância da Encosta</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_dist_encosta_menor_2_m', 1, $vistoria->ck_dist_encosta_menor_2_m, ['id' => 'ck_dist_encosta_menor_2_m']) }}
                                        {{ Form::label('ck_dist_encosta_menor_2_m', '< 2m') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_dist_encosta_2_4_m', 1, $vistoria->ck_dist_encosta_2_4_m, ['id' => 'ck_dist_encosta_2_4_m']) }}
                                        {{ Form::label('ck_dist_encosta_2_4_m', '2 - 4m') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_dist_encosta_4_6_m', 1, $vistoria->ck_dist_encosta_4_6_m, ['id' => 'ck_dist_encosta_4_6_m']) }}
                                        {{ Form::label('ck_dist_encosta_4_6_m', '4 -6m') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_dist_encosta_maior_6_m', 1, $vistoria->ck_dist_encosta_maior_6_m, ['id' => 'ck_dist_encosta_maior_6_m']) }}
                                        {{ Form::label('ck_dist_encosta_maior_6_m', '> 6m') }} :

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Material Construtivo</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_mat_constr_alvenaria', 1, $vistoria->ck_mat_constr_alvenaria, ['id' => 'ck_mat_constr_alvenaria']) }}
                                        {{ Form::label('ck_mat_constr_alvenaria', 'Alvenaria') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_mat_constr_madeira', 1, $vistoria->ck_mat_constr_madeira, ['id' => 'ck_mat_constr_madeira']) }}
                                        {{ Form::label('ck_mat_constr_madeira', 'Madeira') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_mat_constr_mist_plas_mad_lata', 1, $vistoria->ck_mat_constr_mist_plas_mad_lata, ['id' => 'ck_mat_constr_mist_plas_mad_lata']) }}
                                        {{ Form::label('ck_mat_constr_mist_plas_mad_lata', 'Misto (Plástico/Madeirite/Lata)') }} :

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="row">
                                    <div class="col-md-3 border p-2">
                                        <label>Conservação Estrutural</label>
                                    </div>
                                    <div class="col-md-9 text-center border p-2">
                                        {{ Form::checkbox('ck_cons_estr_baixa', 1, $vistoria->ck_cons_estr_baixa, ['id' => 'ck_cons_estr_baixa']) }}
                                        {{ Form::label('ck_cons_estr_baixa', 'Baixa') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_cons_estr_media', 1, $vistoria->ck_cons_estr_media, ['id' => 'ck_cons_estr_media']) }}
                                        {{ Form::label('ck_cons_estr_media', 'Média') }} :
                                        &nbsp;&nbsp;&nbsp;
                                        {{ Form::checkbox('ck_cons_estr_alta', 1, $vistoria->ck_cons_estr_alta, ['id' => 'ck_cons_estr_alta']) }}
                                        {{ Form::label('ck_cons_estr_alta', 'Alta') }} :

                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </div>
                </div>

                <br><br>
                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">CARACTERÍSTICA DAS ANOMALIAS ESTRUTURAIS E PROCESSOS GEODINÂMICOS</legend>
                            <div class="row p-2">
                                <div class="col">
                                    <div class="row p-2">
                                        <div class="col-md-3 border">
                                            <label class=" align-middle">Elementos Estruturais</label>
                                        </div>
                                        <div class="col-md-6 text-center border">
                                            {{ Form::checkbox('ck_el_str_trinc_pilar', 1, $vistoria->ck_el_str_trinc_pilar, ['id' => 'ck_el_str_trinc_pilar']) }}
                                            {{ Form::label('ck_el_str_trinc_pilar', 'Trincas nos Pilares') }} :
                                            &nbsp;&nbsp;&nbsp;
                                            {{ Form::checkbox('ck_el_str_trinc_viga', 1, $vistoria->ck_el_str_trinc_pilar, ['id' => 'ck_el_str_trinc_viga']) }}
                                            {{ Form::label('ck_el_str_trinc_viga', 'Trinca em Vigas') }} :
                                            &nbsp;&nbsp;&nbsp;
                                            {{ Form::checkbox('ck_el_str_trinc_lage', 1, $vistoria->ck_el_str_trinc_pilar, ['id' => 'ck_el_str_trinc_lage']) }}
                                            {{ Form::label('ck_el_str_trinc_lage', 'Trinca na Lage') }} :
                                            <br>
                                            <br>

                                            {{ Form::checkbox('ck_el_str_incl_muro', 1, $vistoria->ck_el_str_incl_muro, ['id' => 'ck_el_str_incl_muro']) }}
                                            {{ Form::label('ck_el_str_incl_muro', 'Inclinação de Muros') }} :
                                            &nbsp;&nbsp;&nbsp;
                                            {{ Form::checkbox('ck_el_str_mur_pared_def', 1, $vistoria->ck_el_str_mur_pared_def, ['id' => 'ck_el_str_mur_pared_def']) }}
                                            {{ Form::label('ck_el_str_mur_pared_def', 'Muros/Paredes Deformadas') }} :
                                            &nbsp;&nbsp;&nbsp;
                                            {{ Form::checkbox('ck_el_str_cic_desliza', 1, $vistoria->ck_el_str_cic_desliza, ['id' => 'ck_el_str_cic_desliza']) }}
                                            {{ Form::label('ck_el_str_cic_desliza', 'Cicatriz de Deslizamento') }} :
                                            <br>
                                            <br>

                                            {{ Form::checkbox('ck_el_str_degr_abat', 1, $vistoria->ck_el_str_degr_abat, ['id' => 'ck_el_str_degr_abat']) }}
                                            {{ Form::label('ck_el_str_degr_abat', 'Degraus de Abatimento') }} :
                                            &nbsp;&nbsp;&nbsp;
                                            {{ Form::checkbox('ck_el_str_incl_arv', 1, $vistoria->ck_el_str_incl_arv, ['id' => 'ck_el_str_incl_arv']) }}
                                            {{ Form::label('ck_el_str_incl_arv', 'Inclinação de Árvores') }} :
                                            &nbsp;&nbsp;&nbsp;
                                            {{ Form::checkbox('ck_el_str_incl_poste', 1, $vistoria->ck_el_str_incl_poste, ['id' => 'ck_el_str_incl_poste']) }}
                                            {{ Form::label('ck_el_str_incl_poste', 'Inclinação de Postes') }} :

                                        </div>
                                        <!-- upload imagem el_estr -->
                                        <div class="border col-md-3">
                                            <input type="file"
                                                name="img_ck_el_str[]"
                                                class="filepond img_ck_el_str_"
                                                multiple
                                                data-allow-reorder="true"
                                                data-max-file-size="3MB"
                                                data-max-files="4">

                                        </div>

                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3 border">
                                                <label>Elementos Construtivos</label>
                                            </div>
                                            <div class="col-md-6 text-center border p-2">
                                                {{ Form::checkbox('ck_el_constr_trinc_parede', 1, $vistoria->ck_el_constr_trinc_parede, ['id' => 'ck_el_constr_trinc_parede']) }}
                                                {{ Form::label('ck_el_constr_trinc_parede', 'Trincas nas Paredes') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_el_constr_trinc_piso', 1, $vistoria->ck_el_constr_trinc_piso, ['id' => 'ck_el_constr_trinc_piso']) }}
                                                {{ Form::label('ck_el_constr_trinc_piso', 'Trinca no Piso') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_el_constr_trinc_muro', 1, $vistoria->ck_el_constr_trinc_muro, ['id' => 'ck_el_constr_trinc_muro']) }}
                                                {{ Form::label('ck_el_constr_trinc_muro', 'Trincas no Muro') }} :

                                            </div>
                                            <!-- upload imagem el_constr -->
                                            <div class="border col-md-3">
                                                <input type="file"
                                                    name="img_ck_el_constr[]"
                                                    class="filepond img_ck_el_constr"
                                                    multiple
                                                    data-allow-reorder="true"
                                                    data-max-file-size="3MB"
                                                    data-max-files="4">
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-md-12 p-2">
                                        <div class="row">
                                            <div class="col-md-3 border p-2">
                                                <label>Agentes Potencializadores</label>
                                            </div>
                                            <div class="col-md-6 text-center border p-2">
                                                {{ Form::checkbox('ck_ag_pot_lixo_entulho', 1, $vistoria->ck_ag_pot_lixo_entulho, ['id' => 'ck_ag_pot_lixo_entulho']) }}
                                                {{ Form::label('ck_ag_pot_lixo_entulho', 'Lixo/Entulho') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_ag_pot_aterr_bot_fora', 1, $vistoria->ck_ag_pot_aterr_bot_fora, ['id' => 'ck_ag_pot_aterr_bot_fora']) }}
                                                {{ Form::label('ck_ag_pot_aterr_bot_fora', 'Aterro/Bota Fora') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_ag_pot_veg_inadeq', 1, $vistoria->ck_ag_pot_veg_inadeq, ['id' => 'ck_ag_pot_veg_inadeq']) }}
                                                {{ Form::label('ck_ag_pot_veg_inadeq', 'Vegeração Inadequada') }} :

                                                <br>
                                                <br>
                                                {{ Form::checkbox('ck_ag_pot_cort_vert', 1, $vistoria->ck_ag_pot_cort_vert, ['id' => 'ck_ag_pot_cort_vert']) }}
                                                {{ Form::label('ck_ag_pot_cort_vert', 'Cortes Verticalizados') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_ag_pot_tubl_romp', 1, $vistoria->ck_ag_pot_tubl_romp, ['id' => 'ck_ag_pot_tubl_romp']) }}
                                                {{ Form::label('ck_ag_pot_tubl_romp', 'Tubulação Rompida') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_ag_pot_conc_flux_superfic', 1, $vistoria->ck_ag_pot_conc_flux_superfic, ['id' => 'ck_ag_pot_conc_flux_superfic']) }}
                                                {{ Form::label('ck_ag_pot_conc_flux_superfic', 'Concentração de Fluxo Superficial') }} :
                                            </div>
                                            <!-- upload imagem ag_pot -->
                                            <div class="border col-md-3">
                                                <input type="file"
                                                    name="img_ck_ag_pote[]"
                                                    class="filepond img_ck_ag_pote"
                                                    multiple
                                                    data-allow-reorder="true"
                                                    data-max-file-size="3MB"
                                                    data-max-files="4">
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-md-12 p-2">
                                        <div class="row">
                                            <div class="col-md-3 border p-2">
                                                <label>Processos Geodinámicos</label>
                                            </div>
                                            <div class="col-md-6 text-center border p-2">
                                                {{ Form::checkbox('ck_proc_geo_desliza', 1, $vistoria->ck_proc_geo_desliza, ['id' => 'ck_proc_geo_desliza']) }}
                                                {{ Form::label('ck_proc_geo_desliza', 'Deslizamento') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_proc_geo_qued_rolam_bloc', 1, $vistoria->ck_proc_geo_qued_rolam_bloc, ['id' => 'ck_proc_geo_qued_rolam_bloc']) }}
                                                {{ Form::label('ck_proc_geo_qued_rolam_bloc', 'Queda Rolamento de Blocos') }} :
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::checkbox('ck_proc_geo_inundac', 1, $vistoria->ck_proc_geo_inundac, ['id' => 'ck_proc_geo_inundac']) }}
                                                {{ Form::label('ck_proc_geo_inundac', 'Inundações') }} :
                                            </div>
                                            <!-- upload imagem proc_geo -->
                                            <div class="border col-md-3">
                                                <input type="file"
                                                    name="img_ck_proc_geo[]"
                                                    class="filepond img_ck_proc_geo"
                                                    multiple
                                                    data-allow-reorder="true"
                                                    data-max-file-size="3MB"
                                                    data-max-files="4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <br><br>
                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">VULNERABILIDADE</legend>

                            <div class="row align-items-center" style="background-color: #CEF6CE;">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_vuln_baixa', 1, $vistoria->ck_vuln_baixa, ['id' => 'ck_vuln_baixa']) }}
                                    {{ Form::label('ck_vuln_baixa', 'Baixa') }}
                                </div>
                                <div class="col-md-9">Danos Estruturais não previsíveis</div>
                            </div>
                            <div class="row align-items-center" style="background-color: #F3F781;">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_vuln_media', 1, $vistoria->ck_vuln_media, ['id' => 'ck_vuln_media']) }}
                                    {{ Form::label('ck_vuln_media', 'Média') }}
                                </div>
                                <div class="col-md-9">Danos esperados relacionados a trincas e colapso nas paredes</div>
                            </div>
                            <div class="row  align-items-center" style="background-color: #FE642E">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_vuln_alta', 1, $vistoria->ck_vuln_alta, ['id' => 'ck_vuln_alta']) }}
                                    {{ Form::label('ck_vuln_alta', 'Alta') }}
                                </div>
                                <div class="col-md-9">Danos Estruturais esperados com excessivas deformacoes das estruturas, colapso parcial dos domicílios</div>
                            </div>
                            <div class="row align-items-center" style="background-color: #DF3A01">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_vuln_muito_alta', 1, $vistoria->ck_vuln_muito_alta, ['id' => 'ck_vuln_muito_alta']) }}
                                    {{ Form::label('ck_vuln_muito_alta', 'Muito Alta') }}
                                </div>
                                <div class="col-md-9">Danos estruturais esperados com comprometimento integral estrutural e possibilidade de colapso total dos domicílios</div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col">
                        <fieldset class="border p-2">
                            <legend class="w-auto">CLASSIFICAÇÃO DE RISCO</legend>
                            <div class="row align-items-center" style="background-color: #CEF6CE;">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_clas_risc_baixa', 1, $vistoria->ck_clas_risc_baixa, ['id' => 'ck_clas_risc_baixa']) }}
                                    {{ Form::label('ck_clas_risc_baixa', 'Baixa') }}
                                </div>
                                <div class="col-md-9">Manutenção do uso e ocupação</div>
                            </div>
                            <div class="row align-items-center" style="background-color: #F3F781;">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_clas_risc_media', 1, $vistoria->ck_clas_risc_media, ['id' => 'ck_clas_risc_media']) }}
                                    {{ Form::label('ck_clas_risc_media', 'Média') }}
                                </div>
                                <div class="col-md-9">Necessidade obras de restauração</div>
                            </div>
                            <div class="row align-items-center" style="background-color: #FE642E">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_clas_risc_alta', 1, $vistoria->ck_clas_risc_alta, ['id' => 'ck_clas_risc_alta']) }}
                                    {{ Form::label('ck_clas_risc_alta', 'Alta') }}
                                </div>
                                <div class="col-md-9">Interdição temporária/Necessidade de obras emergênciais</div>
                            </div>
                            <div class="row align-items-center" style="background-color: #DF3A01">
                                <div class="col-md-3 p-2">
                                    {{ Form::checkbox('ck_clas_risc_muito_alta', 1, $vistoria->ck_clas_risc_muito_alta, ['id' => 'ck_clas_risc_muito_alta']) }}
                                    {{ Form::label('ck_clas_risc_muito_alta', 'Muito Alta') }}
                                </div>
                                <div class="col-md-9">Interdição/Condenação</div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class='row'>
                    <div class="col-12">
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}


            </div>


        @stop
        @section('css')
        @stop
        @section('code')
            <script type="text/javascript">
                $(document).ready(function() {

                    /* não gravar sem marcar a vulnerabilidade e risco */
                    $('#aviso').hide();
                    $('#btnGravar').hover(function() {
                        if ($('#ck_vuln_baixa').is(':checked') || $('#ck_vuln_media').is(':checked') || $('#ck_vuln_alta').is(':checked') || $('#ck_vuln_muito_alta').is(':checked')) {
                            $('#btnGravar').removeAttr('disabled');
                        } else {
                            $('#btnGravar').attr('disabled', true);
                            $('#aviso').show();
                            swal.fire(
                                'Prezado Operador, \n É necessário marcar o nível de Vulnerabilidade e a Classificação de Risco de sua vistoria !'
                            ).then(function() {
                                $('#btnGravar').removeAttr('disabled');
                            });
                        }
                    })

                    $('.js-example-basic-single').select2();

                    $("#form_vistoria").on('submit', function(e) {

                        var formdata = new FormData(this);


                        var img_ck_el_str_ = $('.img_ck_el_str_').filepond('getFiles');
                        for (var i = 0; i < img_ck_el_str_.length; i++) {
                            formdata.append('img_ck_el_str_[]', img_ck_el_str_[i].file);
                        }

                        var img_ck_el_constr = $('.img_ck_el_constr').filepond('getFiles');
                        for (var i = 0; i < img_ck_el_constr.length; i++) {
                            formdata.append('img_ck_el_constr[]', img_ck_el_constr[i].file);
                        }

                        var img_ck_ag_pote = $('.img_ck_ag_pote').filepond('getFiles');
                        for (var i = 0; i < img_ck_ag_pote.length; i++) {
                            formdata.append('img_ck_ag_pote[]', img_ck_ag_pote[i].file);
                        }

                        var img_ck_proc_geo = $('.img_ck_proc_geo').filepond('getFiles');
                        for (var i = 0; i < img_ck_proc_geo.length; i++) {
                            formdata.append('img_ck_proc_geo[]', img_ck_proc_geo[i].file);
                        }

                        const isConfirmed = confirm('Deseja Gravar as novas Informações da Vistoria ?');

                        if (isConfirmed) {
                            $.ajax({

                                url: '{{ url('vistoria/update') }}',
                                type: 'POST',
                                data: formdata,
                                dataType: 'JSON',
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(data) {
                                    if (data.keys) {
                                        Object.values(data.keys).forEach((x) => {
                                            $("#" + x).addClass('is-invalid');
                                            $("#" + x).parent().append('<div class="invalid-feedback">Este campo é Obrigatório</div>');
                                        });
                                    }
                                    if (data.error) {
                                        Object.values(data.error).forEach((x) => {
                                            toastr.error(x);
                                        });
                                    }

                                    if (data.success) {
                                        window.location.href = data.view;
                                    }
                                },
                                error: function(data) {
                                    console.log(data);
                                }
                            });
                        }
                        e.preventDefault();

                    });

                    /* el_estr */
                    $('.img_ck_el_str_').filepond({
                        allowMultiple: true,
                        allowImagePreview: false,
                        maxFiles: '4',
                        locale: 'pt_BR',
                        maxParallelUploads: '2',
                        credits: 'CEDEC-MG',
                        labelIdle: 'Arraste o arquivo ou <span class="filepond--label-action"> Clique Aqui </span><br> Max. 4 arquivos',
                    })



                    // /* el_constr */
                    $('.img_ck_el_constr').filepond({
                        allowMultiple: true,
                        allowImagePreview: false,
                        maxFiles: '4',
                        locale: 'pt_BR',
                        maxParallelUploads: '2',
                        credits: 'CEDEC-MG',
                        labelIdle: 'Arraste o arquivo ou <span class="filepond--label-action"> Clique Aqui </span><br> Max. 4 arquivos',
                    });

                    /* ag_pot */
                    $('.img_ck_ag_pote').filepond({
                        allowMultiple: true,
                        allowImagePreview: false,
                        maxFiles: '4',
                        locale: 'pt_BR',
                        maxParallelUploads: '2',
                        credits: 'CEDEC-MG',
                        labelIdle: 'Arraste o arquivo ou <span class="filepond--label-action"> Clique Aqui</span><br> Max. 4 arquivos',
                    });

                    // /* proce_geo */
                    $('.img_ck_proc_geo').filepond({
                        allowMultiple: true,
                        allowImagePreview: false,
                        maxFiles: '4',
                        locale: 'pt_BR',
                        maxParallelUploads: '2',
                        credits: 'CEDEC-MG',
                        labelIdle: 'Arraste o arquivo ou <span class="filepond--label-action"> Clique Aqui </span><br> Max. 4 arquivos',
                    });

                    $("#ck_vuln_alta").click(function() {
                        if ($(this).is(':checked')) {
                            $("#ck_clas_risc_alta").prop('checked', true);
                        } else {
                            $("#ck_clas_risc_alta").prop('checked', false);
                        }
                    });
                    $("#ck_vuln_muito_alta").click(function() {
                        if ($(this).is(':checked')) {
                            $("#ck_clas_risc_muito_alta").prop('checked', true);
                        } else {
                            $("#ck_clas_risc_muito_alta").prop('checked', false);
                        }
                    });

                    $("#ck_clas_risc_alta").click(function() {
                        if ($(this).is(':checked')) {
                            $("#ck_vuln_alta").prop('checked', true);
                        } else {
                            $("#ck_vuln_alta").prop('checked', false);
                        }
                    });

                    $("#ck_clas_risc_muito_alta").click(function() {
                        if ($(this).is(':checked')) {
                            $("#ck_vuln_muito_alta").prop('checked', true);
                        } else {
                            $("#ck_vuln_muito_alta").prop('checked', false);
                        }
                    });

                    $("#tel").inputmask('(99) 9999[9]-9999');
                    $("#cep").inputmask('99999-999');
                    $("#latitude").inputmask('-99.999999');
                    $("#longitude").inputmask('-99.999999');
                })
            </script>
        @endsection
