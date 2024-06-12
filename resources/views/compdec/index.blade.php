@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Compdec</li>
        </ol>
    </nav>

@endsection

@section('content')
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
    <div class="container p-3 border min-vh-100" style="background-color:#e9ecef;">
        @can('cedec')
            <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p><br>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary btn-sm" id='buscar'>Busca Registro</button>
                    <button type="button" class="btn btn-primary btn-sm">Relatorios</button>
                </div>
            </div>
        @endcan

        <div class="row ">

            <div class="col-md-6 divbuscar">

                @can('cedec')
                    {{ Form::open(['url' => 'compdec']) }}
                    {{ Form::token() }}
                    <br>
                    {{ Form::label('txtBusca', 'Buscar Município Compdec') }} :
                    {{ Form::text('txtBusca', '', ['class' => 'form form-control form-control-sm']) }}
                    <br>

                    {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary btn-sm']) }}

                    {{ Form::close() }}

                    <br>
                @endcan

            </div>

            @can('cedec')

                @if (isset($compdecs))
                    <div class="row p-3">
                        <div class="col">

                            <table class='table table-bordered table-sm table-striped'>
                                <tr>
                                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Cod<br></th>
                                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Municipio</th>
                                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Situação</th>
                                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Ultima Atualização</th>
                                    <th style="font-weight: bold; background-color: lightslategrey; text-align: center">Opções</th>
                                </tr>
                                @foreach ($compdecs as $compdec)
                                    <tr>
                                        <td>{{ $compdec->id }}</td>
                                        <td>{{ $compdec->id_municipio . ' - ' . $compdec->nome }}</td>
                                        <td>{{ $compdec->com_ativa == 0 ? 'Inativa' : 'Ativo' }}</td>

                                        <td>{{ \Carbon\Carbon::parse($compdec->ultimo_atualiza)->format('d/m/Y H:i:s') }}</td>
                                        <td>
                                            <a href='{{ url('compdec/edit', ['id' => $compdec->id]) }}' title="Clique aqui para editar o Registro !"><img
                                                    src='{{ asset('/imagem/icon/editar.png') }}' alt=""></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>




                    </div>
                @endif
                <div class="row">

                    {{-- Com Compdec --}}
                    <div class="col text-center">
                        <h class="text-primary">Municípios com COMPDEC</h>
                        <h4 class="text-primary">{{ $ativa }} / {{ number_format(($ativa / 853) * 100, 1) }}%</h4>
                    </div>

                    {{-- Sem compodec --}}
                    <div class="col text-center">
                        <h class="text-danger">Municípios Sem COMPDEC</h>
                        <h4 class="text-danger">{{ $inativa }} / {{ number_format(($inativa / 853) * 100, 1) }}%</h4>
                    </div>

                    {{-- Plancom --}}
                    <div class="col text-center">
                        <h>Municípios PlanCon</h>
                        <h4>{{ $plancon }} / {{ number_format(($plancon / 853) * 100, 1) }}%</h4>
                    </div>
                    <br>
                </div>
                <hr>
                <div class="row">
                    {{-- NupDec --}}
                    <div class="col text-center">
                        <h>Municípios Com Nupdec</h>
                        <h4>{{ $nupdec }} / {{ number_format(($nupdec / 853) * 100, 1) }}%</h4>
                    </div>
                    <div class="col text-center">
                        <h>Quantidade Total de Nupdec</h>
                        <h4>{{ $totalNupdec }} </h4>
                    </div>
                </div>

            </div>
        @endcan

    </div>
    </div>
    <div class="row" id="divrelatorio">
        <div class="col-12">
            Relatorios
        </div>
    </div>

    @can('cedec')
        {{-- <div class="p-3 row div">
        <div class="col">
            <select name="selChart" class="form-control form-control-lg col-5" id="selChart">
                <option>Situação das Coordenadorias Municipais de Defesa Civil</option>
                <option>Municípios com Plano de Contingência</option>
                <option>Municípios com Mapeamento de Área de Risco</option>
            </select>
        </div>
    </div> --}}





        <hr>
        <div class="row">
            <div class="col">
                <div class="col">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    @endcan

    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('code')
    <script src="{{ url('js/chart/Chart.js') }}"></script>
    <script src="{{ url('js/chartjs-datalabels/chartjs-plugin-datalabels.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {


            //$(".divbuscar").hide();
            //$("#divrelatorio").hide();


            $('#buscar').click(function() {
                $(".divbuscar").toggle();
            });


        });
    </script>

@stop
