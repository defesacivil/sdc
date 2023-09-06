@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">TDAP - Transporte e Distribuição de Água Potável</li>
        </ol>
    </nav>

@endsection

<?php /*
backend
pmda
lista para analise - editar /validar comunidade / visualizar
busca - editar /validar comunidade / visualizar
conformidade


frontend
novo pmda
index processos - editar / visualizar / mensagem / enviar */
?>

@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('ajuda') }}>Voltar</a></p>


            <div class="row text-center">

                {{-- MODULO PMDA CEDEC --}}
                @can('cedec')
                    <div class="col">
                        <div class="col bg-gray-100 sm:rounded-lg">
                            <figure class="figure">
                                <a href='{{ url('pmda') }}'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/pmda.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">PMDA</figcaption>
                        </div>
                    </div>
                @endcan

                {{-- MODULO CONTROLE DE ESTOQUE --}}
                @can('cedec')
                    <div class="col">
                        <div class="col bg-gray-100 sm:rounded-lg">
                            <figure class="figure">
                                <a href='#'>
                                    <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/conformidade.png') }}'
                                        alt=""></a>
                                <figcaption class="figure-caption text-center">COMFORMIDADE</figcaption>
                        </div>
                    </div>
                @endcan
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
