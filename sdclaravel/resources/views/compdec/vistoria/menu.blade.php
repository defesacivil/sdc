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

    <div class="container">
        <div class="col-md-12 text-center">
            <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('/dashboard') }}>Voltar</a>
                {{-- <a class='btn btn-info btn-sm' href={{ url('compdec/vistoria/create') }} title="Criar novo Registro">+ Novo</a> --}}
            </p>

            <div class="row p-3">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card bg-gradient-secondary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <legend class="">Relatório de Vistoria</legend>
                            </h5>
                            <p class="card-text p-2">Você pode Criar, Editar e Imprimir os Relatórios de Vistoria de seu Município.</p>
                            <a href="{{ url('vistoria') }}" class="btn btn-primary" title="Clique para ">Comece agora</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>

                {{-- INTERDICAO --}}
                {{-- <div class="col-md-6">
                    <div class="card bg-gradient-secondary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <legend>Termo de Interdição</legend>
                            </h5>
                            <p class="card-text p-2">Crie, Edite Publique e Imprima os Termos de Interdição de seu Município.</p>
                            <a href="{{ url('interdicao') }}" class="btn btn-primary">Comece agora</a>
                        </div>
                    </div>
                </div> --}}
            </div>


            {{-- VISTORIAS --}}

            <div class="row p-2">

                <div class="col-md-3"></div>
                <div class="col-md-6">

                    @foreach ($vistorias as $vistoria)
                        @php
                            $total_vistoria += $vistoria->total;
                        @endphp
                        <div class="col-md-4 float-left">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header"><i class="fas fa-cogs"></i>
                                    <h4> {{ $vistoria->tp_imovel }}</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <a class="text-light" href="{{url('vistoria/show/'.$vistoria->tp_imovel)}}"><h2 class="display-5">{{ $vistoria->total }}</h2></a> --}}
                                    {{$vistoria->total}}
                                </div>
                            </div>
                        </div>
                    @endForeach
                </div>

                <div class="col-md-3"></div>

                {{-- INTERDICOES --}}
                {{-- <div class="col-md-6">
                    <div class="col-md-6 float-left">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header"><i class="fas fa-cogs"></i>
                                <h4> Interdições no SDC</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                <h2 class="display-5">{{ $total_interdicoes[0]['total_interdicoes'] }} </h2>
                                </p>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-6 float-left">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header"><i class="fas fa-cogs"></i>
                                <h4> Interdições Publicadas</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                <h2 class="display-5">{{ $total_publica[0]['total_publica'] }} </h2>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <!-- TOTAL DE VISTORIAS -->
            <div class="row p-3">

                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><i class="fas fa-cogs"></i>
                            <h2> Total de Vistorias</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">
                            <h4 class="display-5 text-center">{{ $total_vistoria }}</h4>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
                {{-- <div class="col-md-6"></div> --}}
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
