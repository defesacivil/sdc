@extends('layouts.pagina_master_web')

{{-- header --}}
@section('header')

@endsection

@section('header_pg')
    <div class="col-12 shadow" id="header_vol">
        <div class="row">
            <div class="col-2 p-3">
                <img width="100" class="mb-2 img-fluid" src="{{ url('imagem/DEFESACIVILMG_400.png') }}">
            </div>
            <div class="col-10 p-3">
                <p class="text-center">
                <h1>Gabinete Militar do Governado de Minas Gerais<br>Coordenadoria Estadual de Defesa Civil de Minas Gerais</h1>
                </p>
                <p>
                <h3 class="text-white">"Sua dedicação pode salvar vidas. Junte-se à Rede de Voluntários da Defesa Civil de Minas Gerais e faça a diferença em nossa comunidade!"</h3>
                </p>
            </div>
        </div>

    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3>
                <p class="p-4 text-center">Formulário de Cadastro de Voluntários da Defesa Civil de MG</p>
            </h3>

            {{-- <a href='#' class="btn btn-warning">Cancelar cadastro( em construção )</a>
            <span>Voçe pode pedir a remoção do cadastro da base de Dados de Voluntários</span> --}}
        </div>

        @include('cedec.voluntario.form.create')

    </div>
@stop

@section('css')
@stop

@section('code')


    <script type="text/javascript">
        idContador = 0;

        $(document).ready(function() {

            $('#header_vol').css('background-image', 'url("{{ asset('imagem/background/imagem2.png') }} ")');
            $('#header_vol').css('background-position', 'right 20px bottom 0px');

            $('.whatsapp').click(function() {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }

            });
            $('#imendaHTMLtelefone').on('click', '.whatsapp', function() {
                if ($(this).is(':checked')) {
                    $(this).val(1);
                } else {
                    $(this).val(0);
                }

            });

            //$('.telefone').mask("(99)?9999-9999");

            $('.profissao').select2();
            $('.municipio_id').select2();

            $('#municipio_id').on('select2:select', function(e) {
                $('#regiao_id').val('1');
            });

            $("#btnAdicionaTelefone").click(function(e) {
                e.preventDefault();
                var tipoCampo = "telefone";
                adicionaCampo(tipoCampo);
            })




            $(".btnExcluir").click(function() {
                console.log(this);
                $(this).slideUp(200);
                $('.label').slideUp(200);
            })
        });

        function adicionaCampo(tipo) {

            idContador++;

            var idCampo = "campoExtra" + idContador;
            var idForm = "formExtra" + idContador;

            var html = "";

            html += "<div class='row telefone" + idContador + "'>"
                html += "<div class='p-3 col-12 col-md-6'>";
                    html += "<label class='fw-bold' id='label" + idContador + "'>Nº Telefone " + idContador + ":</label>";
                    html += "<input type='text' id='telefone" + idContador + "' class='form-control telefone excluir' name='telefones[]' placeholder='Insira um " + tipo + "'/>";
                    html += "<span class='input-group-btn'>";
                        html += "<button class='btn btnExcluir' id='button" + idContador + "' onclick='exclui(" + idContador + ")' type='button'><span class='fa fa-trash'></span></button>";
                    html += "</span>";
            html += "</div>";
                html += "<div class='col'>";
                html += "<div class='p-3 col-12 col-md-6'>";
                    html += "<label class='fw-bold'>Tem Whatsapp ?</label><br>";
                    html += "<select name='sel_zap[]' id='sel_zap' class='form form-control'>";
                        html += "<option value='0'>Não</option>";
                        html += "<option value='1'>Sim</option>";
                    html += "</select>";
                html += "</div>";
            html += "</div>";

            $("#imendaHTML" + tipo).append(html);
        }


        function exclui(id) {
            var campo = $(".telefone" + id);
            campo.remove();
        }
    </script>

@endsection
