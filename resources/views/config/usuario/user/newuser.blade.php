@extends('layouts.pagina_simples')

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
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href={{ url('ajuda') }}>Voltar</a>&nbsp;
                <div class="row">
                    <div class="col">

                        <form action="{{ url('usuario/novo') }}" method="POST">
                            @csrf
                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('Nome Completo') }}:</label>
                                <input type="text" name="name" id="name" value="" class="form form-control" maxlength="70" required/>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('posto') }}</label>
                                <select name="posto" id="posto" class="form form-control">
                                    <option>Selecione uma Opção</option>
                                    <option>FUNCIONARIO CIVIL</option>
                                    @foreach (config('constantes.POSTO_MILITAR') as $posto)
                                        <option>{{ $posto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('CPF') }}:</label>
                                <input type="text" name="cpf" id="cpf" value="" class="form form-control" maxlength="15" required/>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('Data Nascimento') }}:</label>
                                <input type="date" name="dt_nasc" id="dt_nasc" value="" class="form form-control" maxlength="10" required/>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('MASP/Número Policia') }}:( 7 digitos)</label>
                                <input type="numeric" name="masp_numpol" id="masp_numpol" value="" class="form form-control" maxlength="15" required/>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('Email para Contato') }}:</label>
                                <input type="email" name="email" id="email" value="" class="form form-control" maxlength="70" required/>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                                <label class="label">{{ ucfirst('Telefone (WhatsApp)') }}:</label>
                                <input type="tel" name="tel" id="tel" value="" class="form form-control" maxlength="14" required/>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                            <input type="submit" name="btnEnviar" id="btnEnviar" value="Enviar" class="btn btn-success" />
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
            $("#dt_nasc").inputmask("99/99/9999");
            $("#tel").inputmask("(99)99999-9999");
            $("#masp_numpol").inputmask("9999999");

        })
    </script>

@endsection
