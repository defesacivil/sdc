@include('layouts.master')

<div class="container">
    <div class='col-md-12'>
        {{ Form::open(['url' => 'compdec/update']) }}
        {{ Form::token() }}
        <div class='row'>
            <div class='col'>
                {{ Form::label('id_municipio', '') }}:
                {{ Form::text('id_municipio', '', ['class' => 'form form-control', 'readonly' => 'readonly', 'required']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('regiao', '') }}:
                {{ Form::text('regiao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('associacao', '') }}:
                {{ Form::text('associacao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('num_lei', '') }}:
                {{ Form::text('num_lei', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('dt_lei', '') }}:
                {{ Form::text('dt_lei', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('num_decreto', '') }}:
                {{ Form::text('num_decreto', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('dt_decreto', '') }}:
                {{ Form::text('dt_decreto', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('num_portaria', '') }}:
                {{ Form::text('num_portaria', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('dt_portaria', '') }}:
                {{ Form::text('dt_portaria', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('endereco', '') }}:
                {{ Form::text('endereco', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('fone_com1', '') }}:
                {{ Form::text('fone_com1', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('fone_com2', '') }}:
                {{ Form::text('fone_com2', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('fax', '') }}:
                {{ Form::text('fax', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('efetivo', 'Funcionários Efetivos') }}:
                {{ Form::text('efetivo', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('qtd_efetivo', 'Quantidade Funcionário') }}:
                {{ Form::text('qtd_efetivo', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('email', '') }}:
                {{ Form::text('email', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('nudec', '') }}:
                {{ Form::text('nudec', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('qtd_nudec', 'Quantidade Nudec') }}:
                {{ Form::text('qtd_nudec', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('org_rep', 'Órgão Representante') }}:
                {{ Form::text('org_rep', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('id_territorio', '') }}:
                {{ Form::text('id_territorio', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('fotoCompdec', 'foto Compdec') }}:
                {{ Form::text('fotoCompdec', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('plano_cont', 'Possui Plano Contingência') }}:
                {{ Form::text('plano_cont', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('capacitacao', 'Possui Capacitação em PDC') }}:
                {{ Form::text('capacitacao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('dt_curso_capac', 'Data Capacitação Curso PDC') }}:
                {{ Form::text('dt_curso_capac', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('cartao_pdc', 'Possui Cartão de PDC') }}:
                {{ Form::text('cartao_pdc', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('sede_propria', 'Possui Sede Propria') }}:
                {{ Form::text('sede_propria', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('viatura', 'Possui Viatura') }}:
                {{ Form::text('viatura', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('simulado', 'Participa de Simulados') }}:
                {{ Form::text('simulado', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('mapeamento', 'Possui Mapeamento Àrea de Risco') }}:
                {{ Form::text('mapeamento', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('curso_gestao', 'Possui Curso Gestão PDC Mud. Climaticas') }}:
                {{ Form::text('curso_gestao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('dt_curso_gestao', 'Data Curso Gestão') }}:
                {{ Form::text('dt_curso_gestao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('curso_sco', 'Possui Curso SCO') }}:
                {{ Form::text('curso_sco', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('dt_curso_sco', 'Data Curso SCO') }}:
                {{ Form::text('dt_curso_sco', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('exp_dc', 'Possui Experiência Defesa Civil') }}:
                {{ Form::text('exp_dc', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('tp_ex_dc', 'Tempo Experiência Defesa Civil') }}:
                {{ Form::text('tp_ex_dc', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('computador', 'Possui Computador') }}:
                {{ Form::text('computador', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('particip_workshop', 'Participou Workshop') }}:
                {{ Form::text('particip_workshop', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('dt_partic_workshop', 'Data Participação Workshop') }}:
                {{ Form::text('dt_partic_workshop', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('capacitacao_nupdec', 'Capacitação do Nupdec') }}:
                {{ Form::text('capacitacao_nupdec', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('possui_plano', 'Possui Plano de Contingencia') }}:
                {{ Form::text('possui_plano', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('possui_capacitacao', 'Possui Capacitação') }}:
                {{ Form::text('possui_capacitacao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('dt_capacitacao', 'Data da Capacitação') }}:
                {{ Form::text('dt_capacitacao', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('qtd_nupdec', 'Quantidade de Nupdec') }}:
                {{ Form::text('qtd_nupdec', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('possui_cartao_def', 'Possui Cartão de Defesa Civil') }}:
                {{ Form::text('possui_cartao_def', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('com_const', 'Possui Compdec Sim/Nao') }}:
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='com_const' id='com_const1'>
                    <label class='form-check-label' for='com_const'>
                        Sim
                    </label>
                </div>
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='com_const' id='com_const2' checked>
                    <label class='form-check-label' for='com_const'>
                        Não
                    </label>
                </div>

                <br>
            </div>
            <div class='col'>
                {{ Form::label('com_ativa', 'Compdec Ativa') }}:
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='' id='com_ativa'>
                    <label class='form-check-label' for='com_ativa'>
                        Compdec Ativa
                    </label>
                </div>
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('sem_decreto', 'Não Possui Decreto') }}:
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='' id='sem_decreto'>
                    <label class='form-check-label' for='sem_decreto'>
                        Não Possui Decreto
                    </label>
                </div>
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('sem_portaria', 'Não Possui Portaria') }}:
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='' id='sem_portaria'>
                    <label class='form-check-label' for='sem_portaria'>
                        Não Possui Portaria
                    </label>
                </div>
                <br>
            </div>
            <div class='col'>
                {{ Form::label('email2', 'Email 2') }}:
                {{ Form::text('email2', '', ['class' => 'form form-control']) }}
                <br>
            </div>
        </div>
        <div class='row'>
            <div class='col'>
                {{ Form::label('email3', 'Email 3') }}:
                {{ Form::text('email3', '', ['class' => 'form form-control']) }}
                <br>
            </div>
            <div class='col'>
                {{ Form::label('sem_lei', 'Não Possui lei de criação de COMPDEC') }}:
                <div class='form-check'>
                    <input class='form-check-input' type='checkbox' value='' id='sem_lei'>
                    <label class='form-check-label' for='sem_lei'>
                        Não Possui lei de criação de COMPDEC
                    </label>
                </div>
                <br>
            </div>
        </div>
        {{ Form::submit('Gravar', ['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
</div>
