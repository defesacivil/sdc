@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Prepara - Minas</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container min-vh-100">
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('/dashboard') }}>Voltar</a>
                <a class='btn btn-info btn-sm' href={{ url('prepara/create') }} title="Criar novo Registro">+ Cadastrar Programa</a>
            </p>

            <legend class="p-4">Programa Prepara Minas</legend>

                


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
