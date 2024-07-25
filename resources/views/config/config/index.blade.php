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

    <div class="container p-3 border min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="col-12 col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p>

                <p class="text-center"><legend>Configurações</legend></p>
                <div class="row">
                    <div class="col">
                        <input type="checkbox" name="ck_clear_all" id="ck_clear_all" class="form form-control">Limpar Todo o Cache
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



        })
    </script>

@endsection
