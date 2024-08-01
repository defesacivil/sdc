<div class="row">
    <div class="col">

        {{ Form::open(['url' => 'voluntariado/store', 'id' => 'form_voluntariado']) }}
        <div class="row">
            {{ Form::token() }}
        </div>
        <div class="row shadow p-3">
            <div class="p-3 col-12">
                {{ Form::label('nome', 'Nome', ['class' => 'fw-bold']) }}:
                {{ Form::text('nome', '', ['class' => 'form form-control', 'id' => 'nome', 'placeholder' => 'Nome do Voluntário', 'maxlength' => '110', 'required']) }}
            </div>

            <div class="p-3 col-12">
                {{ Form::label('cpf', 'CPF', ['class' => 'fw-bold']) }}:
                {{ Form::text('cpf', '', ['class' => 'form form-control', 'id' => 'cpf', 'placeholder' => 'CPF', 'maxlength' => '15', 'required']) }}
            </div>

            <div class="p-3 col-12">
                {{ Form::label('ci', 'Carteira de Identidade', ['class' => 'fw-bold']) }}:
                {{ Form::text('ci', '', ['class' => 'form form-control', 'id' => 'ci', 'placeholder' => 'Carteira de Identidade', 'maxlength' => '15', 'required']) }}
            </div>

            <div class="p-3 col-12">
                {{ Form::label('profissao', 'Profissão', ['class' => 'fw-bold']) }}:
                {{ Form::select('profissao', $profissaos, '', ['class' => 'form form-control form-select profissao', 'id' => 'profissao', 'placeholder' => 'Selecione uma Profissão', 'data-alvo_id' => '', 'required']) }}
            </div>

            <div class="p-3 col-12">
                {{ Form::label('atividade', 'Atividade a Exercer', ['class' => 'fw-bold']) }}:
                {{ Form::text('atividade', '', ['class' => 'form form-control', 'id' => 'atividade', 'placeholder' => '', 'maxlength' => '50', 'required']) }}
            </div>

            <div class="p-3 col-12">
                {{ Form::label('email', 'E-mail', ['class' => 'fw-bold']) }}:
                {{ Form::email('email', '', ['class' => 'form form-control', 'id' => 'email', 'placeholder' => '', 'maxlength' => '110', 'required']) }}
            </div>

            <div class="p-3 col-12">
                {{ Form::label('municipio_id', 'Cidade onde Reside', ['class' => 'fw-bold']) }}:
                {{ Form::select('municipio_id', $municipios, '', ['class' => 'municipio_id form form-control', 'id' => 'municipio_id', 'placeholder' => 'Selecione um Município', 'data-alvo_id' => '', 'required']) }}
            </div>

            {{-- Telefone --}}
            <div class="row telefone">
                <div class="p-3 col-12 col-md-6">
                    {{ Form::label('telefone', 'Nº Telefone', ['class' => 'fw-bold']) }}:
                    {{ Form::text('telefone', '', ['class' => 'form form-control', 'id' => 'telefone0', 'name' => 'telefones[]', 'placeholder' => 'Adicione um Número de Telefone','required']) }}
                </div>
                <div class="p-3 col-12 col-md-6">
                    <label class="fw-bold">Tem Whatsapp ?</label><br>
                    <select name="sel_zap[]" id="sel_zap" class="form form-control">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>

            <div id="imendaHTMLtelefone"></div>

            </div>


            <div class="row">
                <div class="col">
                    <a href="#" id="btnAdicionaTelefone" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Telefone</a>
                </div>
            </div>

        </div>

        <div class="row 2">
            <div class="col text-center p-3">
                {{ Form::submit('Salvar', ['class' => 'btn btn-primary', 'id' => 'btn']) }}
            </div>
        </div>
        {{ Form::close() }}

    </div>

</div>
