@extends('adminlte::page')
@section('title', 'Dashboard')
@section('plugins.InputMask', true)
@section('plugins.Sweetalert', true)
@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Biblioteca</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dados</li>
        </ol>
    </nav>
    <legend class="text-center">
        <h1>Edição COMPDEC - <i>{{ $compdec->municipio->nome }}</i></h1>
    </legend>
@stop

@section('content')

    <div class="container">
        @php
            $tab = isset($active_tab) ? $active_tab : 'gerais-tab';
        @endphp

        <div class='col-md-12'>
            <div class="row">
                <div class="col">
                    <!-- ERRO MENSAGEM APOS PROCEDIMENTO -->
                    @if (Session::has('message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ Session::get('message') }}</strong>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Ops!</strong> Ocorreu um erro .
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- ATIVAR TAB APOS RELOAD -->
                    @if (Session::has('active_tab'))
                        @php
                            $tab = Session::get('active_tab');
                        @endphp
                    @else
                        @php
                            $tab = '#-gerais-tab';
                        @endphp
                    @endif
                </div>
            </div>
            <div class='row'>
                <!-- FOTO DO PREFEITO -->
                <div class='col-md-4' id='alt_foto_prefeito'>
                    <div class="card border-dark mb-3" style="max-width: 18rem; max-height: 18rem; min-height: 16rem;">
                        <div class="card-header">Prefeito</div>
                        <div class="card-body text-dark" style='max-width: 200px; max-height:200px'>
                            <p class="card-text">
                                <img class="figure img-thumbnail" style='max-width: 150px; max-height:150px'
                                    src='{{ asset('storage/prefeito/' . $compdec->prefeitura->fotoPref) }}'>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                            <button type="link" class="btn btn-link">Alterar</button><br>
                            <h5 class="card-title">{{ $compdec->municipio->prefeito }}</h5>
                        </div>
                    </div>
                </div>
                {{-- FORM UPLOAD FOTO PREFEITO --}}
                <div class='col-md-4' id='form_upload_foto_prefeito'>
                    {{ Form::open(['url' => 'prefeitura/upload/' . $compdec->id_municipio, 'files' => true]) }}
                    {{ Form::label('fotoPref', 'Upload de Foto do Prefeito') }}:<br>
                    {{ Form::file('fotoPref') }}
                    <br><br>
                    {{ Form::submit('Upload Foto', ['class' => 'btn btn-primary btn-sm']) }}
                    {{ Form::close() }}
                    <br>
                </div>

                <div class="col-md-4" id="div_vazia">
                    &nbsp;
                </div>

                <!-- FOTO DO COORDENADOR -->
                <div class="col-md-4" id='alt_foto_compdec'>
                    <div class="card border-dark mb-3" style="max-width: 18rem; max-height: 18rem; min-height: 16rem;">
                        <div class="card-header">Coordenador</div>
                        <div class="card-body text-dark" style='max-width: 200px; max-height:200px'>
                            <p class="card-text">
                                <img class="figure img-thumbnail" style='max-width: 150px; max-height:150px; '
                                    src='{{ asset('storage/compdec/' . $compdec->fotoCompdec) }}' width='100'
                                    min-heigth='100'>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-success">
                            <button type="link" class="btn btn-link">Alterar</button>
                            <h5 class="card-title">
                                @php
                                    $compdec->equipes->each(function ($item, $key) {
                                        if ($item['funcao'] == 'Coordenador') {
                                            print $item['nome'];
                                        }
                                    });
                                @endphp</h5>
                        </div>
                    </div>
                </div>

                {{-- FORM UPLOAD FOTO COORDENADOR --}}
                <div class='col-md-4' id='form_upload_foto_compdec'>
                    {{ Form::open(['url' => 'compdec/upload/' . $compdec->id, 'files' => true]) }}
                    {{ Form::label('fotoCompdec', 'Upload de Foto do Coordenador') }}:<br>
                    {{ Form::file('fotoCompdec') }}
                    <br><br>
                    {{ Form::submit('Upload Foto', ['class' => 'btn btn-primary btn-sm']) }}
                    {{ Form::close() }}

                </div>


            </div>
        </div>
    </div>

    <!-- TAB´S CADASTRO COMPDEC -->
    <div class='col-md-12'>
        <ul class="nav nav-pills nav-fill" id="tab-compdec" role="tablist">

            {{-- DADOS GERAIS --}}
            <li class="nav-item"><a class="nav-link active" id="-gerais-tab" data-toggle="tab" href="#gerais-tab"
                    role="tab" aria-controls="gerais-tab" aria-selected="true">Dados Gerais</a></li>
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

            <!-- FORM DADOS GERAIS -->
            <div class="tab-pane fade show active" id="gerais-tab" role="tabpanel" aria-labelledby="gerais-tab">


                {{ Form::open(['url' => 'compdec/update/' . $compdec->id]) }}
                {{ Form::token() }}
                {{ Form::hidden('id', $compdec->id, ['readonly' => 'readonly', 'required', 'maxlength' => 5]) }}

                <div class="row">

                    <div class='col'>
                        <br>
                        {{ Form::label('regiao', 'Regiao de Desenvolvimento do Estado') }}:
                        {{ Form::select('regiao_id', $regioes, '', ['class' => 'form form-control']) }}

                        <br>
                    </div>
                    <div class='col'>
                        <br>
                        {{ Form::label('associacao', 'Associação de Municípios') }}:
                        {{ Form::select('associacao_id', $associacoes, '', ['class' => 'form form-control']) }}
                        <br>
                    </div>
                </div>

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
                <div class="row">
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
                <div class='row'>
                    <div class='col'>
                        {{ Form::label('email', 'Email Principal') }}:
                        {{ Form::email('email', $compdec->email, ['class' => 'form form-control', 'maxlength' => 150]) }}
                        <br>
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
                        {{ Form::label('id_territorio', 'Territorio Desenvolvimento') }}:
                        {{ Form::select('territorio_id', $territorios, '', ['class' => 'form form-control']) }}
                        <br>
                    </div>
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
                        {{ Form::date('dt_capacitacao', '', ['class' => 'form form-control']) }}
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
                    <div class="col text-center">
                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>


            </div>

            <!-- LISTA MEMBROS EQUIPE -->
            <div class="tab-pane fade" id="equipe-tab" role="tabpanel" aria-labelledby="equipe-tab">
                <br>
                <legend>Equipe Compdec</legend>
                <!-- BUTTON ADICIONAR MEMBROS EQUIPE -->
                <p>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modal-equipe">
                        Adicionar Membro Equipe
                    </button>
                </p>
                <br>

                <table class="table table-bordered table-condensed">
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
                                    data-target="#modal-equipe" data-id={{$equipe->id}}>
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
                <legend>Anexos Lei Criação / Decretos / Portaria de Nomeação</legend>
                <p>
                    <!-- BUTTON ANEXO LEIS E DOCUMENTOS -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-leis">
                        Anexar Documento
                    </button>


                </p>

                <table class="table table-bordered table-condensed">
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
                <legend>Anexar Plano de Contigência</legend>
                <p>
                    <!-- BUTTON ANEXO PLANO CONTINGENCIA -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modal-plano">
                        Anexar Plano de Continngência
                    </button>
                </p>
                <table class="table table-bordered table-condensed">
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
                            <td><a href={{ url('compdec/viewplano/' . $plano->file_plano) }}>{{ $plano->file_plano }}</a>
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



@stop



@section('css')

@stop

@section('js')

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#fone_com1").inputmask('(99) 9999[9]-9999');
            $("#fone_com2").inputmask('(99) 9999[9]-9999');
            $("#fax").inputmask('(99) 9999[9]-9999');

            $("#telefone").inputmask('(99) 9999[9]-9999');
            $("#celular").inputmask('(99) 9999[9]-9999');

            /* ativar tab */
            $("{{ $tab }}").trigger("click");

            $('#form_upload_foto_prefeito').hide();
            $('#form_upload_foto_compdec').hide();

            $('#alt_foto_prefeito').click(function() {
                $('#alt_foto_prefeito').toggle();
                $('#form_upload_foto_prefeito').toggle();
            });

            $('#alt_foto_compdec').click(function() {
                $('#alt_foto_compdec').toggle();
                $('#form_upload_foto_compdec').toggle();
            });

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
        integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
    </script>

    <script type='text/javascript'>
        $(document).ready(function() {
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

@stop
