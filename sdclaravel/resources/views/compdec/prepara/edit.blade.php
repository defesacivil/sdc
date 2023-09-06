@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/estoque') }}">Controle de Estoque</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/estoque/cadastro') }}">Cadastros</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fornecedor</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">

            <legend>Cadastro de Fornecedores</legend>

            @can('cedec')
                <p class='text-center'><a class='btn btn-success' href='{{url('estoque/fornecedor')}}'>Voltar</a></p><br>


                {{ Form::open(['url' => '/estoque/fornecedor/store']) }}
                {{ Form::token() }}

                <div class='col'>
                    {{ Form::label('nome', 'Nome') }}:
                    {{ Form::text('nome', '', ['class' => 'form form-control', 'required maxlenght=70']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('cpfcnpj', 'CPF CNPJ') }}:
                    {{ Form::text('cpfcnpj', '', ['class' => 'form form-control', 'required maxlenght=20']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('endereco', 'Endereço') }}:
                    {{ Form::text('endereco', '', ['class' => 'form form-control', 'required maxlenght=70']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('municipio', 'Municipio') }}:
                    {{ Form::text('municipio', '', ['class' => 'form form-control', ' maxlenght=45']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('estado', 'Estado') }}:
                    {{ Form::text('estado', '', ['class' => 'form form-control', ' maxlenght=6']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('cep', 'Cep') }}:
                    {{ Form::text('cep', '', ['class' => 'form form-control',  'maxlenght=45']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('tel', 'Telefone') }}:
                    {{ Form::text('tel', '', ['class' => 'form form-control',  'maxlenght=8']) }}
                    <br>
                </div>
                <div class='col'>
                    {{ Form::label('email', 'Email') }}:
                    {{ Form::text('email', '', ['class' => 'form form-control',  'maxlenght=110']) }}
                    <br>
                </div>
                
                <div class='row'>
                    <div class="col-12">
                    {{ Form::submit('Gravar', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}
                <br>

                <div class="row">
                    <div class="col-12 text-center">

                    </div>
                </div>
            @endcan

        </div>
    </div>

@stop

@section('css')

@stop

@section('code')

    <script type="text/javascript">
        $(document).ready(function() {



        })
    </script>

@endsection
