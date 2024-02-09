@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/rat') }}">Rat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configurações</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div style="background-color:#e9ecef;" class="container min-vh-100">

        <div class="row">
            <div class="col-9">
                <legend class="p-4">Rat - Configurações </legend>
            </div>
            <div class="col-3 p-2">
                <img class="border" width="80" src="{{ url('/imagem/brasao/brasao_7221.png') }}" alt="">
            </div>
        </div>


        {{ Form::open(['url' => 'rat/config']) }}

        <div class="row p-2">

            <div class='col-6'>
                {{ Form::token() }}
                {{ Form::label('Logo', 'Logomarca') }} :<br>
                {{ Form::file('logo', ['id'=>'logo']) }}
            </div>
        </div>
        <div class="row p-2">

            <div class="col">
                {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('code')

    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {


        })
    </script>


@endsection
