@extends('layouts/master')

<!-- conteudo -->
@section('content')

    <!-- validadação -->
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li class='error'>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Controle de Estoque</li>
        </ol>
    </nav>

    @can('cedec')
        {{-- CONTEUDO  --}}

        <div class="row">
            <div class="col text-center">
                <a href="{{url('estoque/cadastro')}}"><img width="150" src="{{ url('imagem/icon/cadastro.png') }}"></a>
                <h5>Cadastros Principais</h5>
            </div>
            <div class="col text-center">
                <a href="{{url('estoque/movimentacao')}}"><img width="130" src="{{ url('imagem/icon/movimentacao.png') }}"></a>
                <h5>Movimentações</h5>
            </div>
            <div class="col text-center ">
                <a href="{{url('estoque/relatorio')}}"><img width="120" src="{{ url('imagem/icon/report.png') }}"></a>
                <h5>Relatórios</h5>
            </div>

        </div>
    @endcan


@stop

@section('css')

@stop

@section('js')
    <script text="javascript/text">
        $(document).ready(function() {


        });
    </script>

@stop
