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

                <p class="text-center"><legend>Tabelas DB</legend></p>
                <div class="row">
                    <div class="col">
                        <select name="selTables" id="selTables" class="form form-control">
                            @foreach ($tables as $table)

                                <option value="{{ $table->TABLE_NAME }}">{{ $table->TABLE_NAME  }} - {{ $table->TABLE_COMMENT }}</option>
                                
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="row">

                    <div id='fields'></div>

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

            $('#selTables').change(function(){

                alert();

            });

        })
    </script>

@endsection
