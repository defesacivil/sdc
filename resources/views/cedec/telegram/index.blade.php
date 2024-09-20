@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Configurações</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div class="container border rounded min-vh-100" style="background-color:#e9ecef;">
        <div class="row">

            <div class="col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p>
                <p class="text-center"><legend>Configurações</legend></p>
                <br>
            </div>

            <div class="row">
                <div class="col">
                    {{ $response }}
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



        })
    </script>

@endsection
