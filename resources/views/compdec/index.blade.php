@extends('layouts.pagina_master')

{{-- header --}}
@section('breadcrumb')

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


        <!-- INICIO BODY -->
        <div class="row p-3">

            @hasrole('cedec')
            <div class="col divbuscar border border-secondary rounded">

                    {{ Form::open(['url' => 'compdec']) }}
                    {{ Form::token() }}
                    <br>
                    {{ Form::label('txtBusca', 'Pesquisar Município') }} :
                    {{ Form::text('txtBusca', '', ['class' => 'form form-control form-control-sm']) }}
                    <br>

                    {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary btn-sm']) }}

                    {{ Form::close() }}

                    <br>

                @endhasrole
                

            </div>
            <div class="row p-3">

            @can('cedec')

                @if (isset($compdecs))
                        <div class="col text-center">

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

                                        <td>{{ \Carbon\Carbon::parse($compdec->updated_at)->format('d/m/Y H:i:s') }}</td>
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
                <div class="row p-3">

                    {{-- Com Compdec --}}
                    <div class="col">
                        <div class="card mx-auto text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">COMPDEC ATIVAS</div>
                            <div class="card-body">
                                <h4>
                                    <p class="text-center">{{ $ativa }} <br> {{ number_format(($ativa / 853) * 100, 1) }}%</p>
                                </h4>
                            </div>
                        </div>
                    </div>


                    {{-- Sem compodec --}}
                    <div class="col">
                        <div class="card mx-auto text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">COMPDEC INATIVAS</div>
                            <div class="card-body">
                                <h4>
                                    <p class="text-center">{{ $inativa }} <br> {{ number_format(($inativa / 853) * 100, 1) }}%</p>
                                </h4>
                            </div>
                        </div>
                    </div>


                    {{-- Plancom --}}
                    <div class="col">
                        <div class="card ms-auto text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">PLANO DE CONTINGÊNCIA</div>
                            <div class="card-body">
                                <h4>
                                    <p class="text-center">{{ $plancon }} <br> {{ number_format(($plancon / 853) * 100, 1) }}%</p>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- NupDec --}}
                    <div class="col text-center">
                        <div class="card mx-auto text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">MUNICÍPIOS COM NUPDEC</div>
                            <div class="card-body">
                                <h4>
                                    <p class="text-center">{{ $nupdec }} <br> {{ number_format(($nupdec / 853) * 100, 1) }}%</p>
                                </h4>
                            </div>
                        </div>
                    </div>

                    {{-- NupDec --}}
                    <div class="col text-center">
                        <div class="card mx-auto text-white bg-success mb-3" style="max-width: 18rem;">
                            <div class="card-header">TOTAL NUPDEC</div>
                            <div class="card-body">
                                <h4>
                                    <p class="text-center">{{ $totalNupdec }} <br>&nbsp;</p>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

    </div>
    </div>
    {{-- <div class="row" id="divrelatorio">
        <div class="col-12">
            Relatorios
        </div>
    </div> --}}

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


            $(".divbuscar").hide();
            //$("#divrelatorio").hide();


            $('#buscar').click(function() {
                $(".divbuscar").toggle();
            });


        });
    </script>

@stop
