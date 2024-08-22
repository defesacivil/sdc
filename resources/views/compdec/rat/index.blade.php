@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rat</li>
        </ol>
    </nav>
@endsection


@section('content')

    <div class="row">
        <div class="col text-center">
            <legend class="p-4">Rat - Relatório de Atividades de Defesa Civil</legend>
        </div>
    </div>
    <div style="background-color:#e9ecef;" class="container min-vh-100">
        <div class="row">
            <div class="border col-md-12">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('/dashboard') }}>Voltar</a>
                    <a class='btn btn-info btn-sm' href={{ url('rat/create') }} title="Criar novo Registro">+ Novo</a>
                    <a class='btn btn-primary btn-sm' id='btnSearch' title="Criar novo Registro">Pesquisa</a>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <a class='btn btn-warning btn-sm' href={{ url('rat/config') }} title="Criar novo Registro">Configurações</a>
                </p>
            </div>
        </div>


        {{-- @can('cedec')

            <div class="row filtro">
                <div class="col-4">
                    <label>Filtro :</label>
                    <select class="form-select form-select-sm" id="filt_chartjs">
                        <option value="todos">Visualizar Todos</option>
                        <option value="secaChuva">Quantitativo por Seca Chuva</option>
                        <option value="porRegiao">Quantitativo por Região de DC</option>
                        <option value="porOcorrencia">Quantitativo por Codificação de Ocorrência</option>
                        <option value="porMes">Quantitativo por Mês</option>
                    </select>
                </div>
            </div>
            <div class="row chartjsVis">
                <div class="col">&nbsp;</div>
                <div class="col">
                    <table class="table table-bordered">
                        <tr>
                            <td colspan="2" class="text-center">Resumo</td>
                        </tr>
                        <tr>
                            <td>Total Registros :</td>
                            <td>{{ $rats->total() }}</td>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                </div>
                <div class="col">&nbsp;</div>
            </div>
            <div class="row chartjsVis text-center">
                <!-- Chuva e Estiagem -->

                <div class="p-3">
                    <canvas id="secaChuva" width="300" height="300" class="border rounded bg-light p-3"></canvas>
                </div>
                <hr>
            </div>


            @if (!get_defined_vars()['search'])
                <div class="row chartjsVis">
                    <!-- por região -->
                    <div class="col p-3">
                        <canvas id="porRegiao" class="border rounded"></canvas>
                    </div>
                    <hr>
                </div>


                <!-- DIVIDIDO ATE 15 POR CODIGO-->
                <div class="row chartjsVis">
                    <div class="col text-center" style="height:40vh;">
                        <canvas id="porOcorrencia15" class="border rounded"></canvas>
                    </div>
                    <hr>
                </div>

                <!-- DIVIDIDO MAIS 15 POR CODIGO-->
                <div class="row chartjsVis">
                    <div class="col text-center" style="height:40vh;">
                        <canvas id="porOcorrencia" class="border rounded"></canvas>
                    </div>
                    <hr>
                </div>

                <div class="row chartjsVis">
                    <div class="col">
                        <canvas id="porMes" class="border rounded"></canvas>
                    </div>
                </div>
            @endif
        @endcan --}}




        {{ Form::open(['url' => 'rat/search']) }}

        <div class="row" id="search2">
            <div class="p-1 col-md-6">
                <div class='p-2 row'>
                    <div class='col-md-6'>
                        {{ Form::token() }}
                        {{ Form::label('ano', 'Ano') }} :
                        {{ Form::number('ano', '', ['class' => 'form form-control', 'maxlenght=4', 'id' => 'ano', 'name' => 'ano']) }}
                    </div>
                    <div class='col-md-6'>
                        {{ Form::label('num_ocorrencia', 'Número da Ocorrência') }} :
                        {{ Form::text('num_ocorrencia', '', ['class' => 'form form-control', 'maxlenght=12']) }}
                    </div>
                </div>

                <div class='p-2 row'>
                    <div class="col-md-12">
                        {{ Form::label('municipio_id', 'Nome do Município') }}:
                        {{ Form::select('municipio_id', $optionMunicipio, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'municipio_id', 'placeholder' => 'Nome do Município', 'data-municipio_id' => '']) }}
                    </div>
                </div>

                <div class='p-2 row'>
                    <div class='col-md-6'>
                        {{ Form::label('data_inicio', 'Período Inicial') }}:
                        {{ Form::date('data_inicio', '', ['class' => 'form form-control', 'name' => 'data_inicio', 'id' => 'data_inicio']) }}
                    </div>
                    <div class='col-md-6'>
                        {{ Form::label('data_final', 'Período Final') }}
                        {{ Form::date('data_final', '', ['class' => 'form form-control', 'name' => 'data_final', 'id' => 'data_final']) }}
                    </div>
                </div>
                <div class="p-2 row">
                    <div class="col-md-12">
                        {{ Form::label('endereco', 'Endereço da Ocorrência') }}:
                        {{ Form::text('endereco', '', ['class' => 'form form-control', 'id' => 'endereco', 'placeholder' => 'Endereço da Ocorrência', 'maxlength' => '100']) }}
                    </div>
                </div>
                <div class="p-2 row">
                    <div class="col-md-12">
                        {{ Form::label('historico', 'Parte do Texto da Ocorrência') }}:
                        {{ Form::text('historico', '', ['class' => 'form form-control', 'id' => 'historico', 'placeholder' => 'Parte do Texto da Ocorrência', 'maxlength' => '110']) }}
                    </div>
                </div>
                @can('cedec')
                    <div class="p-2 row">
                        <div class="col-md-12">
                            {{ Form::label('operador_id', 'Nome do Operador') }}:
                            {{ Form::text('operador_id', '', ['class' => 'form form-control', 'id' => 'historico', 'placeholder' => 'Parte do Nome do Operador', 'maxlength' => '70']) }}
                        </div>
                    </div>
                @endcan
            </div>
            <div class="p-1 border col-md-6">
                <div class="p-2 col-md-12">
                    {{ Form::label('ocorrencia_id', 'Código Ocorrência') }}:
                    {{ Form::select('ocorrencia_id', $optionOcorrencia, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'ocorrencia_id', 'placeholder' => 'Código da Ocorrência', 'data-ocorrencia_id' => '']) }}
                </div>

                <div class="p-2 col-md-12">
                    {{ Form::label('alvo_id', 'Alvo do Evento') }}:
                    {{ Form::select('alvo_id', $ratAlvo, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'alvo_id', 'placeholder' => 'Alvo da Ocorrencia', 'data-alvo_id' => '']) }}
                </div>

                <div class="p-2 col-md-12">
                    {{ Form::label('cobrade_id', 'Código Cobrade') }}:
                    {{ Form::select('cobrade_id', $optionCobrade, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'cobrade_id', 'placeholder' => 'Código Brasileiro de Desastre', 'data-cobrade_id' => '']) }}
                </div>
                <div class="p-2 col-md-12">
                    {{ Form::label('envolvidos', 'Envolvidos (Opcional - pessoas, empresas, etc)') }}:
                    {{ Form::text('envolvidos', '', ['class' => 'form form-control', 'id' => 'envolvidos', 'placeholder' => 'Envolvidos (Opcional - Pessoas, Empresas, Etc.)', 'maxlength' => '70']) }}
                </div>

                <div class="p-2 col-md-12">
                    {{ Form::label('nome_operacao', 'Nome da Operação') }}:
                    {{ Form::text('nome_operacao', '', ['class' => 'form form-control', 'id' => 'nome_operacao', 'placeholder' => 'Nome da Operação', 'maxlength' => '110']) }}
                </div>
            </div>
            <div class="p-2 col-md-12">
                {{ Form::submit('Busca', ['class' => 'btn btn-primary']) }}
                
                {{ Form::close() }}
            </div>
        </div>


        <br>
        <p class="p-2">Registros : {{ count($rats) }}</p>

        <div class="table p-3 border table-responsive">
            <a class='btn btn-warning btn-sm' href={{ url('rat/exportRats') }} title="Exportar em formato Excel">Exportar Excel</a>
            <h5 class="text-center bolder">Registro das Ocorrências</h5>
            @if (count($rats) > 0)
                <table class="table align-middle table-striped table-bordered table-sm table-hover">
                    <thead class="table-light">
                        <caption></caption>
                        <tr>
                            <th class="p-2">Número</th>
                            <th class="p-2">Município</th>
                            <th class="p-2">Cobrade</th>
                            <th class="p-2">Endereço</th>
                            <th class="p-2">Data Ocorrencia</th>
                            <th class="p-2">Operador</th>
                            <th class="p-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($rats as $key => $rat)
                            <tr class="">
                                <td scope="row">{{ $rat->num_ocorrencia }}</td>
                                <td>{{ $rat->nome }}</td>
                                <td>{{ $rat->cobrade }}</td>
                                <td>{{ $rat->endereco }}</td>
                                <td>{{ \Carbon\Carbon::parse($rat->dt_ocorrencia)->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $rat->operador_nome }}</td>
                                <td>
                                    @if ($rat->operador_id == Auth::user()->id)
                                        <a href="{{ url('rat/edit/' . $rat->id) }}"><img width="25" src={{ asset('/imagem/icon/editar.png') }}></a>
                                    @else
                                        <img class="imgDisabled" src='{{ asset('/imagem/icon/editar.png') }}' title="Não é possivel editar esta ocorrência !, pois ela foi criada por outro usuário !">
                                    @endif

                                    <a href="{{ url('rat/show/' . $rat->id) }}"><img width="25" src={{ asset('/imagem/icon/view.png') }}></a>
                                </td>
                            </tr>
                        @endForeach

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

                    {{ $rats->appends(request()->all())->links() }}
            @else
                <p class="alert alert-danger">Sua pesquisa não encontrou nenhum registro</p>
            @endif
        </div>
        <br>
        <div class="row">
            <div class="col">
            </div>
        </div>
    </div>
    </div>

