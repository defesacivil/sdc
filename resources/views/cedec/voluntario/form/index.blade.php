<div class="row">
    <div class="col">

        <div class="row">
            {{ Form::open(['url' => 'voluntariado/create', 'id' => 'form_voluntariado']) }}
            {{ Form::token() }}
        </div>
        <div class="row">
            <div class="p-3 col-12 col-md-6">
                {{ Form::label('nome', 'Nome', ['class' => 'fw-bold']) }}:
                {{ Form::text('nome', '', ['class' => 'form form-control', 'id' => 'nome', 'placeholder' => 'Nome do Voluntário', 'maxlength' => '110', 'required']) }}
            </div>

            <div class="p-3 col-12 col-md-6">
                {{ Form::label('cpf', 'CPF', ['class' => 'fw-bold']) }}:
                {{ Form::text('cpf', '', ['class' => 'form form-control', 'id' => 'cpf', 'placeholder' => 'CPF', 'maxlength' => '15', 'required']) }}
            </div>

            <div class="p-3 col-12 col-md-6">
                {{ Form::label('ci', 'Carteira de Identidade', ['class' => 'fw-bold']) }}:
                {{ Form::text('ci', '', ['class' => 'form form-control', 'id' => 'ci', 'placeholder' => 'Carteira de Identidade', 'maxlength' => '15', 'required']) }}
            </div>

            <div class="p-3 col-12 col-md-6">
                {{ Form::label('profissao', 'Profissão', ['class' => 'fw-bold']) }}:
                {{ Form::select('profissao', $profissaos, '', ['class' => 'profissao form form-control form-select', 'id' => 'profissao', 'placeholder' => 'Selecione uma Profissão', 'data-alvo_id' => '', 'required']) }}
            </div>

            <div class="p-3 col-12 col-md-6">
                {{ Form::label('atividade', 'Atividade a Exercer', ['class' => 'fw-bold']) }}:
                {{ Form::text('atividade', '', ['class' => 'form form-control', 'id' => 'atividade', 'placeholder' => '', 'maxlength' => '50', 'required']) }}
            </div>

            <div class="p-3 col-12 col-md-6">
                {{ Form::label('email', 'E-mail', ['class' => 'fw-bold']) }}:
                {{ Form::email('email', '', ['class' => 'form form-control', 'id' => 'email', 'placeholder' => '', 'maxlength' => '110', 'required']) }}
            </div>

            <div class="p-3 col-12 col-md-6">
                {{ Form::label('municipio_id', 'Cidade onde Reside', ['class' => 'fw-bold']) }}:
                {{ Form::select('municipio_id', $municipios, '', ['class' => 'municipio_id form form-control', 'id' => 'municipio_id', 'placeholder' => 'Selecione um Município', 'data-alvo_id' => '', 'required']) }}
            </div>

            {{ Form::select('regiao_id', $regiao, '') }}




        </div>

        <div class="row">
            <div class="col text-center p-3">
                {{ Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'btn']) }}
                {{ Form::close() }}
            </div>
        </div>

    </div>


</div>
