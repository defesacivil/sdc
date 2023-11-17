@extends('pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pedido Ajuda Humanitária</li>
        </ol>
    </nav>

@endsection

<!-- ATIVAR TAB APOS RELOAD -->


{{-- @if (Session::has('active-tab')) --}}
@php
    // $tab = explode('/', request()->path())[3];
    //$tab = Session::get('active-tab');
    //dd(explode("/", request()->path()));
    //dd($tab);
@endphp
{{-- @else
    @php
        $tab = '';
        Session::put('active-tab', $tab);
    @endphp
@endif --}}


@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">

            <p class='text-center'><a class='btn btn-success' href='dashboard'>Voltar</a></p><br>

            <div class="row">
                <div class="col">
                    <ul class="nav">
                        <li class="nav-item mr-1">
                            <a class="btn btn-success btn-sm" href="{{ url('ajuda') }}">Voltar</a>
                        </li>
                    </ul>

                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-2">
                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        {{-- INICIAL --}}
                        <li class="nav-item"><a class="nav-link active" id="-inicio-tab" data-toggle="pill" href="#inicio" role="tab" aria-controls="inicio-tab" aria-selected="true">Índice</a></li>

                        {{-- ISS --}}
                        <li class="nav-item"><a class="nav-link" id="-iss-tab" data-toggle="pill" href="#iss" role="tab" aria-controls="iss-tab" aria-selected="true">Informações Iss</a></li>

                        {{-- INFO MUNICIPIO --}}
                        <li class="nav-item"><a class="nav-link" id="-municipio-tab" data-toggle="pill" href="#municipio" role="tab" aria-controls="municipio-tab" aria-selected="true">Informações
                                Municipio</a></li>

                        {{-- DADOS DO COMPDEC --}}
                        <li class="nav-item"><a class="nav-link" id="-compdec-tab" data-toggle="pill" href="#compdec" role="tab" aria-controls="compdec-tab" aria-selected="true">Informações
                                Compdec</a>
                        </li>

                        {{-- PONTO CAPTAÇÃO --}}
                        <li class="nav-item"><a class="nav-link" id="-captacao-tab" data-toggle="pill" href="#captacao" role="tab" aria-controls="captacao-tab" aria-selected="true">Pontos
                                Captação</a>
                        </li>

                        {{-- LOCAIS DE DISTRIBUIÇÃO --}}
                        <li class="nav-item"><a class="nav-link" id="-comunidade-tab" data-toggle="pill" href="#comunidade" role="tab" aria-controls="comunidade-tab" aria-selected="true">Locais
                                Distribuição</a></li>

                        {{-- REPRESENTANTES --}}
                        <li class="nav-item"><a class="nav-link" id="-represent-tab" data-toggle="pill" href="#represent" role="tab" aria-controls="represent-tab"
                                aria-selected="true">Representantes</a>
                        </li>

                        {{-- AÇÕES DE RESPOSTA --}}
                        <li class="nav-item"><a class="nav-link" id="-resposta-tab" data-toggle="pill" href="#resposta" role="tab" aria-controls="resposta-tab" aria-selected="true">Ações de
                                Resposta</a>
                        </li>

                        {{-- ANEXO --}}
                        <li class="nav-item"><a class="nav-link" id="-anexo-tab" data-toggle="pill" href="#anexo" role="tab" aria-controls="anexo-tab" aria-selected="true">Arquiv.
                                Anexos</a></li>

                        {{-- INSTRUÇÕES DE PREENCHIMENTO --}}
                        <li class="nav-item"><a class="nav-link" id="-instrucao-tab" data-toggle="pill" href="#instrucao" role="tab" aria-controls="instrucao-tab"
                                aria-selected="true">Instrução
                                Preenchimento</a></li>

                    </ul>

                </div>


                <div class="col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">                       

                        {{-- ISS --}}
                        <div class="tab-pane fade show" id="iss" role="tabpanel" aria-labelledby="iss-tab">


                            {{ Form::open(['url' => 'iss']) }}
                            {{ Form::token() }}

                            <div class="row">

                                <div class="col form-group">
                                    {{ Form::label('Recolhe ISS ?') }}
                                    {{ Form::select(
                                        'cobra_iss',
                                        [
                                            'sim' => 'Sim',
                                            'nao' => 'Não',
                                        ],
                                        $municipio->cobra_iss,
                                        ['class' => 'form-control', 'id' => 'cobra_iss'],
                                    ) }}

                                </div>
                                <div class="col form-group">
                                    {{ Form::label('Alíquota %') }}
                                    {{ Form::text('aliquota_iss', '', ['class' => 'form-control', 'id' => 'aliquota_iss', 'maxlength' => '4']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('Responsabilidade Cobrança') }}
                                    {{ Form::select('resp_cob_iss', ['-', 'Prestador' => 'Prestador', 'Tomador' => 'Tomador'], '', ['class' => 'form-control', 'id' => 'resp_cob_iss']) }}

                                </div>
                                <div class="col form-group">
                                    {{ Form::label('Número da Lei / Ano') }}
                                    {{ Form::text('num_lei_iss', '', ['class' => 'form-control', 'maxlength' => '20', 'id' => 'num_lei_iss']) }}
                                </div>
                            </div>

                            {{ Form::submit('Gravar', ['class' => 'btn btn-primary', 'id' => 'btnIss']) }}
                            {{ Form::close() }}
                        </div>

                        {{-- INFORMAÇÕES MUNICIPIO --}}
                        <div class="tab-pane fade show" id="municipio" role="tabpanel" aria-labelledby="municipioi-tab">
                            {{ Form::open(['url' => 'municipio']) }}
                            {{ Form::token() }}
                            <div class="row pt-4">
                                <div class="col form-group">

                                    {{ Form::label('Nome do Prefeito') }}
                                    {{ Form::text('nome_prefeito', $municipio->nome_prefeito, ['class' => 'form form-control', 'maxlength' => '45', 'id' => 'nome_prefeito']) }}
                                    {{ Form::hidden('id', $municipio->id, ['maxlength' => '5']) }}
                                </div>

                                <div class="col form-group">
                                    {{ Form::label('Telefone Prefeitura') }}
                                    {{ Form::text('tel_prefeitura', $municipio->tel_prefeitura, ['class' => 'form form-control', 'id' => 'tel_prefeitura', 'maxlength' => '20']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('Fax Prefeitura') }}
                                    {{ Form::text('fax_prefeitura', $municipio->fax_prefeitura, ['class' => 'form-control', 'id' => 'fax_prefeitura', 'maxlength' => '20']) }}
                                </div>

                                <div class="col form-group">
                                    {{ Form::label('Telefone Prefeito') }}
                                    {{ Form::text('tel_prefeito', $municipio->tel_prefeito, ['class' => 'form-control', 'id' => 'tel_prefeito', 'maxlength' => '20']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('Celular Prefeito') }}
                                    {{ Form::text('cel_prefeito', $municipio->cel_prefeito, ['class' => 'form-control', 'id' => 'cel_prefeito', 'maxlength' => '20']) }}
                                </div>
                                <div class="col form-group">
                                    {{ Form::label('Endereço da Prefeitura') }}
                                    {{ Form::text('endereco', $municipio->endereco, ['class' => 'form-control', 'id' => 'endereco', 'maxlength' => '70']) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('Bairro') }}
                                    {{ Form::text('bairro', $municipio->bairro, ['class' => 'form-control', 'id' => 'bairro', 'maxlength' => '45']) }}
                                </div>
                                <div class="col form-group">
                                    {{ Form::label('Cep') }}
                                    {{ Form::text('cep', $municipio->cep, ['class' => 'form-control', 'id' => 'cep', 'maxlength' => '10']) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('Email') }}
                                    {{ Form::text('email_prefeitura', $municipio->email_prefeitura, ['class' => 'form-control', 'id' => 'email_prefeitura', 'maxlength' => '45']) }}
                                </div>

                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('População Urbana') }}
                                    {{ Form::text('populacao', $municipio['populacao'], ['class' => 'form-control', 'id' => 'populacao', 'maxlength' => '8']) }}
                                </div>
                                <div class="col form-group">
                                    {{ Form::label('População Rural') }}
                                    {{ Form::text('pop_rural', $municipio['pop_rural'], ['class' => 'form-control', 'id' => 'pop_rural', 'maxlength' => '8']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    {{ Form::label('Área Território (KM²)') }}
                                    {{ Form::text('area', $municipio['area'], ['class' => 'form-control', 'id' => 'area', 'maxlength' => '45']) }}
                                </div>
                            </div>

                            {{ Form::submit('Gravar', ['class' => 'btn btn-primary', 'id' => 'btnMunicipio']) }}
                            {{ Form::close() }}
                        </div>

                        {{-- INFORMAÇÕES COMPDEC --}}
                        <div class="tab-pane fade show" id="compdec" role="tabpanel" aria-labelledby="compdec-tab">

                            <h4>Equipe da COMPDEC</h4><br>

                            <p class=""><a class="btn btn-success" href="{{ url('/compdec/edit') }}">Alterar Equipe</a></p>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th>Nome Membro</th>
                                    <th>Função</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                </tr>
                                @foreach ($compdecs->equipes as $key => $compdec)
                                    <tr>
                                        <td>{{ $compdec->nome }}</td>
                                        <td>{{ $compdec->funcao }}</td>
                                        <td>{{ $compdec->email }}</td>
                                        <td>{{ $compdec->telefone }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        {{-- PONTO DE CAPCAÇÃO --}}
                        <div class="tab-pane fade show" id="captacao" role="tabpanel" aria-labelledby="captacao-tab">
                            <h4>Ponto de Captação</h4>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pontoSearchModal">
                                *Novo Ponto
                            </button>
                            <br>
                            <div class="col p-2">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm">
                                                <tr>
                                                    <td>Nome</td>
                                                    <td>Tipo</td>
                                                    <td>Latitude</td>
                                                    <td>Longitude</td>
                                                    <td>Capacidade</td>
                                                    <td>Ação</td>
                                                </tr>

                                                @foreach ($pontos as $key => $ponto)
                                                    <tr>
                                                        <td>{{ $ponto->ponto->nome }}</td>
                                                        <td>{{ pmda_tipo_ponto($ponto->ponto->tipo) }}</td>
                                                        <td>{{ $ponto->ponto->latitude }}</td>
                                                        <td>{{ $ponto->ponto->longitude }}</td>
                                                        <td>{{ $ponto->ponto->capacidade }}</td>
                                                        <td><a href="{{ url('pmda/ponto/delete/' . $ponto->id) }}" title="Deletar este ponto de captação deste pmda"><img
                                                                    src="{{ asset('/imagem/icon/delete.png') }}"></td>

                                                    </tr>
                                                @endforeach

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- LOCAIS DE ATENDIMENTO -->
                        <div class="tab-pane fade show" id="comunidade" role="tabpanel" aria-labelledby="comunidade-tab">

                            <p class="text-center">
                            <h4>Locais de Atendimento</h4>
                            </p>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#localAtendModal">
                                *Nova Comunidade
                            </button>
                            <br>
                            <br>

                            Comunidades : {{ count($comunidades) }}
                            <table class="table table-reponsive table-bordered">
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>Comunidade</strong></td>
                                    <td><strong>Latitude/Longitude</strong></td>
                                    <td><strong>População</strong></td>
                                    <td><strong>Opções</strong></td>
                                </tr>
                                @foreach ($comunidades as $key => $comunidade)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $comunidade->comunidade->comunidade }}</td>
                                        <td>{{ $comunidade->latitude }} | {{ $comunidade->longitude }}</td>
                                        <td>{{ $comunidade->pop_atendida }}</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach
                            </table>

                        </div>

                        <!-- REPRESENTANTE -->
                        <div class="tab-pane fade show" id="represent" role="tabpanel" aria-labelledby="represent-tab">

                            <p class="text-center">
                            <h4>Representantes</h4>
                            </p>

                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::label('Nome Representante') }}
                                    {{ Form::text('nome', '', ['class' => 'form-control']) }}
                                    {{ Form::text('comunidade_id', '') }}
                                    {{ Form::text('pmda_id', '') }}
                                </div>
                                <div class="col">
                                    {{ Form::label('Cpf do Representante') }}
                                    {{ Form::text('cpf', '', ['class' => 'form-control', 'id' => 'cpf_rep', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '14']) }}
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::label('Telefone Representante') }}
                                    {{ Form::text('tel', '', ['class' => 'form-control', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '20']) }}
                                </div>
                                <div class="col">
                                    {{ Form::label('Esse número possiu WhatsApp ?') }}
                                    {{ Form::select('watspp', ['sim' => 'Sim', 'nao' => 'Não'], '', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::label('Endereço do Representante') }}
                                    {{ Form::text('endereco', '', ['class' => 'form-control', 'placeholder' => 'Opcional Endereco do Representante', 'maxlength' => '70']) }}
                                </div>
                                <div class="col">
                                    {{ Form::label('Bairro') }}
                                    {{ Form::text('bairro', '', ['class' => 'form-control', 'placeholder' => 'Opcional', 'maxlength' => '45']) }}
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col">

                                    {{ Form::label('Email') }}
                                    {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Opcional', 'maxlength' => '100']) }}
                                </div>
                                <div class="col">
                                </div>
                            </div>

                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                                    {{ Form::close() }}

                                </div>
                            </div>

                        </div>

                        <!-- AÇÕES DE RESPOSTA -->
                        <div class="tab-pane fade show" id="resposta" role="tabpanel" aria-labelledby="resposta-tab">
                            <h4>Ações de Respostas de Enfrentamento</h4>
                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::label('Descrição das Ações') }}
                                    {{ Form::textarea('acoes', '', ['class' => 'form form-control', 'rows' => '6', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '16777']) }}
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::label('Quantos caminhões PIPA, pertencentes e/ou contratados pelo município') }}
                                    {{ Form::text('qtd_caminhao', '', ['class' => 'form-control', 'maxlength' => '2']) }}
                                </div>
                                <div class="col">
                                    {{ Form::label('População Atendida') }}
                                    {{ Form::text('pop_at_municipio', '', ['class' => 'form-control', 'maxlength' => '4']) }}
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>

                        {{-- ANEXO E DOCUMENTOS --}}
                        <div class="tab-pane fade show" id="anexo" role="tabpanel" aria-labelledby="anexo-tab">
                            <h4>Documentação e Anexos</h4>

                            <h5>
                                <p class="alert alert-danger">Para envio do PMDA é obrigatório fazer o Download do "TERMO DE COMPROMISSO". preencher, assinar e enviar copia digitalizada anexada no
                                    sistema, e a inserção de cópia de ofício em papel timbrado da Prefeitura Municipal, contendo as seguintes informações:</p>
                            </h5>

                            <li>1. Se o município possui lei que institui cobrança do Imposto sobre Serviços (ISS) ou equivalnete;</li>
                            <li>2. Se o imposto incide sobre o serviço de Transporte e Distribuição de Água Potável;</li>
                            <li>3. Se incidente, qual a alíquota aplicável e qual a base de cálculo;</li>
                            <li>4. A quem cabe a responsabilidade pelo pagamento (se ao prestador ou ao contratante)."</li>
                            <br>

                            {{ Form::open(['url' => 'municipio']) }}
                            {{ Form::token() }}

                            <div class="row">
                                <div class="col p-2">
                                    {{ Form::text('id_pmda', '') }}
                                    {{ Form::date('dt_anexo', '') }}

                                    {{ Form::label('Descrição do Arquivo') }}
                                    {{ Form::text('descricao', '', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col p-2">

                                    {{ Form::label('Arquivo para Upload') }}<br>
                                    {{ Form::file('arquivo') }}

                                </div>

                            </div>

                            <div class="row p-2">
                                <div class="col">
                                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                                    {{ Form::close() }}

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Data</th>
                                            <th scope="col">Arquivo</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($anexos as $key => $anexo)
                                            <tr class="">
                                                <td scope="row">{{ $key + 1 }}</td>
                                                <td scope="row">{{ $anexo->dt_anexo }}</td>
                                                <td scope="row">{{ $anexo->arquivo }}</td>
                                                <td scope="row">{{ $anexo->descricao }}</td>
                                                <td scope="row">
                                                    <a href='#'>Deletar</a>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>



                        </div>

                        {{-- INSTRUÇÃO --}}
                        <div class="tab-pane fade show" id="instrucao" role="tabpanel" aria-labelledby="instrucao-tab">
                            <div class="border p-2 overflow-auto" id="iss-info">
                                <h3>Ajuda</h3>

                                <b>Recolhe Iss :</b>
                                <p class="p-2">Caso o municpio faça o recolhimento de ISS, responda sim.</p>

                                <b>Aliqueta ISS</b>
                                <p class="p-2">Qual a aliquita da Cobrança de ISS</p>

                                <b>Responsabilidade Cobrança</b>
                                <p class="p-2">Em caso de cobrança qual a responsabilidade de recolhimento do <b>Prestador</b> ou do <b>Tomador</b> </p>

                                <b>Nr Lei /Ano</b>
                                <p class="p-2">Número da Lei e Ano, de Sanção</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">

                <!-- Modal PONTO CAPTAÇÃO-->
                <div class="modal fade bd-example-modal-lg" id="pontoModal" tabindex="-1" role="dialog" aria-labelledby="pontoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pontoModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                {{ Form::open(['url' => 'ponto']) }}
                                {{ Form::token() }}
                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Nome') }}
                                        {{ Form::text('nome', '', ['class' => 'form-control', 'id' => 'nome', 'placeholder' => 'Campo Obrigatório']) }}

                                    </div>
                                    <div class="col">
                                        {{ Form::label('Local de Captação') }}
                                        {{ Form::select(
                                            'tipo',
                                            ['0' => 'Selecione o Tipo', '1' => 'COPASA', '2' => 'COPANOR', '3' => 'BARRAGEM', '4' => 'SAAE/DMAE', '5' => 'POÇO ARTESIANO PÚBLICO', '6' => 'POÇO ARTESIANO PARTICULAR'],
                                            '',
                                            ['class' => 'form-control', 'id' => 'tipo'],
                                        ) }}

                                    </div>
                                </div>

                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Latitude') }}<i>?</i>
                                        {{ Form::text('latitude', '', ['class' => 'form-control', 'id' => 'latitude', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '11']) }}

                                    </div>
                                    <div class="col">
                                        {{ Form::label('Longitude') }} <i>?</i>
                                        {{ Form::text('longitude', '', ['class' => 'form-control', 'id' => 'longitude', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '11']) }}
                                        {{ Form::hidden('municipio', $municipio->id, ['class' => 'form-control', 'id' => 'municipio_id']) }}

                                    </div>
                                </div>

                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Capacidade M³') }}
                                        {{ Form::text('capacidade', '', ['class' => 'form-control', 'id' => 'capacidade', 'placeholder' => 'Opcional', 'maxlength' => '4']) }}

                                    </div>
                                    <div class="col"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                {{ Form::submit('Gravar', ['class' => 'btn btn-primary', 'id' => 'btnPonto']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUSCA PONTO CAPTAÇÃO-->
                <div class="modal fade bd-example-modal-lg" id="pontoSearchModal" tabindex="-1" role="dialog" aria-labelledby="pontoSearchlLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pontoSearchLabel">Busca Ponto de Captação</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                {{ Form::open(['url' => 'ponto']) }}
                                {{ Form::token() }}
                                <div class="row">
                                    <div class="col p-2">
                                        {{ Form::label('Nome:') }} <span> (Busca pelo nome do ponto ou tipo ex: COPASA, COPANOR, ETC.)</span>
                                        {{ Form::text('searchPonto', 'copanor', ['class' => 'form-control', 'id' => 'searchPonto', 'placeholder' => 'Campo Obrigatório']) }}

                                    </div>
                                    <table class="table" id="tbl-lista-ponto">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>Município</th>
                                                <th>Coordenadas</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                {{ Form::submit('Buscar', ['class' => 'btn btn-primary', 'id' => 'btnSearchPonto']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LOCAL DE DISTRIBUIÇÃO -->

                <div class="modal fade bd-example-modal-lg" id="localAtendModal" tabindex="-1" role="dialog" aria-labelledby="localAtendModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pontoModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Nome') }}
                                        {{ Form::text('nome1', '', ['class' => 'form-control', 'id' => 'nome1', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '45']) }}
                                        {{ Form::text('municipio_id', $municipio->id, ['id' => 'municipio_id']) }}
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Latitude&') }}
                                        {{ Form::text('latitude', '', ['class' => 'form-control', 'id' => 'latitude_comun', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '11']) }}
                                    </div>
                                    <div class="col">
                                        {{ Form::label('longitude') }}
                                        {{ Form::text('longitude', '', ['class' => 'form-control', 'id' => 'longitude_comun', 'placeholder' => 'Campo Obrigatório', 'maxlength' => '11', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Ponto Captação') }}
                                        {{ Form::select('ponto_id', $pontos_sel, '', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="col">
                                        {{ Form::label('Trecho Pavimentado (Km)') }}
                                        {{ Form::number('trecho_pav', '', ['class' => 'form-control', 'placeholder' => 'Campo Obrigatório', 'max' => '500', 'maxlength' => '5', 'required' => 'required']) }}
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Trecho Não Pavimentado (Km)') }}
                                        {{ Form::text('trecho_n_pav', '', ['class' => 'form-control', 'placeholder' => 'Campo Obrigatório', 'max' => '500', 'maxlength' => '5', 'required' => 'required']) }}
                                    </div>
                                    <div class="col">
                                        {{ Form::label('Distância Total (Km)') }}
                                        {{ Form::text('tot_distancia', '', ['class' => 'form-control', 'id' => 'tot_distancia', 'readonly' => 'readonly', 'maxlength' => '5']) }}
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::label('Número População Atendida') }}
                                        {{ Form::text('pop_atendida', '', ['class' => 'form-control', 'placeholder' => 'Campo Obrigatório', 'max' => '3000', 'maxlength' => '4']) }}
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col">
                                        {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                                        {{ Form::close() }}
                                    </div>
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

            <script type="text/javascript">
                $(document).ready(function() {     

                    /* ativar tab */
                    //$("#tab").trigger("click");

                    // $('a[data-toggle="pill"]').click('shown.bs.tab', function(e) {

                    //     //$('.nav-pills li').removeClass('active');
                    //     //$(this).addClass('active');   

                    //     var target = $(e.target).attr("id") // activated tab
                    //     window.location = '{{ url('pmda/edit/' . $pmda->id) }}/'+target;
                    //     //alert(target);
                    // });

                    $(function() {
                        $('a[data-toggle="tab"]').on('click', function(e) {
                            window.localStorage.setItem('activeTab', $(e.target).attr('href'));
                        });
                        var activeTab = window.localStorage.getItem('activeTab');
                        if (activeTab) {
                            $('#v-pills-tab a[href="' + activeTab + '"]').tab('show');
                            window.localStorage.removeItem("activeTab");
                        }
                    });



                    //$('modal').on('hidden.bs.modal', function(e) {});

                    $('#tel1').inputmask('(99) 9999[9]-9999');
                    $('#fax').inputmask('(99) 9999[9]-9999');
                    $('#tel_pref').inputmask('(99) 9999[9]-9999');
                    $('#cel_pref').inputmask('(99) 9999[9]-9999');
                    $('#cep').inputmask('99999-999');

                    $('#latitude, #longitude').inputmask('-99.999999');
                    $('#latitude_comun, #longitude_comun').inputmask('-99.999999');

                    $('#cpf_rep').inputmask('999.999.999-99');

                    $('a[name=btnDelPonto]').click(function() {
                        alert(this);
                        confirm('Deseja remover este ponto de captação deste PMDA ?')


                    });

                    /* iss */
                    $('#btnIss').click(function(e) {
                        e.preventDefault();

                        var _token = $("input[name='_token']").val();
                        var cobra_iss = $("#cobra_iss").val();
                        var resp_cob_iss = $("#resp_cob_iss").val();
                        var num_lei_iss = $("#num_lei_iss").val();
                        var aliquota_iss = $("#aliquota_iss").val();
                        var id = {{ $municipio['id'] }};

                        $.ajax({
                            url: "{{ route('updateIss') }}",
                            type: 'POST',
                            data: {
                                _token: _token,
                                cobra_iss: cobra_iss,
                                resp_cob_iss: resp_cob_iss,
                                num_lei_iss: num_lei_iss,
                                aliquota_iss: aliquota_iss,
                                id: id,
                            },
                            success: function(data) {
                                toastr.options.onHidden = function() {
                                    window.location = '{{ url('pmda/edit/' . $pmda->id . '/-iss-tab') }}';
                                };
                                toastr.success(data.message);
                                {{ Session::put('active-tab', '#-iss-tab') }}
                            },
                            error: function(data) {
                                var result = data.responseJSON.errors;
                                $.each(result, function(i) {
                                    toastr.error(this);
                                });
                            }
                        });
                    });

                    /* municipio */
                    $('#btnMunicipio').click(function(e) {
                        e.preventDefault();

                        var _token = $("input[name='_token']").val();
                        var nome_prefeito = $("#nome_prefeito").val();
                        var tel_prefeitura = $("#tel_prefeitura").val();
                        var fax_prefeitura = $("#fax_prefeitura").val();
                        var tel_prefeito = $("#tel_prefeito").val();
                        var cel_prefeito = $("#cel_prefeito").val();
                        var endereco = $("#endereco").val();
                        var bairro = $("#bairro").val();
                        var cep = $("#cep").val();
                        var email_prefeitura = $("#email_prefeitura").val();
                        var populacao = $("#populacao").val();
                        var pop_rural = $("#pop_rural").val();
                        var area = $("#area").val();
                        var id = {{ $municipio['id'] }};

                        $.ajax({
                            url: "{{ route('updateMunicipio') }}",
                            type: 'POST',
                            data: {
                                _token: _token,
                                nome_prefeito: nome_prefeito,
                                id: id,
                                tel_prefeitura: tel_prefeitura,
                                fax_prefeitura: fax_prefeitura,
                                tel_prefeito: tel_prefeito,
                                cel_prefeito: cel_prefeito,
                                endereco: endereco,
                                bairro: bairro,
                                cep: cep,
                                email_prefeitura: email_prefeitura,
                                populacao: populacao,
                                pop_rural: pop_rural,
                                area: area,
                                id: id,
                            },
                            success: function(data) {
                                toastr.options.onHidden = function() {
                                    window.location = '{{ url('pmda/edit/' . $pmda->id . '/-municipio-tab') }}';
                                };
                                toastr.success(data.message);
                                {{ Session::put('active-tab', '#-municipio-tab') }}

                            },
                            error: function(data) {
                                var result = data.responseJSON.errors;
                                $.each(result, function(i) {
                                    toastr.error(this);
                                });


                            }
                        });
                    });

                    /* Ponto de Captação */
                    $('#btnPonto').click(function(e) {
                        e.preventDefault();

                        var _token = $("input[name='_token']").val();
                        var nome = $("#nome").val();
                        var municipio_id = {{ $municipio['id'] }};
                        var tipo = $("#tipo").val();
                        var latitude = $("#latitude").val();
                        var longitude = $("#longitude").val();
                        var capacidade = $("#capacidade").val();
                        var pmda_id = {{ $pmda->id }}

                        $.ajax({
                            url: "{{ route('novoPonto') }}",
                            type: 'POST',
                            data: {
                                _token: _token,
                                nome: nome,
                                municipio_id: municipio_id,
                                tipo: tipo,
                                latitude: latitude,
                                longitude: longitude,
                                capacidade: capacidade,
                                pmda_id: pmda_id,
                            },
                            success: function(data) {
                                toastr.options.onHidden = function() {
                                    window.location = '{{ url('pmda.edit/{$pmda->id}/-ponto-tab') }}';
                                };
                                toastr.success(data.message);
                                {{ Session::put('active-tab', '#-ponto-tab') }}

                            },
                            error: function(data) {
                                var result = data.responseJSON.errors;
                                $.each(result, function(i) {
                                    toastr.error(this);
                                });


                            }
                        });
                    });

                    /* BUSCA Ponto de Captação */
                    $('#btnSearchPonto').click(function(e) {
                        e.preventDefault();

                        var _token = $("input[name='_token']").val();
                        var searchPonto = $("#searchPonto").val();

                        $.ajax({
                            url: "{{ route('searchPonto') }}",
                            type: 'POST',
                            data: {
                                _token: _token,
                                searchPonto: searchPonto,

                            },
                            success: function(data) {
                                console.log(data);
                                $('#tbl-lista-ponto > tbody').remove();
                                $('#tbl-lista-ponto').append(data);

                            },
                            error: function(data) {


                            }
                        });
                    });

                    /* adicionar ponto ao PMDA */
                    $("img[name=btnAddPonto]").click(function() {
                        alert();

                    });
                })
            </script>

        @endsection
