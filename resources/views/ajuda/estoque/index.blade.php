@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Controle de Estoque</li>
        </ol>
    </nav>

@endsection

@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('ajuda') }}>Voltar</a></p>

            @can('cedec')
                {{-- CONTEUDO  --}}

                <div class="row">
                    <div class="col text-center">
                        <a href="{{ url('estoque/cadastro') }}"><img width="150" src="{{ url('imagem/icon/cadastro.png') }}"></a>
                        <h5>Cadastros Principais</h5>
                    </div>
                    <div class="col text-center">
                        <a href="{{ url('estoque/movimentacao') }}"><img width="130" src="{{ url('imagem/icon/movimentacao.png') }}"></a>
                        <h5>Movimentações</h5>
                    </div>
                    <div class="col text-center ">
                        <a href="{{ url('estoque/relatorio') }}"><img width="120" src="{{ url('imagem/icon/report.png') }}"></a>
                        <h5>Relatórios</h5>
                    </div>

                </div>
            @endcan




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
