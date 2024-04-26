@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Módulo Cedec</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="row">
                <div class="col text-center">
                    <h3>Central de Demandas</h3>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success">
                        Listagem
                    </button>
                </div>
            </div>

            
            {{-- Formulario --}}
            <div class="row p-2">
                <div class="col-md-12">
                    <form role="form">
                        <div class="form-group p-2">
                            <label for="categoria">Categoria da Demanda</label>
                            {{ Form::select('categoria', $categorias, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'id_cobrade', 'placeholder' => 'Categoria do Chamado', 'required' => 'required']) }}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">
                                Password
                            </label>
                            <input type="password" class="form-control" id="exampleInputPassword1" />
                        </div>
                        <div class="form-group">

                            <label for="exampleInputFile">
                                File input
                            </label>
                            <input type="file" class="form-control-file" id="exampleInputFile" />
                            <p class="help-block">
                                Example block-level help text here.
                            </p>
                        </div>
                        <div class="checkbox">

                            <label>
                                <input type="checkbox" /> Check me out
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
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

@push('other-scripts')

<script src="{{ asset('public/js/views/demanda.index.js')}}"></script>

@endpush
