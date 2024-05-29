@extends('layouts.pagina_master')
{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/pae/protocolo') }}">Protocolo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios Externos</li>
        </ol>
    </nav>
@endsection

@section('content')


    <div class="col-md-12">
        <div class="row">
            <p class="text-center"><a href='#' class='btn btn-primary'>Voltar</a></p>
            <p class="text-center">
                <legend>Cadastro Usuário Externo (Vinculado ao Empreendedor)</legend>
            </p>
        </div>
        
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form action="{{ url('pae/users/store') }}" method="POST" name="frmCreateUser" id="frmCreateUser">
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <label>Empreendedor ( Mineradora )</label><br>
        
                    <select name="selEmpreendedor" id="selEmpreendedor" class="form form-control">
        
                        <option value="2">ANGLO</option>
        
                        <?php
                        foreach ($empdors as $key => $empreendor) {
                            print "<option value='" . $empreendor->id . "'>" . $empreendor->nome . "</option>";
                        }
        
                        ?>
        
                    </select><br>
        
                    {{-- <label>CNPJ</label><br>
                    <input type="text" class="form form-control" name="cnpj" id="cnpj" maxlength="18" required="required"><br> --}}
        
                    <!--<select class="js-data-example-ajax form form-control"></select>-->
        
                    <label>Nome (Colaborador)</label><br>
                    <input type="text" class="form form-control" name="nomeUser" id="nomeUser" required="required"><br>
        
                    <label>CPF</label><br>
                    <input type="text" class="form form-control" name="cpfUser" id="cpfUser" maxlength="14" required="required"><br>
        
                    <label>E-mail</label><br>
                    <input type="email" class="form form-control" name="emailUser" id="emailUser" maxlength="110" required="required"><br>
        
                    <input type="submit" class="btn btn-success" name="btn" value="Salvar">
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>


        
    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('code')
    <script>
        $(document).ready(function() {

            $('#cpfUser').inputmask("999.999.999-99"); 
            $('#cnpj').inputmask("99.999.999/9999-99"); 

            

        });
    </script>
@stop
