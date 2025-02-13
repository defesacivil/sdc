@auth
    @extends('layouts.pagina_master')    
@endauth
@guest
    @extends('layouts.pagina_simples')
@endguest

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Módulo Cedec</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="row">
                <div class="col text-center">
                    <h3>Central de Demandas</h3>
                </div>
            </div>
            
            {{-- Formulario --}}
            <div class="row p-2">
                <div class="col-md-12">
                    <form role="form" action="{{ url('demanda/store') }}" method="POST" name="frm">
                        @csrf

                        {{-- <div class="form-group p-3 col-md-12">
                            <div class="checkbox">
                                <label>O Solicitante é o mesmo logado no Sistema:
                                    <input type="checkbox" name="ck_" id="ck_" />
                                </label>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="form-group p-3 col-md-6">
                                <label for="servico">Categorização :</label>
                                {{ Form::select('servicos', $servicos, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'servicos', 'placeholder' => 'Selecione um Assunto', 'required' => 'required']) }}
                            </div>

                            <div class="form-group p-3 col-md-6 email_adm1">
                                <label for="servico">Selecione uma Caixa de Email Administrativa :</label><br>
                                {{ Form::select('email_adm', $email_adm, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'email_adm', 'placeholder' => 'Selecione uma caxa de Email', 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group p-3 col-md-6">
                                <label for="categoria">Diretoria/Seção :</label>
                                {{ Form::select('secao', $secao, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'secao', 'placeholder' => 'Selecione um Assunto', 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group p-3">
                                <label for="">Texto Solicitação :</label><br>
                                <textarea class="form form-control" cols="4" rows="10" name="texto" id="texto">
Nome:
Masp/Número Polícia:
CPF:
Email para rebeber retorno Chamado:
                                    
Se necessário detalhar a solicitação:
                                </textarea>

                            </div>
                        </div>

                        <div class="form-group p-3">

                            <label for="exampleInputFile">Fotos / Print: </label><br>
                            <input type="file" class="form-control-file" id="exampleInputFile" />
                            <p class="help-block">
                                Anexe as fotos ou print que achar necessário
                            </p>
                        </div>

                        <div class="form-group p-3">
                            <input type="submit" class="btn btn-primary" value='Salvar' />
                        </div>
                    </form>
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

            $('.email_adm1').hide();

            $('#servicos').select2();
            $('#secao').select2();
            $('#email_adm').select2({});


            var texto = "Nome:\n" +
                "Masp/Número Polícia:\n" +
                "CPF:\n" +
                "Email para rebeber retorno Chamado:\n" +
                "Se necessário detalhar a solicitação:";

            $('#ck_').change(function() {
                if ($(this).is(':checked')) {
                    $('#texto').val("");
                } else {
                    $('#texto').val(texto);
                }

            })


            $('#servicos').change(function() {
                //console.log($(this).val());
                if ($(this).val() == 'Acesso Caixa Email') {
                    $('.email_adm1').show();
                    $('#email_adm').prop('required', 'true');
                } else {
                    $('.email_adm1').hide();
                }

            });


        })
    </script>

@endsection

@push('other-scripts')
    {{-- <script src="{{ asset('public/js/views/demanda.index.js') }}"></script> --}}
@endpush
