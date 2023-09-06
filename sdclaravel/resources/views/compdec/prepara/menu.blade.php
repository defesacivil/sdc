@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cadastro Vistorias</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row flex-fill">

        <div class="col-md-12">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('/dashboard') }}>Voltar</a>
                {{-- <a class='btn btn-info btn-sm' href={{ url('compdec/vistoria/create') }} title="Criar novo Registro">+ Novo</a> --}}
            </p>

            <legend class="p-4">Gerenciamento de Vistorias / Termo de Interdição</legend>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <legend class="">Laudo de Vistoria</legend>
                            </h5>
                            <p class="card-text p-2">Você pode Criar, Editar e Imprimir os Laudos de Vistoria de seu Município.</p>
                            <a href="{{ url('vistoria') }}" class="btn btn-primary" title="Clique para ">Comece agora</a>
                        </div>
                    </div>
                </div>

                {{-- INTERDICAO --}}
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <legend>Termo de Interdição</legend>
                            </h5>
                            <p class="card-text p-2">Crie, Edite Publique e Imprima os Termos de Interdição de seu Município.</p>
                            <a href="{{url('interdicao')}}" class="btn btn-primary">Comece agora</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <div class="row p-2">
                @foreach ($vistorias as $vistoria)

                @php
                    $total_vistoria += $vistoria->total;
                @endphp
                    <div class="col">
                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header"><i class="fas fa-cogs"></i>
                                <h2> {{ $vistoria->tp_imovel }}(s)</h2>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Qtd de Vistorias</h5>
                                <p class="card-text">
                                <h4 class="display-3">{{ $vistoria->total }}</h4>
                                </p>
                            </div>
                        </div>
                    </div>
                @endForeach

            </div>

            <!--  -->
            <div class="row p-5">
                <div class="col-md-12">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><i class="fas fa-cogs"></i>
                            <h2> Total de Vistorias</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">
                            <h4 class="display-3 text-center">{{ $total_vistoria }}</h4>
                            </p>
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
