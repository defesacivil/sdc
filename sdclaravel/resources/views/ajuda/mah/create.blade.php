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


                @can('mah', $municipio->id)
                    <legend>Pedido Ajuda Humanitária - <i>Novo Registro</i></legend>
                    
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
                        
                       
                    </ul>
                    <br>

                    <div class="tab-content" id="nav-tabContent">
                        {{-- Dados do pedido --}}
                        <div class="tab-pane fade show active" id="dados_pedidos-tab" role="tabpanel"
                            aria-labelledby="dados_pedidos-tab">
                            {{ Form::open(['url' => 'mah/store']) }}
                            {{ Form::token() }}
                            {{ Form::input('dateTime-local', 'data_entrada_sistema', '', ['class' => 'form form-control', 'value' => old('data_entrada_sistema'), 'id' => 'data_entrada_sistema']) }}

                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2">
                                        <legend class="w-auto">Dados Município</legend>
                                        <div class="col p-3">
                                            {{ Form::label('municipio_id', 'Município') }} :
                                            {{ Form::text('nome_municicpio', $municipio->nome . ' - ' . $municipio->id, ['class' => 'form form-control', 'maxlength' => '110', 'readonly' => 'readonly']) }}
                                            {{ Form::hidden('municipio_id', $municipio->id, ['maxlength' => '11', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('regiao_id', 'Região') }} :
                                            {{ Form::select('regiao_id', $regiaos, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'regiao_id', 'placeholder' => 'Regiao de Desenvolvimento', 'data-regiao_id' => '']) }}
                                        
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('nome_prefeito', 'Nome do Prefeito') }} :
                                            {{ Form::text('nome_prefeito', $municipio->nome_prefeito, ['class' => 'form form-control', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('email_prefeito', 'Email do Prefeito') }} :
                                            {{ Form::text('email_prefeito', $municipio->email_prefeito, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '50', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('tel_prefeito', 'Telefone do Prefeito') }} :
                                            {{ Form::text('tel_prefeito', $municipio->tel_prefeito, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('cel_prefeito', 'Celular do Prefeito') }} :
                                            {{ Form::text('cel_prefeito', $municipio->cel_prefeito, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16', 'readonly' => 'readonly']) }}
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <br><br>

                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2">
                                        <legend class="w-auto">Dados Coordenador de Proteção e Defesa Civil</legend>
                                        <p class="alert alert-danger">
                                                A alteração dos dados do Coordenador deve ser feito no Cadastro do Compdec, <a href='{{url('compdec/edit/'.$compdec_id)}}' onclick="return confirm('Os dados serão perdidos ! deseja sair desta página ?')"> Clique aqui para acessar o Cadastro de Compdec</a>

                                        <div class="col p-3">
                                            {{ Form::label('nome_coordenador', 'Nome do Coordenador') }} :
                                            {{ Form::text('nome_coordenador', $coordenador->nome, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '110', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('email_coordenador', 'Email do Coordenador') }} :
                                            {{ Form::text('email_coordenador', $coordenador->email, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '50', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('tel_coordenador', 'Telefone do Coordenador') }} :
                                            {{ Form::text('tel_coordenador', $coordenador->tel, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16', 'readonly' => 'readonly']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('cel_coordenador', 'Celular do Coordenador') }} :
                                            {{ Form::text('cel_coordenador', $coordenador->cel, ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16', 'readonly' => 'readonly']) }}
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
                                            {{ Form::select('id_cobrade', $cobrades, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'id_cobrade', 'placeholder' => 'Código Cobrade', 'data-id_cobrade' => '']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('pop_atendida', 'População Atendida') }} :
                                            {{ Form::number('pop_atendida', '', ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>

                                        <div class="col p-3">
                                            {{ Form::label('decreto_se_ecp_vig', 'Existe decreto vigente ?') }} :
                                            {{ Form::select('decreto_se_ecp_vig', ['0' => 'Não', '1' => 'Sim'], '', [
                                                'class' => 'form form-control',
                                                'required' => 'required',
                                                'maxlength' => '16',
                                            ]) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('numero_decreto', 'Número do Decreto') }} :
                                            {{ Form::text('numero_decreto', '', ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>

                                        <div class="col p-3">
                                            {{ Form::label('tipo_decreto', 'Tipo do Decreto ?') }} :
                                            {{ Form::select('tipo_decreto', ['SE' => 'SE - Situação de Emergência', 'ECP' => 'ECP - Estado de Calamidade Pública'], '', ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>
                                        <div class="col p-3">
                                            {{ Form::label('data_vigencia', 'Data de Vigência do Decreto') }} :
                                            {{ Form::text('data_vigencia', '', ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '16']) }}
                                        </div>

                                        <div class="col p-3">
                                            {{ Form::label('esforcos_realizados', 'Esforços Realizados') }} : (Caracteres restantes : <span
                                                id='carac_restante_esforcos'>0</span>)
                                            {{ Form::textarea('esforcos_realizados', '', ['class' => 'form form-control', 'required' => 'required', 'maxlength' => '1000', 'rows' => 10, 'id' => 'esforcos_realizados']) }}
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

                                    </table>
                                </div>
                                <div class="col-md-3"></div>
                            </div>


                            {{-- MODAL ADD MATERIAIS --}}

                            <div class="modal fade" id="material-pedido-modal" aria-modal="true" role="dialog" data-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        
                                        {{ Form::open(['url' => 'mah/pedidoitem/store']) }}
                                        {{ Form::token() }}


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
                                            {{ Form::submit('Adicionar', ['class' => 'btn btn-primary',  'id'=>'add_material']) }}
                                        </div>

                                        {{ Form::close() }}
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

                                    {{-- @foreach ($documentos as $key => $documento)
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
                                        </tr>
                                    -endforeach --}}

                                </table>

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

                formdata.append('pedido_id', '');
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
