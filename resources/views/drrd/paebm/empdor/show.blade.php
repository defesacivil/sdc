@extends('layouts.pagina_master')

{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/drrd') }}">Drrd</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/pae/empdor') }}">Empreendedor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualização</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row flex-fill">

        <div class="col-md-12">

            <div class="row">
                <div class="col p-3">
                    <p class='text-center'><a class='btn btn-success' href='{{ url('pae/empdor') }}'>Voltar</a></p><br>
                    <p class="text-center">
                        <legend>Empreendedor</legend>
                    </p>
                </div>
            </div>
            <div class="col">
                <table class="table table-bordered table-condensed table-stripped">
                    <tr>
                        <th>CÓDIGO</th>
                        <td>{{ $empdor->id }}</td>
                    </tr>
                    <tr>
                        <th>EMPREENDEDOR</th>
                        <td>{{ $empdor->nome }}</td>
                    </tr>


                </table>
            </div>
        </div>
    </div>


    @stop

    @section('css')
        <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
    @stop

    @section('js')
        <script>
            console.log('Hi!');
        </script>
    @stop
