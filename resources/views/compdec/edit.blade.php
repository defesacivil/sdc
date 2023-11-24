@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            @can('cedec')
                <li class="breadcrumb-item"><a href="{{ url('compdec') }}">Busca Compdec</a></li>
            @endcan
            <li class="breadcrumb-item active" aria-current="page">Edição Dados Compdec</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div style="background-color:#e9ecef;" class="container p-3 border min-vh-100">

        <div class="row flex-fill">

            <div class="p-2 border col-md-12">

                <legend class="text-center alert alert-primary">
                    <h2>DADOS CADASTRAIS COMPDEC / {{ $compdec->municipio->nome }}</h2>
                </legend>

                @php
                    $tab = isset($active_tab) ? $active_tab : 'municipio-tab';

                @endphp

                <!-- ATIVAR TAB APOS RELOAD -->
                @if (Session::has('active_tab'))
                    @php
                        $tab = Session::get('active_tab');
                    @endphp
                @else
                    @php
                        $tab = '#-municipio-tab';
                    @endphp
                @endif


                <div class='row'>
                    <div class='col-md-6'>
                        <!-- FOTO DO PREFEITO -->
                        <div class='p-2 d-flex justify-content-center' id='alt_foto_prefeito'>
                            <div class="mb-3 text-center col-md-6 border-dark" style="max-width: 18rem; max-height: 18rem; min-height: 16rem;">
                                Prefeito<br>
                                <img class="figure img-thumbnail" style='width: 150px; height:150px'
                                    src='{{ url('storage/prefeito/' . $compdec->prefeitura->fotoPref) }}'>

                                <p class="p-2 text-center">{{ Str::upper($compdec->prefeitura->prefeito) }}</p>
                                <p class="text-center">
                                    <button type="link" class="btn btn-link" id="btnPref">Alterar</button>
                                </p>
                            </div>
                        </div>
                        {{-- FORM UPLOAD FOTO PREFEITO --}}
                        <div class='col-md-12' id='form_upload_foto_prefeito'>
                            {{ Form::open(['url' => 'prefeitura/upload/' . $compdec->id_municipio, 'files' => true]) }}
                            {{ Form::label('fotoPref', 'Upload de Foto do Prefeito:') }}<br>
                            {{ Form::file('fotoPref') }}
                            <br><br>
                            {{ Form::submit('Upload Foto', ['class' => 'btn btn-primary btn-sm', 'id' => 'btnUpPref']) }}
                            {{ Form::close() }}
                            <br>
                        </div>
                    </div>
                    <div class='text-center col-md-6'>
                        <!-- FOTO DO COORDENADOR -->
                        <div class="p-2 d-flex justify-content-center" id='alt_foto_compdec'>
                            <div class="mb-3 text-center col-md-6 border-dark" style="max-width: 18rem; max-height: 18rem; min-height: 16rem;">
                                Coordenador<br>
                                <img class="figure img-thumbnail" style='width: 150px; height:150px; '
                                    src='{{ url('storage/compdec/' . $compdec->fotoCompdec) }}' width='100'
                                    min-heigth='100'>
                                <p class="p-2 text-center">
                                    @php
                                        $compdec->equipes->each(function ($item, $key) {
                                            if ($item['funcao'] == 'Coordenador') {
                                                print Str::upper($item['nome']);
                                            }
                                        });
                                    @endphp</p>
                                <p class="text-center">
                                    <button type="link" class="btn btn-link" id="btnCompdec">Alterar</button>
                                </p>
                            </div>
                        </div>
                        {{-- FORM UPLOAD FOTO COORDENADOR --}}
                        <div class='col-md-6' id='form_upload_foto_compdec'>
                            {{ Form::open(['url' => 'compdec/upload/' . $compdec->id, 'files' => true]) }}
                            {{ Form::label('fotoCompdec', 'Upload de Foto do Coordenador:', ['id' => 'lblFotCompdec']) }}<br>
                            {{ Form::file('fotoCompdec') }}
                            <br><br>
                            {{ Form::submit('Upload Foto', ['class' => 'btn btn-primary btn-sm', 'id' => 'btnUpCompdec']) }}
                            {{ Form::close() }}

                        </div>
                    </div>


                </div>
                <hr>



                <!-- TAB´S CADASTRO COMPDEC -->
                <div class='col-md-12'>
                    <ul class="nav nav-pills nav-fill" id="tab-compdec" role="tablist">

                        {{-- DADOS MUNICIPIO --}}
                        <li class="nav-item"><a class="nav-link active" id="-municipio-tab" data-toggle="tab" href="#municipio-tab"
                                role="tab" aria-controls="municipio-tab" aria-selected="true">Informações Município</a></li>
                        {{-- DADOS GERAIS --}}
                        <li class="nav-item"><a class="nav-link" id="-gerais-tab" data-toggle="tab" href="#gerais-tab" role="tab"
                                aria-controls="gerais-tab" aria-selected="false">Dados Gerais</a></li>
                        {{-- EQUIPE --}}
                        <li class="nav-item"><a class="nav-link" id="-equipe-tab" data-toggle="tab" href="#equipe-tab" role="tab"
                                aria-controls="equipe-tab" aria-selected="false">Equipe Compdec</a></li>
                        {{-- ARQUIVOS --}}
                        <li class="nav-item"><a class="nav-link" id="-arquivo-tab" data-toggle="tab" href="#arquivo-tab" role="tab"
                                aria-controls="arquivo-tab" aria-selected="false">Documentos e Arquivos </a></li>
                        {{-- PLANO CONTIGENCIA --}}
                        <li class="nav-item"><a class="nav-link" id="-plano-tab" data-toggle="tab" href="#plano-tab" role="tab"
                                aria-controls="plano-tab" aria-selected="false">Plano de Contingência</a></li>
                    </ul>

                    <div class="tab-content" id="nav-tabContent">

                        <!-- FORM INFORMAÇÕES MUNICIPIO -->
                        <div class="tab-pane fade show active" id="municipio-tab" role="tabpanel" aria-labelledby="municipio-tab">
                            {{ Form::open(['url' => 'municipio/update/' . $compdec->municipio->id]) }}
                            {{ Form::token() }}
                            {{ Form::hidden('id', $compdec->municipio->id, ['readonly' => 'readonly', 'required', 'maxlength' => 5]) }}

                            <br>
                            <legend class="alert alert-info">Dados Prefeito</legend>
                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('prefeito', 'Nome do Prefeito') }}:
                                    {{ Form::text('prefeito', $compdec->municipio->nome_prefeito, ['class' => 'form form-control', 'maxlength' => 70]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('tel_prefeito', 'Telefone Prefeito') }}:
                                    {{ Form::text('tel_prefeito', $compdec->municipio->tel_prefeito, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('cel_prefeito', 'Celular Prefeito') }}:
                                    {{ Form::text('cel_prefeito', $compdec->municipio->cel_prefeito, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                                <div class="col">
                                    {{ Form::label('email_prefeito', 'Email do Prefeito') }}:
                                    {{ Form::email('email_prefeito', $compdec->municipio->email_prefeito, ['class' => 'form form-control', 'maxlength' => 110]) }}

                                </div>
                            </div>

                            <legend class="alert alert-info">Informações</legend>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('nome', '') }}:
                                    {{ Form::text('nome', $compdec->municipio->nome, ['class' => 'form form-control', 'readonly' => 'readonly', 'maxlength' => 70]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('macroregiao', '') }}:
                                    {{ Form::select(
                                        'macroregiao',
                                        [
                                            'ALTO PARANAIBA' => 'ALTO PARANAIBA',
                                            'CENTRAL' => 'CENTRAL',
                                            'CENTRO OESTE' => 'CENTRO OESTE',
                                            'JEQUITINHONHA MUCURI' => 'JEQUITINHONHA MUCURI',
                                            'JEQUITINHONHAMUCURI' => 'JEQUITINHONHAMUCURI',
                                            'NOROESTE DE MINAS' => 'NOROESTE DE MINAS',
                                            'NORTE DE MINAS' => 'NORTE DE MINAS',
                                            'SUL DE MINAS' => 'SUL DE MINAS',
                                            'TRIANGULO' => 'TRIANGULO',
                                            'VALE DO RIO DOCE' => 'VALE DO RIO DOCE',
                                            'ZONA DA MATA' => 'ZONA DA MATA',
                                        ],
                                        $compdec->municipio->macroregiao,
                                        ['class' => 'form form-control', 'placeholder' => 'Selecione a Macroregiao'],
                                    ) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('latitude', '') }}:
                                    {{ Form::text('latitude', $compdec->municipio->latitude, ['class' => 'form form-control', 'maxlength' => 13]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('longitude', '') }}:
                                    {{ Form::text('longitude', $compdec->municipio->longitude, ['class' => 'form form-control', 'maxlength' => 13]) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('latitude_dec', 'Latitude Formato Decimal') }}:
                                    {{ Form::text('latitude_dec', $compdec->municipio->latitude_dec, ['class' => 'form form-control', 'maxlength' => 15]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('longitude_dec', 'Longitude Formato Decimal') }}:
                                    {{ Form::text('longitude_dec', $compdec->municipio->longitude_dec, ['class' => 'form form-control', 'maxlength' => 15]) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('distancia_bh', 'Distância de BH em KM') }}:
                                    {{ Form::number('distancia_bh', $compdec->municipio->distancia_bh, ['class' => 'form form-control', 'maxlength' => 15]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('populacao', 'Número de Habitantes (População)') }}:
                                    {{ Form::number('populacao', $compdec->municipio->populacao, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('territorio_desenv', 'Território de Desenvolvimento') }}:
                                    {{ Form::select(
                                        'territorio_desenv',
                                        [
                                            'Alto Jequitinhonh' => 'Alto Jequitinhonha',
                                            'Caparao' => 'Caparao',
                                            'Central' => 'Central',
                                            'Mata' => 'Mata',
                                            'Medio e Baixo Jequitinhonha' => 'Medio e Baixo Jequitinhonha',
                                            'Metropolitana' => 'Metropolitana',
                                            'Mucuri' => 'Mucuri',
                                            'Noroeste' => 'Noroeste',
                                            'Norte' => 'Norte',
                                            'Oeste' => 'Oeste',
                                            'Sudoeste' => 'Sudoeste',
                                            'Sul' => 'Sul',
                                            'Triangulo Norte' => 'Triangulo Norte',
                                            'Triangulo Sul' => 'Triangulo Sul',
                                            'Vale do Aco' => 'Vale do Aco',
                                            'Vale do Rio Doce' => 'Vale do Rio Doce',
                                            'Vertentes' => 'Vertentes',
                                        ],
                                        $compdec->municipio->territorio_desenv,
                                        ['class' => 'form form-control', 'placeholder' => 'Selecione o Território de Desenvolvimento'],
                                    ) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('area', 'Area Territorio KM²') }}:
                                    {{ Form::text('area', $compdec->municipio->area, ['class' => 'form form-control', 'maxlength' => 45]) }}
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('id_meso', 'Mesorregiao') }}:
                                    {{ Form::select('id_meso', $mesorregiao, $compdec->municipio->id_meso, ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('id_micro', 'Microrregiao') }}:
                                    {{ Form::select('id_micro', $microrregiao, $compdec->municipio->id_micro, ['class' => 'form form-control']) }}
                                    <br>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('pop_rural', 'Populacao Rural') }}:
                                    {{ Form::text('pop_rural', $compdec->municipio->pop_rural, ['class' => 'form form-control', 'maxlength' => 11]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('qtd_pipa', 'Quantidade de Pipa Contratados ou de Propriedade Prefeitura') }}:
                                    {{ Form::text('qtd_pipa', $compdec->municipio->qtd_pipa, ['class' => 'form form-control', 'maxlength' => 11]) }}
                                    <br>
                                </div>

                            </div>


                            <legend class="alert alert-info">Endereço e Contatos da Prefeitura</legend>


                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('endereco', 'Endereço Prefeitura') }}:
                                    {{ Form::text('endereco', $compdec->municipio->endereco, ['class' => 'form form-control', 'maxlength' => 110]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('bairro', 'Bairro Prefeitura') }}:
                                    {{ Form::text('bairro', $compdec->municipio->bairro, ['class' => 'form form-control', 'maxlength' => 70]) }}
                                    <br>
                                </div>

                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('cep', 'Cep prefeitura') }}:
                                    {{ Form::text('cep', $compdec->municipio->cep, ['class' => 'form form-control', 'maxlength' => 15]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('email_prefeitura', 'Email Prefeitura') }}:
                                    {{ Form::email('email_prefeitura', $compdec->municipio->email_prefeitura, ['class' => 'form form-control', 'maxlength' => 110]) }}
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('fax_prefeitura', 'Fax Prefeitura') }}:
                                    {{ Form::text('fax_prefeitura', $compdec->municipio->fax_prefeitura, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('tel_prefeitura', 'Telefone Prefeitura') }}:
                                    {{ Form::text('tel_prefeitura', $compdec->municipio->tel_prefeitura, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>

                            </div>

                            <legend class="alert alert-info">Informações ISS</legend>
                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('cobra_iss', 'Isenção de ISS') }}:
                                    {{ Form::select('cobra_iss', ['SIM' => 'SIM', 'NAO' => 'NAO'], $compdec->municipio->cobra_iss, ['class' => 'form form-control', 'placeholder' => 'Selecione a Opção']) }}

                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('aliquota_iss', 'Aliquota Iss %') }}:
                                    {{ Form::text('aliquota_iss', $compdec->municipio->aliquota_iss, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('num_lei_iss', 'Número Lei Cobranca Iss') }}:
                                    {{ Form::text('num_lei_iss', $compdec->municipio->num_lei_iss, ['class' => 'form form-control', 'maxlength' => 30]) }}
                                    <br>
                                </div>

                                <div class='col'>
                                    {{ Form::label('resp_cob_iss', 'Quem é responsável pela cobranca do ISS') }}:
                                    {{ Form::select('resp_cob_iss', ['Inexistente' => 'Inexistente', 'Prestador' => 'Prestador', 'Município' => 'Municipio'], $compdec->municipio->resp_cob_iss, [
                                        'class' => 'form form-control',
                                        'placeholder' => 'Selecione a Responsabilidade Cobrança Iss',
                                    ]) }}
                                    <br>
                                </div>
                            </div>


                            <div class='row'>
                                {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                            </div>{{ Form::close() }}

                        </div>

                        <!---------- FORM DADOS GERAIS ----------->

                        <div class="tab-pane fade" id="gerais-tab" role="tabpanel" aria-labelledby="gerais-tab">


                            {{ Form::open(['url' => 'compdec/update/' . $compdec->id]) }}
                            {{ Form::token() }}
                            {{ Form::hidden('id', $compdec->id, ['readonly' => 'readonly', 'required', 'maxlength' => 5]) }}

                            <br>
                            <legend class="alert alert-info">Dados Divisão Política</legend>

                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('regiao', 'Regiao de Desenvolvimento do Estado') }}:
                                    {{ Form::select('regiao_id', $regioes, '', ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                                <div class='col'>

                                    {{ Form::label('associacao', 'Associação de Municípios') }}:
                                    {{ Form::select('associacao_id', $associacoes, '', ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                                <div class='col'>

                                    {{ Form::label('id_territorio', 'Territorio Desenvolvimento') }}:
                                    {{ Form::select('territorio_id', $territorios, '', ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                            </div>


                            <legend class="alert alert-info">Informações Leis/Decretos</legend>
                            <div class="row">

                                <div class='col'>
                                    {{ Form::label('num_lei', 'Núnero da Lei') }}:
                                    {{ Form::number('num_lei', $compdec->num_lei, ['class' => 'form form-control', 'max' => 20000]) }}
                                    <br>
                                </div>

                                <div class='col'>
                                    {{ Form::label('dt_lei', 'Data da Lei') }}:
                                    {{ Form::date('dt_lei', $compdec->dt_lei, ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('num_decreto', 'Número do Decreto') }}:
                                    {{ Form::number('num_decreto', $compdec->num_decreto, ['class' => 'form form-control', 'max' => 20000]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('dt_decreto', 'Data Decreto') }}:
                                    {{ Form::date('dt_decreto', $compdec->dt_decreto, ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col'>
                                    {{ Form::label('num_portaria', 'Número da Portaria') }}:
                                    {{ Form::number('num_portaria', $compdec->num_portaria, ['class' => 'form form-control', 'max' => 20000]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('dt_portaria', 'Data Portaria') }}:
                                    {{ Form::date('dt_portaria', $compdec->dt_portaria, ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                            </div>

                            <legend class="alert alert-info">Informações de Localização da Coordenadoria Municipal de Defesa Civil</legend>
                            <div class="row">
                                <br>
                                <div class='col'>
                                    {{ Form::label('endereco', 'Endereco') }}:
                                    {{ Form::text('endereco', $compdec->endereco, ['class' => 'form form-control', 'maxlength' => 150]) }}
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('fone_com1', 'Telefone 1') }}:
                                    {{ Form::text('fone_com1', $compdec->fone_com1, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('fone_com2', 'Telefone 2') }}:
                                    {{ Form::text('fone_com2', $compdec->fone_com2, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('fax', 'Numero Fax') }}:
                                    {{ Form::text('fax', $compdec->fax, ['class' => 'form form-control', 'maxlength' => 20]) }}
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('email', 'Email Principal') }}:
                                    {{ Form::email('email', $compdec->email, ['class' => 'form form-control', 'maxlength' => 150]) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('email', 'Email Principal') }}:
                                    {{ Form::email('email', $compdec->email, ['class' => 'form form-control', 'maxlength' => 150]) }}
                                    <br>
                                </div>
                            </div>


                            <legend class="alert alert-info">Informações sobre estrutura funcional da COMPDEC</legend>
                            <div class='p-2 row'>
                                <div class='col-md-12'>
                                    <div class='p-2 row'>
                                        <div class="p-2 border col border-secondary">
                                            {{ Form::label('efetivo', 'Funcionários Efetivos') }}:
                                            <div class='form-check'>
                                                {{ Form::radio('efetivo', 1, $compdec->efetivo == 1 ? true : false) }}
                                                <label class='form-check-label' for='efetivo'>
                                                    Sim
                                                </label>
                                            </div>
                                            <div class='form-check'>
                                                {{ Form::radio('efetivo', 0, $compdec->efetivo == 0 ? true : false) }}
                                                <label class='form-check-label' for='efetivo'>
                                                    Não
                                                </label>
                                            </div>
                                            <br>
                                        </div>
                                        <div class='col'>
                                            {{ Form::label('qtd_efetivo', 'Quantidade Funcionário') }}:
                                            {{ Form::number('qtd_efetivo', $compdec->num_lei, ['class' => 'form form-control', 'max' => 100]) }}
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('nudec', 'Possui Nudec') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('nudec', 1, $compdec->nudec == 1 ? true : false) }}
                                        <label class='form-check-label' for='nudec'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('nudec', 0, $compdec->nudec == 0 ? true : false) }}
                                        <label class='form-check-label' for='nudec'>
                                            Não
                                        </label>
                                    </div>
                                    <br>

                                </div>
                                <div class='col'>
                                    {{ Form::label('qtd_nudec', 'Quantidade Nudec') }}:
                                    {{ Form::number('qtd_nudec', $compdec->qtd_nudec, ['class' => 'form form-control', 'max' => 50]) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('capacitacao_nupdec', 'Capacitação do Nudec ( Especialidade Atuação )') }}:
                                    {{ Form::text('capacitacao_nupdec', $compdec->capacitacao_nupdec, ['class' => 'form form-control', 'maxlength' => 70]) }}
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('org_rep', 'Órgão Representante da COMPDEC') }}:
                                    {{ Form::text('org_rep', $compdec->org_rep, ['class' => 'form form-control', 'maxlength' => 45]) }}
                                    <br>
                                </div>

                            </div>
                            <div class='row'>

                                <div class='col'>
                                    {{ Form::label('plano_cont', 'Possui Plano Contingência') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('plano_cont', 1, $compdec->plano_cont == 1 ? true : false) }}
                                        <label class='form-check-label' for='plano_cont'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('plano_cont', 0, $compdec->plano_cont == 0 ? true : false) }}
                                        <label class='form-check-label' for='plano_cont'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>

                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('cartao_pdc', 'Possui Cartão de PDC') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('cartao_pdc', 1, $compdec->cartao_pdc == 1 ? true : false) }}
                                        <label class='form-check-label' for='cartao_pdc'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('cartao_pdc', 0, $compdec->cartao_pdc == 0 ? true : false) }}
                                        <label class='form-check-label' for='cartao_pdc'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('sede_propria', 'Possui Sede Propria') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('sede_propria', 1, $compdec->sede_propria == 1 ? true : false) }}
                                        <label class='form-check-label' for='sede_propria'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('sede_propria', 0, $compdec->sede_propria == 0 ? true : false) }}
                                        <label class='form-check-label' for='sede_propria'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('viatura', 'Possui Viatura') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('viatura', 1, $compdec->viatura == 1 ? true : false) }}
                                        <label class='form-check-label' for='viatura'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('viatura', 0, $compdec->viatura == 0 ? true : false) }}
                                        <label class='form-check-label' for='viatura'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('simulado', 'Participa de Simulados') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('simulado', 1, $compdec->simulado == 1 ? true : false) }}
                                        <label class='form-check-label' for='simulado'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('simulado', 0, $compdec->simulado == 0 ? true : false) }}
                                        <label class='form-check-label' for='simulado'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>


                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('mapeamento', 'Possui Mapeamento Àrea de Risco') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('mapeamento', 1, $compdec->mapeamento == 1 ? true : false) }}
                                        <label class='form-check-label' for='mapeamento'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('mapeamento', 0, $compdec->mapeamento == 0 ? true : false) }}
                                        <label class='form-check-label' for='mapeamento'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('computador', 'Possui Computador') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('computador', 1, $compdec->computador == 1 ? true : false) }}
                                        <label class='form-check-label' for='computador'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('computador', 0, $compdec->computador == 0 ? true : false) }}
                                        <label class='form-check-label' for='computador'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>

                            </div>


                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('curso_gestao', 'Possui Curso Gestão PDC Mud. Climaticas') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('curso_gestao', 1, $compdec->curso_gestao == 1 ? true : false) }}
                                        <label class='form-check-label' for='curso_gestao'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('curso_gestao', 0, $compdec->curso_gestao == 0 ? true : false) }}
                                        <label class='form-check-label' for='curso_gestao'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('dt_curso_gestao', 'Data Curso Gestão') }}:
                                    {{ Form::date('dt_curso_gestao', $compdec->dt_curso_gestao, ['class' => 'form form-control']) }}
                                    <br>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('curso_sco', 'Possui Curso SCO') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('curso_sco', 1, $compdec->curso_sco == 1 ? true : false) }}
                                        <label class='form-check-label' for='curso_sco'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('curso_sco', 0, $compdec->curso_sco == 0 ? true : false) }}
                                        <label class='form-check-label' for='curso_sco'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('dt_curso_sco', 'Data Curso SCO') }}:
                                    {{ Form::date('dt_curso_sco', $compdec->dt_curso_sco, ['class' => 'form form-control']) }}
                                    <br>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('exp_dc', 'Possui Experiência Defesa Civil') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('exp_dc', 1, $compdec->exp_dc == 1 ? true : false) }}
                                        <label class='form-check-label' for='exp_dc'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('exp_dc', 0, $compdec->exp_dc == 0 ? true : false) }}
                                        <label class='form-check-label' for='exp_dc'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('tp_ex_dc', 'Tempo Experiência Defesa Civil (em Anos)') }}:
                                    {{ Form::number('tp_ex_dc', $compdec->tp_ex_dc, ['class' => 'form form-control', 'max' => 30]) }}
                                    <br>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('particip_workshop', 'Participou Workshop') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('particip_workshop', 1, $compdec->particip_workshop == 1 ? true : false) }}
                                        <label class='form-check-label' for='particip_workshop'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('particip_workshop', 0, $compdec->particip_workshop == 0 ? true : false) }}
                                        <label class='form-check-label' for='particip_workshop'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('dt_partic_workshop', 'Data Participação Workshop') }}:
                                    {{ Form::date('dt_partic_workshop', $compdec->dt_partic_workshop, ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('possui_plano', 'Possui Plano de Contingencia') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('possui_plano', 1, $compdec->possui_plano == 1 ? true : false) }}
                                        <label class='form-check-label' for='possui_plano'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('possui_plano', 0, $compdec->possui_plano == 0 ? true : false) }}
                                        <label class='form-check-label' for='possui_plano'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('possui_cartao_def', 'Possui Cartão de Defesa Civil') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('possui_cartao_def', 1, $compdec->possui_cartao_def == 1 ? true : false) }}
                                        <label class='form-check-label' for='possui_cartao_def'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('possui_cartao_def', 0, $compdec->possui_cartao_def == 0 ? true : false) }}
                                        <label class='form-check-label' for='possui_cartao_def'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('possui_capacitacao', 'Possui Capacitação') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('possui_capacitacao', 1, $compdec->possui_capacitacao == 1 ? true : false) }}
                                        <label class='form-check-label' for='possui_capacitacao'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('possui_capacitacao', 0, $compdec->possui_capacitacao == 0 ? true : false) }}
                                        <label class='form-check-label' for='possui_capacitacao'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('dt_capacitacao', 'Data da Capacitação') }}:
                                    {{ Form::date('dt_capacitacao', $compdec->dt_capacitacao, ['class' => 'form form-control']) }}
                                    <br>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('com_const', 'Possui Compdec Sim/Nao') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('com_const', 1, $compdec->com_const == 1 ? true : false) }}
                                        <label class='form-check-label' for='com_const'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('com_const', 0, $compdec->com_const == 0 ? true : false) }}
                                        <label class='form-check-label' for='com_const'>
                                            Não
                                        </label>
                                    </div>

                                    <br>
                                </div>
                                <div class='col'>
                                    {{ Form::label('com_ativa', 'Compdec Ativa') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('com_ativa', 1, $compdec->com_ativa == 1 ? true : false) }}
                                        <label class='form-check-label' for='com_ativa'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('com_ativa', 0, $compdec->com_ativa == 0 ? true : false) }}
                                        <label class='form-check-label' for='com_ativa'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('sem_decreto', 'Possui Decreto') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('sem_decreto', 1, $compdec->sem_decreto == 1 ? true : false) }}
                                        <label class='form-check-label' for='sem_decreto'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('sem_decreto', 0, $compdec->sem_decreto == 0 ? true : false) }}
                                        <label class='form-check-label' for='sem_decreto'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>

                                <div class='col'>
                                    {{ Form::label('sem_portaria', 'Possui Portaria') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('sem_portaria', 1, $compdec->sem_portaria == 1 ? true : false) }}
                                        <label class='form-check-label' for='sem_portaria'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('sem_portaria', 0, $compdec->sem_portaria == 0 ? true : false) }}
                                        <label class='form-check-label' for='sem_portaria'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('sem_lei', 'Possui lei de criação de COMPDEC') }}:
                                    <div class='form-check'>
                                        {{ Form::radio('sem_lei', 1, $compdec->sem_lei == 1 ? true : false) }}
                                        <label class='form-check-label' for='sem_lei'>
                                            Sim
                                        </label>
                                    </div>
                                    <div class='form-check'>
                                        {{ Form::radio('sem_lei', 0, $compdec->sem_lei == 0 ? true : false) }}
                                        <label class='form-check-label' for='sem_lei'>
                                            Não
                                        </label>
                                    </div>
                                    <br>
                                </div>
                                <div class='col'>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    {{ Form::label('email2', 'Email 2 - Alternativo') }}:
                                    {{ Form::email('email2', $compdec->email2, ['class' => 'form form-control', 'maxlength' => 100]) }}
                                </div>
                                <div class='col'>
                                    {{ Form::label('email3', 'Email 3 - Alternativo') }}:
                                    {{ Form::text('email3', $compdec->email3, ['class' => 'form form-control', 'maxlength' => 100]) }}
                                    <br>
                                </div>
                                <br>
                            </div>

                            <div class="row">
                                <div class="text-center col">
                                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>


                        </div>

                        <!-- LISTA MEMBROS EQUIPE -->
                        <div class="tab-pane fade" id="equipe-tab" role="tabpanel" aria-labelledby="equipe-tab">
                            <br>
                            <br>
                            <legend class="alert alert-info">Equipe Compdec</legend>


                            <!-- BUTTON ADICIONAR MEMBROS EQUIPE -->
                            <p>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#modal-equipe">
                                    Adicionar Membro Equipe
                                </button>
                            </p>
                            <br>

                            <table class="table table-bordered table-sm table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Cod</th>
                                    <th>Nome</th>
                                    <th>Funcao</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                                @foreach ($compdec->equipes as $key => $equipe)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $equipe->id }}</td>
                                        <td>{{ $equipe->nome }}</td>
                                        <td>{{ $equipe->funcao }}</td>
                                        <td>{{ $equipe->telefone }}</td>
                                        <td>{{ $equipe->celular }}</td>
                                        <td>{{ $equipe->email }}</td>
                                        <td><button type="button" name='edit_membro' class="btn btn-link" data-toggle="modal"
                                                data-target="#modal-equipe" data-id={{ $equipe->id }}>
                                                <img src='{{ asset('imagem/icon/editar.png') }}'>
                                            </button>
                                            <a href='{{ url('compdec.delete/' . $equipe->id) }}'
                                                onclick="return confirm('Deseja exluir registro ?')"> <img
                                                    src='{{ asset('imagem/icon/delete.png') }}'></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <!-- LISTA ARQUIVOS LEIS DOCUMENTOS -->
                        <div class="tab-pane fade" id="arquivo-tab" role="tabpanel" aria-labelledby="arquivos-tab">

                            <br>

                            <legend class="alert alert-info">Anexos Lei Criação / Decretos / Portaria de Nomeação</legend>
                            <p>
                                <!-- BUTTON ANEXO LEIS E DOCUMENTOS -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-leis">
                                    Anexar Documento
                                </button>


                            </p>

                            <table class="table table-bordered table-sm table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Cod</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Validade</th>
                                    <th>Data Inserção</th>
                                    <th>Ações</th>
                                </tr>
                                @foreach ($compdec->arquivos as $key => $arquivo)
                                    {{ $vencido = '' }}
                                    @if (\Carbon\Carbon::parse($arquivo->validade) < \Carbon\Carbon::today())
                                        @php $vencido = "class='alert alert-danger' title='Documento Vencido Favor re-anexá-lo'"; @endphp
                                    @endif
                                    <tr>
                                        <td {!! $vencido !!}>{{ $key + 1 }}</td>
                                        <td {!! $vencido !!}>{{ $arquivo->id }}</td>
                                        <td {!! $vencido !!}><a
                                                href='{{ url('compdec/visualizar/' . $arquivo->arquivo) }}'>{{ $arquivo->nome }}</a>
                                        </td>
                                        <td {!! $vencido !!}>{{ $arquivo->descricao }}</td>
                                        <td {!! $vencido !!}>
                                            {{ \Carbon\Carbon::parse($arquivo->validade)->format('d/m/Y') }}</td>
                                        <td {!! $vencido !!}>
                                            {{ \Carbon\Carbon::parse($arquivo->dt_anexo)->format('d/m/Y h:i:s') }}</td>

                                        <td><a href='{{ url('leis.delete/' . $arquivo->id) }}'
                                                onclick="return confirm('Deseja exluir registro ?')">
                                                <img src='{{ asset('imagem/icon/delete.png') }}'></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <!-- LISTA PLANO CONTINGENCIA -->
                        <div class="tab-pane fade" id="plano-tab" role="tabpanel" aria-labelledby="plano-tab">
                            <br>
                            <legend class="alert alert-info">Plano de Contigência</legend>
                            <p>

                                @if (count($compdec->plano_contingencia) == 1)
                                    <!-- BUTTON ANEXO PLANO CONTINGENCIA -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal-plano">
                                        Upload Plano de Continngência
                                    </button>
                                    ou
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal-plano">
                                        Link do Google Drive
                                    </button>
                                    <a class="btn btn-primary btn-sm" href='#'></a>
                                @endif
                            </p>
                            <table class="table table-bordered table-sm table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Nome Arquivo</th>
                                    <th>Versao</th>
                                    <th>Data /Hora</th>
                                    <th>Tamanho</th>
                                    <th>Obs</th>
                                    <th>Ações</th>
                                </tr>
                                @foreach ($compdec->plano_contingencia as $key => $plano)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><a
                                                href={{ url('compdec/viewplano/' . $plano->file_plano) }}>{{ $plano->file_plano }}</a>
                                        </td>
                                        <td>{{ $plano->versao }}</td>
                                        <td>{{ $plano->dt_upload }}</td>
                                        <td>{{ $plano->tamanho }}</td>
                                        <td><a href='#collapse-{{ $plano->id }}' title='Clique aqui para expandir !'
                                                data-toggle="collapse" role="button" aria-expanded="false"
                                                aria-controls="collapseExample">
                                                {{ Str::limit($plano->obs, 10) . '....' }}
                                            </a>
                                            <div class="collapse" id="collapse-{{ $plano->id }}">
                                                <div class="card card-body">
                                                    {{ $plano->obs }}
                                                </div>
                                            </div>
                                        </td>

                                        <td><a href='{{ url('compdec/deleteplano/' . $plano->id) }}'
                                                onclick="return confirm('Deseja exluir registro ?')">
                                                <img src='{{ asset('imagem/icon/delete.png') }}'></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>

                </div>



                <!-- MODAL EQUIPE COMPDEC -->
                <div class="modal modal-xl fade" id="modal-equipe" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-lg modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Membros Equipe</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    {{ Form::open(['url' => 'compdec.equipe/' . $compdec->id]) }}

                                    {{ Form::hidden('id_municipio', $compdec->id_municipio) }}

                                    <div class="row">
                                        <div class="col-md-9">
                                            {{ Form::label('nome', 'Nome do Funcionário') }}:
                                            {{ Form::text('nome', '', ['class' => 'form form-control', 'maxlength' => 70, 'required']) }}
                                            <br>
                                        </div>

                                        <div class="col-md-3">
                                            {{ Form::label('funcao', 'Funcao do Funcionario') }}:
                                            {{ Form::select(
                                                'funcao',
                                                [
                                                    'Coordenador' => 'Coordenador',
                                                    'Secretário' => 'Secretário',
                                                    'Engenheiro' => 'Engenheiro',
                                                    'Agente Defesa Civil' => 'Agente Defesa Civil',
                                                ],
                                                '',
                                                ['class' => 'form form-control', 'required'],
                                            ) }}
                                            <br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            {{ Form::label('email', 'Email do Membro da Equipe') }}:
                                            {{ Form::email('email', '', ['class' => 'form form-control', 'maxlength' => 100, 'required']) }}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            {{ Form::label('telefone', 'Telefone do Membro da Equipe') }}:
                                            {{ Form::text('telefone', '', ['class' => 'form form-control', 'maxlength' => 20, 'required']) }}
                                        </div>
                                        <div class="col">


                                            {{ Form::label('celular', 'Celular do Membro da Equipe') }}:
                                            {{ Form::text('celular', '', ['class' => 'form form-control', 'maxlength' => 20]) }}
                                        </div>
                                    </div>
                                    <br>
                                    {{ Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'btnEditar']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL UPLOAD DE ARQUIVOS LEIS  -->
                <div class="modal modal-lg fade" id="modal-leis" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-lg modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Upload de Arquivos</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Extensões Permitidas : <b><span style='color:red'>PDF, DOC, DOCX, ODT</span></b></p>
                                <p>Tamanho máximo : <b><span style='color:red'>2Mb</span></b></p>

                                {{ Form::open(['url' => 'compdec.leis/' . $compdec->id, 'files' => true]) }}

                                {{ Form::hidden('id_municipio', $compdec->id_municipio) }}

                                {{ Form::label('arquivo', 'Arquivo para Upload') }}:<br>
                                {{ Form::file('arquivo') }}

                                <br>
                                {{ Form::label('nome', 'Nome do Documento') }}:
                                {{ Form::text('nome', '', ['class' => 'form form-control', 'maxlength' => 70, 'required']) }}

                                <br>
                                {{ Form::label('descricao', 'Descrição') }}:
                                {{ Form::text('descricao', '', ['class' => 'form form-control', 'maxlength' => 110, 'required']) }}

                                <br>
                                {{ Form::submit('Upload', ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL PLANO DE CONTINGÊNCIA -->
                <div class="modal modal-lg fade" id="modal-plano" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-lg modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Upload Plano de Contingência</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Extensões Permitidas : <b><span style='color:red'>PDF, DOC, DOCX, ODT</span></b></p>
                                <p>Tamanho máximo : <b><span style='color:red'>20Mb</span></b></p>

                                {{ Form::open(['url' => 'compdec.plano/' . $compdec->id, 'files' => true]) }}

                                {{ Form::hidden('id_municipio', $compdec->id_municipio) }}

                                {{ Form::label('file_plano', 'Arquivo para Upload') }}:<br>
                                {{ Form::file('file_plano') }}

                                <br>
                                {{ Form::label('obs', 'Observação') }}:
                                {{ Form::textarea('obs', '', ['class' => 'form form-control', 'maxlength' => 200, 'required', 'rows' => 5]) }}

                                <br>
                                {{ Form::submit('Upload', ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}

                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@stop



@section('css')

@stop

@section('code')


    <script type='text/javascript'>
        $(document).ready(function() {

            $("#fone_com1").inputmask('(99) 9999[9]-9999');
            $("#fone_com2").inputmask('(99) 9999[9]-9999');
            $("#fax").inputmask('(99) 9999[9]-9999');

            $("#telefone").inputmask('(99) 9999[9]-9999');
            $("#celular").inputmask('(99) 9999[9]-9999');

            /* cad municipio */
            $("#tel_pref").inputmask('(99) 9999[9]-9999');
            $("#cel_pref").inputmask('(99) 9999[9]-9999');
            $("#tel").inputmask('(99) 9999[9]-9999');
            $("#cep").inputmask('99999-999');



            /* ativar tab */
            $("{{ $tab }}").trigger("click");

            $('#form_upload_foto_prefeito').hide();
            $('#form_upload_foto_compdec').hide();

            $('#btnPref').click(function() {
                $('#alt_foto_prefeito').toggle();
                $('#form_upload_foto_prefeito').toggle();
            });

            $('#btnCompdec').click(function() {
                $('#alt_foto_compdec').toggle();
                $('#form_upload_foto_compdec').toggle();
            });

            $("#cobra_iss").change(function() {
                if ($("#cobra_iss").val() == 'SIM') {
                    $("#aliquota_iss").val(0);
                    $("#aliquota_iss").attr('disabled', true);
                    $("#num_lei_iss").attr('disabled', true);
                    $("#num_lei_iss").val(0);
                    $("#resp_cob_iss").attr('disabled', true);
                    $("#resp_cob_iss").val('Inexistente');
                } else {
                    $("#aliquota_iss").attr('disabled', false);
                    $("#num_lei_iss").attr('disabled', false);
                    $("#resp_cob_iss").attr('disabled', false);

                }
            });

            if ($("#cobra_iss").val() == 'SIM') {
                $("#aliquota_iss").val(0);
                $("#aliquota_iss").attr('disabled', true);
                $("#num_lei_iss").attr('disabled', true);
                $("#num_lei_iss").val(0);
                $("#resp_cob_iss").attr('disabled', true);
                $("#resp_cob_iss").val('Inexistente');
            }

            $('#fileUploadForm').ajaxForm({
                beforeSend: function() {
                    var percentage = '0';
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%', function() {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                complete: function(xhr) {
                    console.log('File has uploaded');
                }
            });

            /* popular dados equipe editar*/
            $('[name=edit_membro]').click(function(event) {

                event.preventDefault();

                var id = $(this).data('id');
                console.log(id)
                $.get('../compdeceq.update/' + id, function(data) {
                    //$('#userCrudModal').html("Edit category");
                    $('#submit').val("Editar");
                    //$('#practice_modal').modal('show');
                    //$('#color_id').val(data.data.id);
                    $('#nome').val(data.data.nome);
                })
            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>


@endsection
