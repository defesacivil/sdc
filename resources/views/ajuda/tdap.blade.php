@extends('adminlte::page')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='dashboard'>Voltar</a></p><br>
        </div>
    </div>
    <div class="row">
        {{-- MODULO TDAP --}}
        @can('cedec')
            <div class="col-6 col-md-4 col-lg-3">
                <div class="col bg-gray-100 sm:rounded-lg">
                    <figure class="figure">
                        <a href='#'>
                            <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pipa.png') }}'
                                alt=""></a>
                        <figcaption class="figure-caption text-center">TDAP</figcaption>
                </div>
            </div>
        @endcan
        {{-- MODULO PMDA CEDEC --}}
        @can('cedec')
        <div class="col-6 col-md-4 col-lg-3">
            <div class="col bg-gray-100 sm:rounded-lg">
                <figure class="figure">
                    <a href='#'>
                        <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pmda.png') }}'
                            alt=""></a>
                    <figcaption class="figure-caption text-center">PMDA</figcaption>
            </div>
        </div>
        @endcan

        {{-- MODULO CONTROLE DE ESTOQUE --}}
        @can('cedec')
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="col bg-gray-100 sm:rounded-lg">
                        <figure class="figure">
                            <a href='#'>
                                <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/estoque_.png') }}'
                                    alt=""></a>
                            <figcaption class="figure-caption text-center">ESTOQUE MAH</figcaption>
                    </div>
                </div>
        @endcan

        {{-- MODULO PAH CEDEC --}}
        @can('cedec')
        <div class="col-6 col-md-4 col-lg-3">
            <div class="col bg-gray-100 sm:rounded-lg">
                <figure class="figure">
                    <a href='#'>
                        <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pedido_cesta.png') }}'
                            alt=""></a>
                    <figcaption class="figure-caption text-center">ADM. PEDIDO MAH</figcaption>
            </div>
        </div>
        @endcan

        {{--############################### MODULOS COMPDEC ################################################--}}
        
        @can('compdec')
        {{-- MODULO PMDA COMPDEC --}}
        <div class="col">
            <a href="#">PMDA</a>
        </div>
        @endcan
        
        {{-- MODULO PAH --}}
        @can('compdec')
            <div class="col">
                <a href="#">PEDIDOS MAH</a>

            </div>
        @endcan

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
