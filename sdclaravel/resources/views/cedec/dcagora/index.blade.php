@extends('adminlte::page')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success' href='dashboard'>Voltar</a></p><br>
            <p class="text-center"><legend>pmda</legend></p>
        </div>
    </div>
    <div class="row">
        {{-- MODULO TDAP --}}
        @can('cedec')
            <div class="col">
                
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
