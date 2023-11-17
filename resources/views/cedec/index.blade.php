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

        <div class="col-md-12">
            <p class="p-4 text-center"><a class='btn btn-success btn-sm' href={{ url('dashboard') }}>Voltar</a></p>
            <div class="row">
                <div class="col-6 col-md-2 col-lg-3">
                    <div class="col bg-gray-100 sm:rounded-lg text-center">
                        {{-- <figure class="figure">
                    <a href='{{url('boletim')}}'>
                        <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/boletim.png') }}'
                            alt=""></a>
                    <figcaption class="figure-caption text-center">BOLETIM</figcaption>
                </figure> --}}
                    </div>
                </div>
                <div class="col-6 col-md-2 col-lg-3">
                    <div class="col bg-gray-100 sm:rounded-lg text-center">
                        {{-- <figure class="figure">
                    <a href='{{url('diario')}}'>
                        <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/diario.png') }}'
                            alt=""></a>
                    <figcaption class="figure-caption text-center">DIARIO PLANTÃO</figcaption>
                </figure> --}}
                    </div>
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
