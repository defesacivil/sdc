@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('interdicao') }}">Interdição</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Registro</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">


        <div class="flex-row">
            <div class="text-center">
                <p class='text-center'><a class='btn btn-success btn-sm' href='{{ url('interdicao') }}'>Voltar</a></p>

                <legend>NOTIFICAÇÃO DE INTERDIÇÃO Nº <b><?= '1' ?>/<?= date('Y') ?></b></legend>

                {{ Form::open(['url' => '/estoque/fornecedor/store']) }}
                {{ Form::token() }}

            </div>
            <div class="col-md-12">

                <h5> Local da Notificação </h5>
                <div class="row border p-3">
                    <div class="col-md-6">
                        {{ Form::label('numero', 'Número da Notificação') }}:
                        {{ Form::text('numero', '', ['class' => 'form form-control', 'required maxlenght=110']) }}
                        {{ Form::hidden('municipio_id', '', ['class' => 'form form-control', 'id' => 'municipio_id', 'required maxlenght=110']) }}
                    </div>
                    <div class="col-md-12 p-3">
                        {{ Form::label('endereco', 'Endereço do Imóvel') }}:
                        {{ Form::text('endereco', '', ['class' => 'form form-control', 'id' => 'endereco', 'maxlength' => '110', 'placeholder' => 'Endereço do Imóvel']) }}

                    </div>
                </div>
                </p>
                </p>
                <h5> Identificação do Notificado</h5>
                <div class="row border p-3">
                    <div class="col-md-6 p-2">
                        {{ Form::label('notificado', 'Nome do Notificado') }}:
                        {{ Form::text('notificado', '', ['class' => 'form form-control', 'id' => 'notificado', 'required', 'maxlenght' => '70']) }}
                    </div>
                    <div class="col-md-6 p-2">
                        {{ Form::label('rg_notificado', 'RG do Notificado') }}:
                        {{ Form::text('rg_notificado', '', ['class' => 'form form-control', 'id' => 'rg_notificado', 'required', 'maxlength' => '50', 'placehold' => 'RG do Norificado']) }}
                    </div>

                    <div class="col-md-9">
                        {{ Form::label('endereco_not', 'Endereço do Notificado') }}:
                        {{ Form::text('endereco_not', '', ['class' => 'form form-control', 'id' => 'endereco_not', 'required', 'maxlength' => '110']) }}
                    </div>
                    <div class="col-md-3">
                        {{ Form::label('cel_not', 'Contato do Notificado') }}:
                        {{ Form::text('cel_not', '', ['class' => 'form form-control', 'id' => 'cel_not', 'required', 'maxlength' => '20' ]) }}
                    </div>
                </div>
                </p>
                <h5>Notificação</h5>
                <div class="row border p-3">
                    <div class="col-md-12 p-2" id="notificacao1">
                        {{ Form::label('obs', 'Texto Notificação') }}:
                        {{ Form::textarea('obs', '', ['class' => 'form form-control', 'id' => 'summernote']) }}
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop
</div>
@section('css')

