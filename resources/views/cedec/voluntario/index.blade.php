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
    
    function exclui(id){
		var campo  = $("#telefone"+id);
        var label  = $("#label"+id);
        var button = $("#button"+id);
        
		campo.remove();
		label.remove();
		button.remove();
	}

    idContador = 0;

        $(document).ready(function() {

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

                html += "<div class='row'><div class='p-3 col-3'>";
                html += "<label class='fw-bold label' id='label"+idContador+"'>Nº Telefone "+ idContador +":</label>";
                html += "<input type='text' id='telefone" + idContador + "' class='form-control telefone excluir' name='telefone[]' placeholder='Insira um " + tipo + "'/>";
                html += "<span class='input-group-btn span'>";
                html += "<button class='btn btnExcluir' id='button"+idContador+"' onclick='exclui(" + idContador + ")' type='button'><span class='fa fa-trash'></span></button>";
                html += "</span>";
                html += "</div></div>";

                $("#imendaHTML" + tipo).append(html);
            }

            $(".btnExcluir").click(function() {
                console.log(this);
                $(this).slideUp(200);
                $('.label').slideUp(200);
                $('.span').slideUp(200);
            })
        })
    </script>

@endsection