@stop

@section('css')

@stop

@section('code')

    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            Chart.register(ChartDataLabels);


            //$(".filtro").hide();

            //$(".chartjsVis").hide();

            /* Filtro Chartsj */
            $("#filt_chartjs").change(function() {

                let opcao = $(this).find(":selected").val();

                //$(".chartjsVis").hide();

                $("#" + opcao).toggle();

            });

            $('.js-example-basic-single').select2();

            /* busca*/
            $("#search2").hide();

            $("#btnSearch").click(function() {
                $("#search2").toggle('slow');
                //$(".chartjsVis").toggle('hide');
                //$('#btnSearch').css('display', 'none');

            });

            $('#btnPesquisa').click(function() {
                $.ajax({
                    type: 'POST',
                    url: '{{ url('') }}',
                    data: '_token = <?php echo csrf_token(); ?>',
                    success: function(data) {
                        $("#msg").html(data.msg);
                    }
                });
            });





            const ctx = document.getElementById('secaChuva');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Estiagem', 'Chuvas', 'Chuvas Intensas'],
                    datasets: [{
                        label: '',
                        data: [{{ $ratSeca }}, {{ $ratChuva }}],
                        borderWidth: 2,
                        datalabels: {
                            align: 'center',
                            anchor: 'center'
                        }
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        customCanvasBackgroundColor: {
                            color: 'lightGreen',
                        },
                        title: {
                            display: true,
                            text: 'QUANTITATIVO RAT - CHUVA E ESTIAGEM',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                        },
                    }
                }
            });



            /* relatorio por regiões DC*/
            var jsonRegiao = @json($porRegiao);

            var lb_regiao = jsonRegiao.file.map(function(e) {
                return e.id_rpm + " RPM";
            });
            var dt_regiao = jsonRegiao.file.map(function(e) {
                return e.total;
            });

            /* por município */
            const porRegiao = document.getElementById('porRegiao');

            new Chart(porRegiao, {
                type: 'bar',
                data: {
                    labels: lb_regiao,
                    datasets: [{
                        label: '',
                        data: dt_regiao,
                        borderWidth: 2,
                        datalabels: {
                            align: 'end',
                            anchor: 'end'
                        }
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'RAT´s POR REGIÃO DE DEFESA CIVIL',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                        },
                    }
                }
            });


            /* relatorio por OCORRÊNCIA DC ATE 15 */
            var jsonOcorrencia15 = @json($porOcorrencia15);

            var lb_ocorrencia15 = jsonOcorrencia15.file.map(function(e) {
                return e.cod;
            });

            var lb_tooltip15 = jsonOcorrencia15.file.map(function(e) {
                return e.descricao;
            });
            var dt_ocorrencia15 = jsonOcorrencia15.file.map(function(e) {
                return e.qtd15;
            });

            /* por ocorrencia */
            const porOcorrencia15 = document.getElementById('porOcorrencia15');

            new Chart(porOcorrencia15, {
                type: 'bar',
                data: {
                    labels: lb_ocorrencia15,
                    tooltipText: lb_tooltip15,
                    datasets: [{
                        label: '',
                        data: dt_ocorrencia15,
                        borderWidth: 2,
                        datalabels: {
                            align: 'end',
                            anchor: 'end'
                        }
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: true,
                            usePointStyle: true,
                            callbacks: {
                                // To change title in tooltip
                                title: (data) => {
                                    return lb_tooltip15[data[0].dataIndex];

                                },
                            },
                        },
                        title: {
                            display: true,
                            text: 'QUANTIDADE RAT´s AGRUPADOS POR OCORRÊNCIA ATÉ 15 REGISTROS POR CÓDIGO',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                        },
                    }
                }
            });


            /* relatorio por OCORRÊNCIA DC com mais de 15 relatorios */
            var jsonOcorrencia = @json($porOcorrencia);

            var lb_ocorrencia = jsonOcorrencia.file.map(function(e) {
                return e.cod;
            });

            var lb_tooltip = jsonOcorrencia.file.map(function(e) {
                return e.descricao;
            });
            var dt_ocorrencia = jsonOcorrencia.file.map(function(e) {
                return e.qtd;
            });

            /* por ocorrencia */
            const porOcorrencia = document.getElementById('porOcorrencia');

            new Chart(porOcorrencia, {
                type: 'bar',
                data: {
                    labels: lb_ocorrencia,
                    tooltipText: lb_tooltip,
                    datasets: [{
                        label: '',
                        data: dt_ocorrencia,
                        borderWidth: 2,
                        datalabels: {
                            align: 'end',
                            anchor: 'end'
                        }
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: true,
                            usePointStyle: true,
                            callbacks: {
                                // To change title in tooltip
                                title: (data) => {
                                    return lb_tooltip[data[0].dataIndex];

                                },
                            },
                        },
                        title: {
                            display: true,
                            text: 'QUANTIDADE RAT´s AGRUPADOS POR OCORRÊNCIA COM MAIS DE 15 REGISTROS POR CÓDIGO',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                        },
                    }
                }
            });


            /* relatorio por OCORRÊNCIA DC cpor mes */
            var jsonMes = @json($porMes);

            var lb_mes = jsonMes.file.map(function(e) {
                return e.mes;
            });

            var lb_tool_mes = jsonMes.file.map(function(e) {
                return e.mes;
            });
            var dt_qtd_mes = jsonMes.file.map(function(e) {
                return e.total;
            });

            /* por ocorrencia */
            const porMes = document.getElementById('porMes');

            new Chart(porMes, {
                type: 'bar',
                data: {
                    labels: lb_mes,
                    tooltipText: lb_tool_mes,
                    datasets: [{
                        label: '',
                        data: dt_qtd_mes,
                        borderWidth: 2,
                        datalabels: {
                            align: 'end',
                            anchor: 'end'
                        }
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        tooltip: {
                            enabled: true,
                            usePointStyle: true,
                            callbacks: {
                                // To change title in tooltip
                                title: (data) => {
                                    return lb_tool_mes[dt_qtd_mes[0].dataIndex];

                                },
                            },
                        },
                        title: {
                            display: true,
                            text: 'QUANTIDADE RAT´s AGRUPADOS POR MÊS NO ANO DE 2023',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                        },
                    }
                }
            });


        })
    </script>


@endsection