@stop
@section('code')

    <link rel="stylesheet" href="{{asset('summernote/summernote-bs4.css')}}" />
    <script src="{{asset('summernote/summernote-bs4.js')}}"></script>

    <!-- For Bootstrap 3 -->
    <link rel="stylesheet" href="{{asset('summernote/summernote.css')}}" />
    <script src="{{asset('summernote/summernote.js')}}'"></script>

    <!-- Without any framework -->
    <link rel="stylesheet" href="{{asset('summernote/summernote-lite.css')}}" />
    <script src="{{asset('summernote/summernote-lite.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            const texto_notificacao = '<strong><h1 style="text-align:center">Motivo da Interdição</h1></strong> <br>\
                    <p style="text-align:justify;text-indent:3ch">Em decorrência das anomalias constatadas na edificação/solo pelo vistoriador de Proteção \
                    e Defesa Civil e relatadas no relatório de vistoria nº XXX/20XX, fica INTERDITADO o imóvel da Rua Av. As manifestações patológicas \
                    comprometem o desempenho da construção e colocam em risco à vida de seus moradores/usuários.</p> \
                    \
                    <p style="text-align:justify;text-indent:3ch">O notificado deve providenciar a remoção imediata de todos os moradores e seus usuários, devendo a edificação permanecer \
                        INTERDITADA até que as condições de segurança e habitabilidade sejam restabelecidas.</p> \
                        \
                    <p style="text-align:justify;text-indent:3ch">O vistoriador atesta que a presente interdição obedece criteriosamente aos princípios da Lei Federal Nº 12.608, de 10 de \
                        abril de 2012, que aduz no Art.2º a seguinte redação:</p> \
                        \
                    <p style="text-align:justify;text-indent:3ch">Art. 2º É dever da União, dos Estados, do Distrito Federal e dos Municípios adotar as medidas necessárias à redução dos \
                        riscos de desastre.</p> \
                        \
                    <p style="text-align:justify;text-indent:3ch">2o A incerteza quanto ao risco de desastre não constituirá óbice para a adoção das medidas preventivas e mitigadoras da \
                        situação de risco.</p>\
                        \
                    <p style="text-align:justify;text-indent:3ch">O artigo 8º da Lei Federal nº 12.608/2012, atribui aos municípios a competência na redução de desastres e apoio às comunidades \
                        locais,</p> \
                        \
                    <p style="text-align:justify;text-indent:3ch">Art. 8o Compete aos Municípios:</p> \
                    <p style="text-align:justify;text-indent:3ch">I - executar a PNPDEC em âmbito local;</p>\
                    <p style="text-align:justify;text-indent:3ch">II - coordenar as ações do SINPDEC no âmbito local, em articulação com a União e os Estados;</p>\
                    <p style="text-align:justify;text-indent:3ch">III - incorporar as ações de proteção e defesa civil no planejamento municipal;</p>\
                    <p style="text-align:justify;text-indent:3ch">IV - identificar e mapear as áreas de risco de desastres;</p>\
                    <p style="text-align:justify;text-indent:3ch">V - promover a fiscalização das áreas de risco de desastre e vedar novas ocupações nessas áreas;</p>\
                    <p style="text-align:justify;text-indent:3ch">VI - declarar situação de emergência e estado de calamidade pública;</p>\
                    <p style="text-align:justify;text-indent:3ch">VII - vistoriar edificações e áreas de risco e promover, quando for o caso, a intervenção preventiva e a evacuação da população das áreas de alto risco ou das edificações vulneráveis; \
                    <p style="text-align:justify;text-indent:3ch">VIII - organizar e administrar abrigos provisórios para assistência à população em situação de desastre, em condições adequadas de higiene e segurança;</p>\
                    <p style="text-align:justify;text-indent:3ch">IX - manter a população informada sobre áreas de risco e ocorrência de eventos extremos,</p>\
                    <p style="text-align:justify;text-indent:3ch">bem como sobre protocolos de prevenção e alerta e sobre as ações emergenciais em circunstâncias de desastres;</p>\
                    <p style="text-align:justify;text-indent:3ch">X - mobilizar e capacitar os radioamadores para atuação na ocorrência de desastre;</p>\
                    <p style="text-align:justify;text-indent:3ch">XI - realizar regularmente exercícios simulados, conforme Plano de Contingência de Proteção e Defesa Civil;</p>\
                    <p style="text-align:justify;text-indent:3ch">XII - promover a coleta, a distribuição e o controle de suprimentos em situações de desastre;</p>\
                    <p style="text-align:justify;text-indent:3ch">XIII - proceder à avaliação de danos e prejuízos das áreas atingidas por desastres;</p>\
                    <p style="text-align:justify;text-indent:3ch">XIV - manter a União e o Estado informados sobre a ocorrência de desastres e as atividades de proteção civil no Município;</p>\
                    <p style="text-align:justify;text-indent:3ch">XV - estimular a participação de entidades privadas, associações de voluntários, clubes de serviços, organizações não governamentais e associações de classe e comunitárias nas ações do SINPDEC e</p>\
                    <p style="text-align:justify;text-indent:3ch">promover o treinamento de associações de voluntários para atuação conjunta com as comunidades apoiadas; e</p>\
                    <p style="text-align:justify;text-indent:3ch">XVI - prover solução de moradia temporária às famílias atingidas por desastres.</p>';

            $('#summernote').summernote('code', texto_notificacao);

            $("#cel_not").inputmask('(99) 9999[9]-9999');


        })
    </script>
@endsection
