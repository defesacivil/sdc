@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Projeto Cisterna</li>
        </ol>
    </nav>

@endsection


@section('content')
    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">
            <div class="col-md-12">
                <p class="p-4 input type='text'-center"><a class='btn btn-success btn-sm' href={{ url('ajuda') }}>Voltar</a>&nbsp;
                <div class="row">
                    <div class="table-responsive">
                        <p class="text-center">
                            <legend>Formulário de pesquisa Caracterização Técnica</legend>

                            <legend>Localização da imóvel</legend>
                        </p>

                        <form action="{{ url('cisterna/store') }}" method="POST" name="frm" id="frm" enctype="multipart/form-data">
                            @csrf


                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label>Município :</label>
                                    <select class="form form-control" name="sel_municipio" id="sel_municipio" required>
                                        <option>Selecione o Municipio</option>
                                        @foreach ($municipios as $municipio)
                                            <option value='{{ $municipio->id }}'>{{ $municipio->nome }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Comunidade : </label>
                                    <select class="form form-control" name="sel_comunidade" id="sel_comunidade" required>
                                        <option>Selecione a Comunidade</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Endereço Completo :</label>
                                    <input type='text' class="form form-control" name="endereco" id="endereco" maxlength="130" placeholder="Endereço" />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label>Latitude :</label>
                                    <input type='text' name="lat" id="lat" maxlength="30" class="form form-control latlong" required />
                                </div>
                                <div class="col-md-6">
                                    <label>Longitude :</label>
                                    <input type='text' name="long" id="long" maxlength="30" class="form form-control latlong" required />
                                </div>
                            </div>

                            <legend>Dados Pessoais</legend>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Nome Morador :</label>
                                    <input type='text' name="nome" id="nome" class="form form-control" maxlength="100" required />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>CPF - do Morador : </label>
                                    <input type='text' name="cpf" id="cpf" class="form form-control" maxlength="30" required>
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label>Data Nascimento :</label>
                                    <input type='date' name="dtNasc" id="dtNasc" class="form form-control" maxlength="11" required>
                                </div>

                                <div class="col-md-6">
                                    <label>Telefone :</label>
                                    <input type='text' name="tel" id="tel" max="15" class="form form-control" maxlength="15" required />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>N Cad Único:</label>
                                    <input type='text' name="cadUnico" id="cadUnico" class="form form-control" maxlength="10" />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Quantidade de pessoas na Residência:</label>
                                    <input type='text' name="qtdPessoa" id="qtdPessoa" class="form form-control" maxLength="4" required />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label for="">Renda Familiar</label>
                                    <input type='text' name="renda" id="renda" class="form form-control" required />
                                </div>
                            </div>


                            <div class="row p-3">
                                <div class="col">
                                    <label>Tipo de Moradia : </label>
                                    <select class="form form-control" name="moradia" id="moradia" required>
                                        <option>Selecione o Tipo da Moradia</option>
                                        <option value="propria">Própria</option>
                                        <option value="alugada">Alugada</option>
                                        <option value="cedida">Cedida</option>
                                        <option value="outros">Outros</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row p-3" id="div_moradia">
                                <div class="col">
                                    <label>Outros Descrever</label>
                                    <input type='text' name="outroMoradia" id="outroMoradia" class="form form-control" maxlength="100" />
                                </div>
                            </div>


                            <legend>Caracterização do imóvel</legend>


                            <div class="row p-3">
                                <div class="col-md-4">
                                    <label>Comprimento Total do Telhado (m) : </label>
                                    <input type='text' name="compTelhado" id="compTelhado" class="form form-control" maxlength="5" required />
                                </div>

                                <div class="col-md-4">
                                    <label>Largura do Telhado (m) : </label>
                                    <input type='text' name="larguracompTelhado" id="larguracompTelhado" class="form form-control" maxlength="5" required />
                                </div>

                                <div class="col-md-4">
                                    <label>Área total do telhado (m2) : </label>
                                    <input type='text' name="areaTotalTelhado" id="areaTotalTelhado" class="form form-control" maxlength="5" required readonly />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Comprimeto da testada (m) : </label>
                                    <input type='text' name="compTestada" id="compTestada" class="form form-control" maxlength="5" required />
                                </div>

                                <div class="col">
                                    <label>Número de caídas do telhado : </label>
                                    <input type='text' name="numCaidaTelhado" id="numCaidaTelhado" class="form form-control" maxlength="3" required />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Tipo de cobertura do imóvel:</label>
                                    <select class="form form-control" name="coberturaTelhado" id="coberturaTelhado" required>
                                        <option>Selecione a Cobertura</option>
                                        <option value="pvc">PVC</option>
                                        <option value="amianto">Amianto</option>
                                        <option value="concreto">Concreto</option>
                                        <option value="outros">Outros</option>
                                        <option value="ceramica">Cerâmica</option>
                                        <option value="fibrocimento">Fibrocimento</option>
                                        <option value="zinco">Zinco</option>
                                        <option value="metalica">Metálica</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row p-3" id="div_coberturaOutros">
                                <div class="col">
                                    <label>Outros Descrever:</label>
                                    <input type='text' name="coberturaOutros" id="coberturaOutros" class="form form-control" maxlength="100" />
                                </div>
                            </div>


                            <legend>Dados Complementares</legend>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Existe fogão a lenha? :</label><br>
                                    Sim : <input type='radio' name="rb_fogao" id="rb_fogao_sim" value="sim" /><br>
                                    Não :<input type='radio' name="rb_fogao" id="rb_fogao_nao" value="nao" checked />
                                </div>
                            </div>

                            <div class="row p-3" id="div_medidaTelhadoFogao">
                                <div class="col">
                                    <label>Medida do telhado desconsiderando a área do fogão à lenha(m2): </label>
                                    <input type='text' name="medidaTelhadoAreaFogao" id="medidaTelhadoAreaFogao" class="form form-control" maxlength="5" />
                                </div>

                                <div class="col" id="testadaDispFogao">
                                    <label>Testada disponível, desconsiderando a parte do fogão à lenha(m) : </label>
                                    <input type='text' name="testadaDispParteFogao" id="testadaDispParteFogao" class="form form-control" maxlength="5" />
                                </div>
                            </div>


                            <div class="row p-3">
                                <div class="col">
                                    <label>Atendimento por caminhão Pipa ?: </label><br>
                                    Sim <input type='radio' name="rb_atend" id="rb_atend_sim" value="sim" /><br>
                                    Não <input type='radio' name="rb_atend" id="rb_atend_nao" value="nao" checked />
                                </div>
                            </div>

                            <div class="row p-3" id="div_orgao_resp">
                                <div class="col">
                                    <label>Órgão responsável pelo atendimento com caminhão Pipa : *</label><br><br>

                                    <input type="checkbox" name="ck_atend_def" id="setRespAtDefesaCivil" />
                                    Defesa Civil<br><br>

                                    <input type="checkbox" name="ck_atend_exercito" id="setRespAtExercito" />
                                    Exército<br><br>

                                    <input type="checkbox" name="ck_atend_partic" id="setRespAtParticular" />
                                    Particular<br><br>

                                    <input type="checkbox" name="ck_atend_prefeitura" id="setRespAtPrefeitura" />
                                    Prefeitura<br><br>

                                    <input type="checkbox" name="ck_atend_outros" id="setRespAtOutros" />
                                    Outros
                                </div>
                            </div>


                            <div class="row p-3" id="div_outro_atend">
                                <div class="col">
                                    <label>Outros Descrever:</label>
                                    <input type='text' name="outroAtendPipa" id="outroAtendPipa" class="form form-control" maxlength="100" />
                                </div>
                            </div>

                            <legend>Identificação dos Agentes :</legend>

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label>Nome do Agente : </label>
                                    <input type='text' name="nomeAgente" id="nomeAgente" class="form form-control" maxlength="70" required />
                                </div>

                                <div class="col-md-6">
                                    <label>CPF do Agente : </label>
                                    <input type='text' name="cpfAgente" id="cpfAgente" maxlength="15" class="form form-control" maxlength="15" required />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col-md-6">
                                    <label>Nome do Engenheiro responsável :</label>
                                    <input type='text' name="nomeEng" id="nomeEng" maxlength="70" class="form form-control" maxlength="100" required />
                                </div>

                                <div class="col-md-6">
                                    <label>Crea do Engenheiro responsável :</label>
                                    <input type='text' name="creaEng" id="creaEng" maxlength="70" class="form form-control" maxlength="20" required />
                                </div>
                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <label>Observações :</label>
                                    <input type='text' name="outrObs" id="outrObs" maxlength="155" class="form form-control" maxlength="200" />
                                </div>
                            </div>


                            <!-- IMAGENS -->

                            <div class="row">
                                <div class="col">
                                    <p class="text-center">
                                    <h3>Imagens</h3>
                                    </p>
                                </div>
                            </div>
                            <div class="row p-3">
                                <!-- Frontal -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Frontal</h3>
                                            <input type="file" name="img_frontal" id="img_frontal" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_frontal" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_frontal" id="obs_frontal" maxlength="155">
                                        </div>
                                    </div>
                                </div>

                                <!-- Lateral Direita -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Lateral Direita</h3>
                                            <input type="file" name="img_lateral_direita" id="img_lateral_direita" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_lateral_direita" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_lateral_direita" id="obs_lateral_direita" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-3">
                                <!-- Lateral Esquerda -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Lateral Esquerda</h3>
                                            <input type="file" name="img_lateral_esquerda" id="img_lateral_esquerda" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_lateral_esquerda" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_lateral_esquerda" id="obs_lateral_esquerda" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                                <!-- Fundo -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Fundo</h3>
                                            <input type="file" name="img_fundo" id="img_fundo" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_fundo" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_fundo" id="obs_fundo" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <!-- Local Instalação 1 -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Local Instalação 1</h3>
                                            <input type="file" name="img_local_instalacao_1" id="img_local_instalacao_1" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_local_instalacao_1" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_local_instalacao_1" id="obs_local_instalacao_1" maxlength="155">
                                        </div>
                                    </div>
                                </div>

                                <!-- Local Instalação 2 -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Local Instalação 2</h3>
                                            <input type="file" name="img_local_instalacao_2" id="img_local_instalacao_2" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_local_instalacao_2" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_locl_instalacao_2" id="obs_locl_instalacao_2" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <!-- Opcional 1 -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Opcional 1</h3>
                                            <input type="file" name="img_opcional_1" id="img_opcional_1" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_opcional_1" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_opcional_1" id="obs_opcional_1" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                                <!-- Opcional 2 -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Opcional 2</h3>
                                            <input type="file" name="img_opcional_2" id="img_opcional_2" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_opcional_2" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" class="form form-control" name="obs_opcional_2" id="obs_opcional_2" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-3">
                                <!-- Opcional 3 -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Opcional 3</h3>
                                            <input type="file" name="img_opcional_3" id="img_opcional_3" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_opcional_3" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" name="obs_opcional_3" id="obs_opcional_3" maxlength="155">
                                        </div>
                                    </div>
                                </div>
                                <!-- Opcional 4 -->
                                <div class="col border rounded">
                                    <div class="row">
                                        <div class="col text-center">
                                            <h3>Opcional 4</h3>
                                            <input type="file" name="img_opcional_4" id="img_opcional_4" class="form form-control">
                                            <img class="img-fluid max-w-96 p-2" id="img-preview_opcional_4" width="300" src="{{ asset('imagem/home.png') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Observação :</label>
                                            <input type="text" name="obs_opcional_4" id="obs_opcional_4a" maxlength="155">
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row p-3">
                                <div class="col">
                                    <input class="btn btn-primary" type="submit" name="btn" id="btn" value="Salvar">
                                </div>
                            </div>

                        </form>


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

            $("#cpf").inputmask("999.999.999-99");
            $("#cpfAgente").inputmask("999.999.999-99");
            $("#tel").inputmask("(99) [9]9999-9999");
            $(".latlong").inputmask("-99.9999999");

            $("#qtdPessoa, #qtdPessoa").inputmask('numeric', {
                rightAlign: false
            });


            $('#compTelhado, #larguracompTelhado').blur(function() {
                $('#areaTotalTelhado').val($('#compTelhado').val() * $('#larguracompTelhado').val());

            })

            $("#renda").inputmask('decimal', {
                alias: 'numeric',
                groupSeparator: '.',
                radixPoint: ',',
                prefix: 'R$ ',
                rightAlign: false
            });

            $('#compTelhado').inputmask('decimal', {
                integerDigits: 2,
                decimalDigits: 2,
                allowMinus: false, // Permite apenas valores positivos
                autoGroup: true,
                groupSeparator: '.',
                radixPoint: '.',
                rightAlign: false
            });

            $('#larguracompTelhado').inputmask('decimal', {
                integerDigits: 2,
                decimalDigits: 2,
                allowMinus: false, // Permite apenas valores positivos
                autoGroup: true,
                groupSeparator: '.',
                radixPoint: '.',
                rightAlign: false
            });

            $('#areaTotalTelhado').inputmask('decimal', {
                integerDigits: 2,
                decimalDigits: 2,
                allowMinus: false, // Permite apenas valores positivos
                autoGroup: true,
                groupSeparator: '.',
                radixPoint: '.',
                rightAlign: false
            });

            $('#compTestada').inputmask('decimal', {
                integerDigits: 2,
                decimalDigits: 2,
                allowMinus: false, // Permite apenas valores positivos
                autoGroup: true,
                groupSeparator: '.',
                radixPoint: '.',
                rightAlign: false
            });

            $('#medidaTelhadoAreaFogao').inputmask('decimal', {
                integerDigits: 2,
                decimalDigits: 2,
                allowMinus: false, // Permite apenas valores positivos
                autoGroup: true,
                groupSeparator: '.',
                radixPoint: '.',
                rightAlign: false
            });

            $('#testadaDispParteFogao').inputmask('decimal', {
                integerDigits: 2,
                decimalDigits: 2,
                allowMinus: false, // Permite apenas valores positivos
                autoGroup: true,
                groupSeparator: '.',
                radixPoint: '.',
                rightAlign: false
            });


            $("#div_moradia").hide();
            $("#div_coberturaOutros").hide();
            $("#div_medidaTelhadoFogao").hide();
            $("#testadaDispFogao").hide();
            $("#div_orgao_resp").hide();
            $("#div_outro_atend").hide();

            $('#sel_municipio').select2();

            $("#moradia").change(function() {
                if ($(this).val() == "outros") {
                    $("#div_moradia").show();
                } else {
                    $("#div_moradia").hide();
                }
            });

            $("#coberturaTelhado").change(function() {
                if ($(this).val() == "outros") {
                    $("#div_coberturaOutros").show();
                } else {
                    $("#div_coberturaOutros").hide();
                }
            });

            /* existe fogao a lenha */
            $('input[name="rb_fogao"]').change(function() {

                if ($('input[name="rb_fogao"]:checked').val() == 'sim') {
                    $("#div_medidaTelhadoFogao").show();
                    $("#testadaDispFogao").show();
                } else {
                    $("#div_medidaTelhadoFogao").hide();
                    $("#testadaDispFogao").hide();
                }

            });

            $('input[name="rb_atend"]').change(function() {

                if ($('input[name="rb_atend"]:checked').val() == 'sim') {
                    $("#div_orgao_resp").show();
                } else {
                    $("#div_orgao_resp").hide();
                }

            })

            // Dados das comunidades (assumindo que $comunidades já contém os dados em formato JSON)
            var comunidades = <?php echo $comunidades; ?>;

            // Função para filtrar as comunidades por município
            function filtrarComunidades(municipio) {
                for (var i = 0; i < comunidades.length; i++) {
                    if (comunidades[i].municipio === municipio) {
                        return comunidades[i].comunidades;
                    }
                }
                return [];
            }

            $('#sel_municipio').on('change', function() {
                //alert($(this).find('option:selected').text());
                var municipioSelecionado = $(this).find('option:selected').text();
                var comunidadesFiltradas = filtrarComunidades(municipioSelecionado);

                $('#sel_comunidade').empty().select2({
                    data: comunidadesFiltradas
                });
            });


            // Preview Imagem Frontal
            $('#img_frontal').change(function(event) {
                var file = event.target.files[0];
                var maxSize = 2 * 1024 * 1024; // 2MB em bytes

                if (file.size > maxSize) {
                    alert('O tamanho da imagem excede 2MB.');
                    $(".validate").show();
                    this.value = ''; // Limpa o campo de entrada
                    return; // Interrompe a execução da função
                }else {
                    $(".validate").hide();
                }
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_frontal').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem Lateral Direita
            $('#img_lateral_direita').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_lateral_direita').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem Lateral Esquerda
            $('#img_lateral_esquerda').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_lateral_esquerda').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });

            // Preview Imagem fundo
            $('#img_fundo').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_fundo').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem instalacao_1
            $('#img_local_instalacao_1').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_local_instalacao_1').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem instalacao_2
            $('#img_local_instalacao_2').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_local_instalacao_2').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem opcional_1
            $('#img_opcional_1').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_opcional_1').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem opcional_2
            $('#img_opcional_2').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_opcional_2').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem opcional_3
            $('#img_opcional_3').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_opcional_3').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            // Preview Imagem opcional_4
            $('#img_opcional_4').change(function(event) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('#img-preview_opcional_4').attr('src', event.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            });

        });
    </script>

@endsection
