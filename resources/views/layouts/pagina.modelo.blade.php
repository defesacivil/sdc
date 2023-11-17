@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/busca') }}">Pesquisa Pedido Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edição Pedido Ajuda Humanitária</li>
        </ol>
    </nav>

@endsection

@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('mah/busca') }}>Voltar</a></p>


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
