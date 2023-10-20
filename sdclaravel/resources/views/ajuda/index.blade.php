@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajuda Humanitária</li>
        </ol>
    </nav>

@endsection

@section('content')

    <div class="container">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p><br>
                <div class="row">


                    @can('cedec')
                        {{-- MODULO TDAP --}}
                        <div class="col-6 col-md-4 col-lg-3 text-center">

                            <figure class="figure">
                                <a href='ajuda/tdap'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pipa.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">TDAP</figcaption>

                        </div>

                        {{-- MODULO CONTROLE DE ESTOQUE --}}

                        {{-- <div class="col-6 col-md-4 col-lg-3 text-center">

                            <figure class="figure">
                                <a href='{{ url('estoque') }}'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/estoque_.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">ESTOQUE MAH</figcaption>

                        </div> --}}


                        {{-- MODULO PAH CEDEC --}}

                        <div class="col-6 col-md-4 col-lg-3 text-center">

                            <figure class="figure">
                                <a href='mah'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pedido_cesta.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">ADM. PEDIDO MAH</figcaption>

                        </div>
                    @endcan

                    {{-- ############################### MODULOS COMPDEC ################################################ --}}

                    @can('compdec')

                        {{-- PMDA --}}
                        <div class="col-6 col-md-4 col-lg-3 text-center">
                            <figure class="figure">
                                <a href='#'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pedido_cesta.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">PMDA</figcaption>
                        </div>

                        {{-- TDAP / CONFORMIDADE --}}
                        <div class="col-6 col-md-4 col-lg-3 text-center">
                            <figure class="figure">
                                <a href='mah_compdec'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pedido_cesta.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">TDAP</figcaption>
                        </div>

                        {{-- MODULO PAH --}}
                        <div class="col-6 col-md-4 col-lg-3 text-center">
                            <figure class="figure">
                                <a href='mah_compdec'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pedido_cesta.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">PEDIDO MAH</figcaption>
                        </div>
                    @endcan

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
