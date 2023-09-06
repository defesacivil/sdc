@extends('layouts.pagina_master')

{{-- header --}}
@section('header')


    @php
        $tab = isset($active_tab) ? $active_tab : 'dados_pedidos-tab';
    @endphp

    {{-- {{ Session::get('active-tab') }} --}}
    <!-- ATIVAR TAB APOS RELOAD -->
    @if (Session::has('active_tab'))
        @php
            $tab = Session::get('active_tab');
        @endphp
    @else
        @php
            $tab = '#-dados_pedidos-tab';
        @endphp
    @endif


    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/busca') }}">Pesquisa Pedido Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edição Pedido Ajuda Humanitária</li>
        </ol>
    </nav>

    <?php
    /* backend
        pmda
            lista para analise - editar /validar comunidade / visualizar
            busca - editar /validar comunidade / visualizar
        conformidade


        frontend
        novo pmda
        index processos  - editar / visualizar / mensagem / enviar
        */
    ?>
@endsection

@section('content')

    <div class="container">
        <div class="row flex-fill">

            {{-- <div class="col-md-3">
            <ul id="treeDemo" class="ztree"></ul>
        </div> --}}
            <div class="col-md-12">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('mah/busca') }}>Voltar</a></p>


                @can('mah', $pedido->municipio_id)
                    <legend>Edição Pedido Ajuda Humanitária - <i>({{ $pedido->municipio->nome }})</i></legend>
                    <p>Nº : {{ $pedido->numero }}-{{ substr($pedido->data_entrada_sistema, 0, 4) }}</p>
                    <p>Data Geração :<b> {{ \Carbon\Carbon::parse($pedido->data_entrada_sistema)->format('d/m/Y H:i:s') }}</b></p>

                    <ul class="nav nav-pills nav-fill" id="tab-mah" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" href="#dados_pedidos-tab" id="-dados_pedidos-tab" data-toggle="tab"
                                role="tab">Dados Pedido</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#material_pedido-tab" id="-material_pedido-tab" data-toggle="tab"
                                role="tab">Materiais do Pedido</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#documentos-tab" id="-documentos-tab" data-toggle="tab"
                                role="tab">Documentos/Arquivos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#despachos_analise-tab" id="-despachos_analise-tab" data-toggle="tab"
                                role="tab">Despachos/Analises</a>
                        </li>
                    </ul>
                    <br>

                    <div class="tab-content" id="nav-tabContent">
                        {{-- Dados do pedido --}}
                        <div class="tab-pane fade show active" id="dados_pedidos-tab" role="tabpanel"
                            aria-labelledby="dados_pedidos-tab">
                            {{ Form::open(['url' => 'mah/update/{id_pedido}']) }}
                            {{ Form::token() }}
                            {{ Form::hidden('numero', $pedido->numero . '-' . substr($pedido->data_entrada_sistema, 0, 4), ['class' => 'form form-control', 'readonly' => 'readonly']) }}
                            {{ Form::hidden('data_entrada_sistema', $pedido->data_entrada_sistema, ['class' => 'form form-control', 'readonly' => 'readonly', 'maxlength' => '6']) }}

                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2">
                                        <legend class="w-auto">Dados Município</legend>
                                        <div class="col p-3">
                                            {{ Form::label('municipio_id', 'Município') }} :
                                            {{ Form::text('nome_municicpio', $pedido->municipio->nome . ' - ' . $pedido->municipio_id, ['class' => 'form form-control', 'maxlength' => '110', 'readonly' => 'readonly']) }}
                                            {{ Form::hidden('municipio_id', $pedido->municipio_id, ['maxlength' => '11', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('regiao_id', 'Região') }} :
                                            {{ Form::text('nome_regiao', $pedido->mesoregiao->nome . ' - ' . $pedido->regiao_id, ['class' => 'form form-control']) }}
                                            {{ Form::hidden('regiao_id', $pedido->regiao_id, ['class' => 'form form-control']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('nome_prefeito', 'Nome do Prefeito') }} :
                                            {{ Form::text('nome_prefeito', $pedido->nome_prefeito, ['class' => 'form form-control']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('email_prefeito', 'Email do Prefeito') }} :
                                            {{ Form::text('email_prefeito', $pedido->email_prefeito, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '50']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('tel_prefeito', 'Telefone do Prefeito') }} :
                                            {{ Form::text('tel_prefeito', $pedido->tel_prefeito, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('cel_prefeito', 'Celular do Prefeito') }} :
                                            {{ Form::text('cel_prefeito', $pedido->cel_prefeito, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <br><br>

                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2">
                                        <legend class="w-auto">Dados Coordenador de Proteção e Defesa Civil</legend>

                                        <div class="col p-3">
                                            {{ Form::label('nome_coordenador', 'Nome do Coordenador') }} :
                                            {{ Form::text('nome_coordenador', $pedido->nome_coordenador, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '110']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('email_coordenador', 'Email do Coordenador') }} :
                                            {{ Form::text('email_coordenador', $pedido->email_coordenador, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '50']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('tel_coordenador', 'Telefone do Coordenador') }} :
                                            {{ Form::text('tel_coordenador', $pedido->tel_coordenador, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('cel_coordenador', 'Celular do Coordenador') }} :
                                            {{ Form::text('cel_coordenador', $pedido->cel_coordenador, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2">
                                        <legend class="w-auto">Dados Sobre o Desastre</legend>

                                        <div class="col p-3">
                                            {{ Form::label('id_cobrade', 'Nome do Desastre do Cobrade') }} :
                                            {{ Form::text('nome_cobrade', $pedido->cobrade->descricao . ' - ' . $pedido->cobrade->codigo, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '11']) }}
                                            {{ Form::hidden('id_cobrade', $pedido->cobrade_id, ['required' => 'required', 'maxlength' => '11']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('pop_atendida', 'População Atendida') }} :
                                            {{ Form::text('pop_atendida', $pedido->pop_atendida, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>

                                        <div class="col p-3">
                                            {{ Form::label('decreto_se_ecp_vig', 'Existe decreto vigente ?') }} :
                                            {{ Form::select('decreto_se_ecp_vig', ['0' => 'Não', '1' => 'Sim'], $pedido->decreto_se_ecp_vig, [
                                                'class' => 'form form-control',
                                                'required' => 'required',
                                                'maxlength' => '16',
                                            ]) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('numero_decreto', 'Número do Decreto') }} :
                                            {{ Form::text('numero_decreto', $pedido->numero_decreto, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>

                                        <div class="col p-3">
                                            {{ Form::label('tipo_decreto', 'Tipo do Decreto ?') }} :
                                            {{ Form::select('tipo_decreto', ['SE' => 'SE - Situação de Emergência', 'ECP' => 'ECP - Estado de Calamidade Pública'], $pedido->tipo_decreto, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('data_vigencia', 'Data de Vigência do Decreto') }} :
                                            {{ Form::text('data_vigencia', $pedido->data_vigencia, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>

                                        <div class="col p-3">
                                            {{ Form::label('esforcos_realizados', 'Esforços Realizados') }} : (Caracteres restantes : <span
                                                id='carac_restante_esforcos'>0</span>)
                                            {{ Form::textarea('esforcos_realizados', $pedido->esforcos_realizados, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '1000', 'rows' => 10, 'id' => 'esforcos_realizados']) }}
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <br>
                            {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}

                            {{ Form::close() }}


                        </div>

                        {{-- MATERIAL DO PEDIDO --}}
                        <div class="tab-pane fade" id="material_pedido-tab" role="tabpanel" aria-labelledby="material_pedido-tab">

                            <p><button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#material-pedido-modal" value="Envio Documentos Anexo">Materiais do Pedido
                                </button>
                            </p>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col">

                                    <table class="table table-sm table-bordered" id="tbl_material">
                                        <tr>
                                            <td width="10%">#</td>
                                            {{-- <td width="20%">Código</td> --}}
                                            <td width="20%">Material</td>
                                            <td width="20%">Quantidade</td>
                                            <td width="20%">Qtd Famílias Atendidas</td>
                                            <td width="20%">Opções</td>

                                        </tr>

                                        @foreach ($materiais as $key=>$material)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                {{-- <td>{{ $material->codigo }}</td> --}}
                                                <td>{{ $material->descricao_item }}</td>
                                                <td>{{ $material->qtd }}</td>
                                                <td>{{ $material->familia_at }}</td>
                                                <td><img onclick="return confirm('Deseja Apagar o Registro !')" name='deletarMaterial' src={{ asset('imagem/icon/delete.png') }}></td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-md-3"></div>
                            </div>


                            {{-- MODAL ADD MATERIAIS --}}

                            <div class="modal fade" id="material-pedido-modal" aria-modal="true" role="dialog" data-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Adicione Materiais no Pedido de Ajuda Humanitária</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 back">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Nome Material</label>
                                                        <select class="js-example-basic-single form form-control form-control-sm" style="width: 100%" id="material" name="material">
                                                            <option></option>
                                                            @foreach ($materiais_list as $material)
                                                                <option value={{ $material['id'] }}>{{ $material['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <label>Quantidade</label>
                                                    <input type="number" class="form form-control form-control-sm" id="qtd" name="qtd">
                                                    <input type="hidden" id="tp_item" name="tp_item" value="P">
                                                </div>

                                                <div class="row">
                                                    <label>Qtd de Famílias Atendidas</label>
                                                    <input type="number" class="form form-control form-control-sm" id="familia_at" name="familia_at">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="add_material">Adicionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Final Modal Add Materiais --}}

                        </div>

                        <!-- DOCUMENTOS ANEXOS -->
                        <div class="tab-pane fade" id="documentos-tab" role="tabpanel" aria-labelledby="documentos-tab">

                            <p>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#upload_doc">
                                    Envio Documentos Anexo
                                </button>
                            </p>
                            <div class="col-12 back">

                                <table class="table table-sm">
                                    <tr>
                                        <th class="bg-second">#</th>
                                        <th>Data Upload</th>
                                        <th>Nome Arquivo</th>
                                        <th>Opções</th>
                                    </tr>

                                    @foreach ($documentos as $key => $documento)
                                        <tr>
                                            @php
                                                $nome = substr(basename($documento), 7 + strlen($pedido->id));
                                                $pos = strpos($nome, '_');
                                                $nome1 = \Carbon\Carbon::createFromTimestamp(substr($nome, 0, $pos))->format('d/m/Y H:i:s');
                                                
                                            @endphp
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $nome1 }}</td>
                                            <td>{{ basename($documento) }}</td>
                                            <td><a name='removeDocPedido'><img src={{ asset('imagem/icon/delete.png') }} data-file='{{ basename($documento) }}'></a></td>
                                        </tr>
                                        {{-- <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $documento->data_envio }}</td>
                                            <td>{{ $documento->nome_arquivo }}</td>
                                            <td>{{ $documento->descricao }}</td>
                                            <td><img src={{ asset('imagem/icon/delete.png') }}></td>
                                        </tr> --}}
                                    @endforeach

                                </table>

                            </div>

                        </div>

                        {{-- DESPACHOS DO PEDIDO --}}
                        <div class="tab-pane fade" id="despachos_analise-tab" role="tabpanel" aria-labelledby="despachos_analise-tab">

                            <p>
                                <button class="btn btn-success btn-sm" value="Envio Documentos Anexo" data-toggle="modal" data-target="#parecer_tec">
                                    Análise /Despacho
                                </button>
                            </p>

                            <div class="col-12 back">
                                <table class="table table-sm">
                                    <tr>
                                        <th class="">#</th>
                                        <th>Data</th>
                                        <th>Descrição/Parecer</th>
                                        <th>Situação</th>
                                        <th>Opções</th>
                                    </tr>
                                    @foreach ($despachos as $key => $despacho)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $despacho->data_parecer }}</td>
                                            <td>{{ $despacho->parecer }}</td>
                                            <td>{{ $despacho->tramit_parecer }}</td>
                                            <td>
                                                <button type='button' name='editarDespacho'><img src={{ asset('imagem/icon/editar.png') }}></button>
                                                <a href='{{ route('parecer.deletar', $despacho->id) }}' onclick="return confirm('Deseja Apagar o Registro !')" name='deletarDespacho'><img src={{ asset('imagem/icon/delete.png') }}></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        {{-- MODAL DESPACHOS PARECER --}}
                        <div class="modal fade" id="parecer_tec" tabindex="-1" role="dialog" aria-labelledby="parecer_tecTitle" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Lançamento Despacho / Parecer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class='col'>
                                            {{ Form::open(['url' => 'mah/analise/store', 'id' => 'form_parecer']) }}
                                            {{ Form::token() }}
                                            {{ Form::hidden('data_parecer', Carbon\Carbon::now(), ['id' => 'data_parecer', 'required']) }}
                                            {{ Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id', 'required']) }}
                                            {{ Form::hidden('pedido_id', $pedido->id, ['id' => 'pedido_id', 'required']) }}

                                            {{ Form::label('Descrição Despacho / Parecer') }} <span> ( Caracteres restantes &nbsp;<i id='carac_rest'> 255 </i>&nbsp;)</span>
                                            {{ Form::textarea('parecer', '', ['class' => 'form form-control', 'id' => 'parecer', 'required']) }}

                                            {{ Form::label('Descrição Despacho / Parecer') }}
                                            {{ Form::select('tramit_parecer', $secao_tramitar, '', ['class' => 'form form-control', 'id' => 'parecer', 'required']) }}


                                            {{ Form::submit('Gravar', ['class' => 'btn btn-primary', 'id' => 'btnSalvarParecer']) }}

                                            {{ Form::close() }}

                                            <br><br>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>



    {{-- UPLOAD ANEXOS PEDIDO --}}
    <div class="modal fade" id="upload_doc" tabindex="-1" role="dialog" aria-labelledby="upload_docTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Anexar Documentos no Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='col-md-6' id='form_anexo_doc'>
                        {{ Form::file('anexoDoc', ['accept' => '.pdf', 'required', 'id' => 'anexoDoc', 'required']) }}
                        <br><br>
                        {{ Form::submit('Upload Doc', ['class' => 'btn btn-primary btn-sm', 'id' => 'btnUpAnexo', 'data-dismiss' => 'modal']) }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('code')

    <script src="{{ asset('vendor/select2/js/select2.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#parecer').keydown(function(event) {
                var carac_rest = 255 - $(this).val().length;
                $("#carac_rest").text(carac_rest);
            });

            // SALVAR O PARECER TÉCNICO
            $("#btnSalvarParecer").click(function(e) {

                var formdata = new FormData(this);

                formdata.append('pedido_id', {{ $pedido->id }});
                formdata.append('_token', "{{ csrf_token() }}");
                formdata.append('data_parecer', $("#data_parecer").val());
                formdata.append('parecer', $("#parecer").val());
                formdata.append('tramit_parecer', $("#tramit_parecer").val());

                e.preventDefault();

                $.ajax({
                    url: '{{ route('analise.store') }}',
                    type: 'POST',
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    success: function(response) {},
                    error: function(response) {}
                });



            });

            // ADICIONAR MATERIAIS NO PEDIDO
            $('.js-example-basic-single').select2();
            $("#add_material").click(function(e) {

                var formData = new FormData();

                var descricao_item  = $('#material').select2('data')[0]['text']; 
                var codigo          = $('#material').val();
                var qtd             = $('#qtd').val();
                var familia_at      = $('#familia_at').val();
                var tp_item         = $('#tp_item').val();

                formData.append('_token',         "{{ csrf_token() }}");
                formData.append('descricao_item', descricao_item);
                formData.append('pedido_id',      '{{ $pedido->id }}');
                formData.append('codigo',         codigo);
                formData.append('qtd',            qtd);
                formData.append('familia_at',     familia_at);
                formData.append('tp_item',        tp_item);


                $.ajax({
                    url: '{{ route('mah.item.store') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(e) {
                        window.location.href = '{{ url('mah/pedido/edit/' . $pedido->id) }}';
                    },
                    error: function(e) {
                        
                    }
                });
                e.preventDefault();


                // key++;

                // materiais.push([material, qtd, familia]);

                // var tr = "<tr><td>" + key + "</td><td>" + cod + "</td><td>" + material + "</td><td>" + qtd + "</td><td>" + familia + "</td><td><img src='{{ asset('imagem/icon/delete.png') }}' onclick='removerMaterial()'></td></tr>";

                // $("#tbl_material").append(tr);

            });

            /* REMOVER DOCUMENTO PEDIDO */
            $("a[name='removeDocPedido']").click(function(e) {

                var formdata = new FormData();

                formdata.append('id', '{{ $pedido->id }}');
                formdata.append('file', $(this).children().data('file'));
                formdata.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: '{{ route('mah/deletedoc') }}',
                    type: 'POST',
                    data: formdata,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        window.location.href = '{{ url('mah/pedido/edit/' . $pedido->id) }}';
                    },
                    error: function(data) {
                        console.log(data + "erro");
                    }
                });
                e.preventDefault();

            });

            
            /* UPLOAD DOCUMENTO PEDIDO */
            $("#btnUpAnexo").click(function(e) {

                var formdata = new FormData();

                var file = $('#anexoDoc')[0].files[0];

                formdata.append('anexoDoc', file);
                formdata.append('_token', '{{ csrf_token() }}');
                formdata.append('id', {{ $pedido->id }});

                $.ajax({
                    url: '{{ url('mah/pedido/upload') }}',
                    type: "POST",
                    data: formdata,
                    dataType: "json",
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    success: function(data) {
                        window.location.href = '{{ url('mah/pedido/edit/' . $pedido->id) }}';

                    },
                    error: function(e1) {

                    }
                });

                e.preventDefault();

            });

            var zTreeObj;
            // zTree configuration information, refer to API documentation (setting details)
            var setting = {};
            // zTree data attributes, refer to the API documentation (treeNode data details)
            var zNodes = [{
                    name: "Dados do Pedido - Nº 022023 - 02/02/2023",
                    open: true,
                    children: [{
                        name: "test1_1"
                    }, {
                        name: "test1_2"
                    }]
                },
                {
                    name: "Materiais do Pedido",
                    open: true,
                    children: [{
                        name: "test2_1"
                    }, {
                        name: "test2_2"
                    }]
                },
                {
                    name: "Arquivos e Documentos",
                    open: true,
                    children: [{
                        name: "test2_1"
                    }, {
                        name: "test2_2"
                    }]
                },
                {
                    name: "Despachos",
                    open: true,
                    children: [{
                        name: "test2_1"
                    }, {
                        name: "test2_2"
                    }]
                }
            ];

            zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);


            /* ativar tab */
            $("{{ $tab }}").trigger("click");


            $("#carac_restante_esforcos").text($("#esforcos_realizados").val().length);
            $("#esforcos_realizados").keyup(function() {
                var caracteres = $("#esforcos_realizados").val().length;
                //alert(caracteres);
                $("#carac_restante_esforcos").text(caracteres + 1);
            });

            if ($('#decreto_se_ecp_vig').val() == 0) {
                $('#numero_decreto').attr('disabled', true);
                $('#tipo_decreto').attr('disabled', true);
                $('#data_vigencia').attr('disabled', true);
            } else {
                $('#numero_decreto').attr('disabled', false);
                $('#tipo_decreto').attr('disabled', false);
                $('#data_vigencia').attr('disabled', false);
            }
            //console.log(decreto_vigente);
            $('#decreto_se_ecp_vig').change("change", function() {
                console.log($(this).val());
                if ($(this).val() == 0) {
                    $('#numero_decreto').attr('disabled', true);
                    $('#tipo_decreto').attr('disabled', true);
                    $('#data_vigencia').attr('disabled', true);
                } else {
                    $('#numero_decreto').attr('disabled', false);
                    $('#tipo_decreto').attr('disabled', false);
                    $('#data_vigencia').attr('disabled', false);
                }
            });
        })

    </script>

@endsection
