@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/config') }}">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuários</li>
        </ol>
    </nav>

@endsection


<!-- conteudo -->
@section('content')

    <div class="row">
        <div class="col text-center">
            <a href='{{ url('dashboard') }}' class="btn btn-success">Voltar</a>
        </div>
    </div>

    <div class="row">

        <legend>Cadastro Usuario</legend>

        <form class="form form-control" action="{{ url('usuario/store') }}" name="frmCadastro" method="POST" id="frmCadastro">

            <div class="row p-2">
                <div class="col col-md-6">
                    <label>Nome :</label>
                    <input class="form form-control" type="text" name="name" id="name" maxlength="70" required>
                </div>
                <div class="col col-md-6">
                    <label>E-mail :</label>
                    <input class="form form-control" type="email" name="email" id="email" maxlength="110" required>
                </div>
            </div>

            <div class="row p-2">
                <div class="col col-md-6">
                    <label>CPF :</label>
                    <input class="form form-control" type="text" name="cpf" id="cpf" maxlength="15" required>
                </div>

                <div class="col col-md-6">
                    <label>Tipo :</label>
                    <select class="form form-control" name="selTipo" id="selTipo">
                        <option value="cedec">Cedec</option>
                        <option value="compdec">Compdec</option>
                        <option value="convidado">Convidado</option>
                    </select>
                </div>
            </div>


            <div class="row p-2">
                <div class="col col-md-6">
                    <label>Município :</label>
                    <select class="form form-control selMunicipio" name="municipio" id="municipio">
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->nome}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col col-md-6">
                    <label>SubTipo :</label>
                    <select class="form form-control" name="selsubTipo" id="selsubTipo">
                        <option value="cedec">Membro</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="btnSearch" id="btnSearch">Gravar</button>
            @csrf
        </form>
    </div>

@stop


@section('css')
@stop

@section('code')


    <script type="text/javascript">
        $(document).ready(function() {

            $("#cpf").inputmask('999.999.999-99');

            $('.selMunicipio').select2();


        });
    </script>

@endsection
