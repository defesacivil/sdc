@extends('layouts.pagina_master_web')

{{-- header --}}
@section('header')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h4>
                <p class="p-4 text-center">Cadastro de Voluntários da Defesa Civil de MG</p>
            </h4>

            <a href='#'>Cancelar cadastro></a>
            <span>Voçe pode pedir a remoção do cadastro da base de Dados de Voluntários</span>
        </div>
    </div>

    @include('cedec.voluntario.form.index')

@stop

@section('css')
@stop

@section('code')


    <script type="text/javascript">
        function exclui(id) {
            var campo = $(".telefone" + id);
            campo.remove();            
        }

        idContador = 0;

        $(document).ready(function() {

            $('.whatsapp').change(function(){
                if($(this).is(':checked')){
                    $(this).val(1);
                }else {
                    $(this).val(0);
                }

                $('telefone').val() += $('telefone').val($(this).val());
                //alert($(this).val());
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


            function adicionaCampo(tipo) {

                idContador++;

                var idCampo = "campoExtra" + idContador;
                var idForm = "formExtra" + idContador;

                var html = "";

                html += "<div class='row telefone"+ idContador+"'>"
                    html += "<div class='p-3 col-3'>";
                        html += "<label class='fw-bold' id='label" + idContador + "'>Nº Telefone " + idContador + ":</label>";
                        html += "<input type='text' id='telefone" + idContador + "' class='form-control telefone excluir' name='telefones[]' placeholder='Insira um " + tipo + "'/>";
                        html += "<span class='input-group-btn'>";
                        html += "<button class='btn btnExcluir' id='button" + idContador + "' onclick='exclui(" + idContador + ")' type='button'><span class='fa fa-trash'></span></button>";
                        html += "</span>";
                    html += "</div>";
                    html += "<div class='col'>";
						html += "<div class='p-3 col'>";
						html += "<label class='fw-bold'>Tem Whatsapp ?</label><br>";
						html += "<input type='checkbox' name='whatsapp[]' id='whatsapp\"+idContador+\"' data-n='\"+idContador+\"' class='form form-checkbox whatsapp'>";
					html += "</div>";
                html += "</div>";

                $("#imendaHTML" + tipo).append(html);
            }

            $(".btnExcluir").click(function() {
                console.log(this);
                $(this).slideUp(200);
                $('.label').slideUp(200);
            })
        })



    </script>

@endsection
