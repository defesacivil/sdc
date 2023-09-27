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
    <div class="container min-vh-100">
        <div class="row">

            <div class="col-md-12 p-2">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('/dashboard') }}>Voltar</a>
                    <a class='btn btn-info btn-sm' href={{ url('rat/create') }} title="Criar novo Registro">+ Novo</a>
                    <a class='btn btn-primary btn-sm' id='btnSearch' title="Criar novo Registro">Pesquisa</a>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <a class='btn btn-warning btn-sm' href={{ url('rat/exportRats') }}  title="Criar novo Registro">Exportar Excel</a>
                </p>

                <legend class="p-4">Rat - Relatório de Atividades de Defesa Civil</legend>


            </div>
        </div>
        {{ Form::open(['url' => 'rat/search']) }}

        <div class="row" id="search2">
            <div class="col-md-6 border p-1">
                <div class='row p-2'>
                    <div class='col-md-6'>
                        {{ Form::token() }}
                        {{ Form::label('ano', 'Ano') }} :
                        {{ Form::text('ano', '', ['class' => 'form form-control', 'maxlenght=4', 'id' => 'ano', 'name' => 'ano']) }}
                    </div>
                    <div class='col-md-6'>
                        {{ Form::label('num_ocorrencia', 'Número da Ocorrência') }} :
                        {{ Form::text('num_ocorrencia', '', ['class' => 'form form-control', 'maxlenght=12']) }}
                    </div>
                </div>
                <div class='row p-2'>
                    <div class="col">
                        {{ Form::label('municipio_id', 'Nome do Município') }}:
                        {{ Form::select('municipio_id', $optionMunicipio, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'municipio_id', 'placeholder' => 'Nome do Município', 'data-municipio_id' => '']) }}
                    </div>
                    {{-- <div class='col-md-6 p-2'>
                        {{ Form::label('ocorr_ass', 'Buscar Ocorrências Relacionadas') }} :
                        <div class='form-check'>
                            {{ Form::checkbox('ocorr_ass') }}
                            <label class='form-check-label' for='ocorr_ass'>
                                Sim
                            </label>
                        </div>
                    </div> --}}
                </div>

                <div class='row p-2'>
                    <div class='col-md-6'>
                        {{ Form::label('-', 'Período Inicial') }}:
                        {{ Form::date('data_inicio', '', ['class' => 'form form-control', 'name' => 'data_inicio', 'id' => 'data_inicio']) }}
                    </div>
                    <div class='col-md-6'>
                        {{ Form::label('-', 'Período Final') }}
                        {{ Form::date('data_final', '', ['class' => 'form form-control', 'name' => 'data_final', 'id' => 'data_final']) }}
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-12">
                        {{ Form::label('endereco', 'Endereço da Ocorrência') }}:
                        {{ Form::text('endereco', '', ['class' => 'form form-control', 'id' => 'endereco', 'placeholder' => 'Endereço da Ocorrência', 'maxlength' => '100']) }}
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-12">
                        {{ Form::label('historico', 'Parte do Texto da Ocorrência') }}:
                        {{ Form::text('historico', '', ['class' => 'form form-control', 'id' => 'historico', 'placeholder' => 'Parte do Texto da Ocorrência', 'maxlength' => '110']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-1 border">
                <div class="col-md-12 p-3">
                    {{ Form::label('ocorrencia_id', 'Código Ocorrência') }}:
                    {{ Form::select('ocorrencia_id', $optionOcorrencia, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'ocorrencia_id', 'placeholder' => 'Código da Ocorrência', 'data-ocorrencia_id' => '']) }}
                </div>

                <div class="col-md-12 p-3">
                    {{ Form::label('alvo_id', 'Alvo do Evento') }}:
                    {{ Form::select('alvo_id', $ratAlvo, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'alvo_id', 'placeholder' => 'Alvo da Ocorrencia', 'data-alvo_id' => '']) }}
                </div>

                <div class="col-md-12 p-3">
                    {{ Form::label('cobrade_id', 'Código Cobrade') }}:
                    {{ Form::select('cobrade_id', $optionCobrade, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'cobrade_id', 'placeholder' => 'Código Brasileiro de Desastre', 'data-cobrade_id' => '']) }}
                </div>
                <div class="col-md-12 p-3">
                    {{ Form::label('envolvidos', 'Envolvidos (Opcional - pessoas, empresas, etc)') }}:
                    {{ Form::text('envolvidos', '', ['class' => 'form form-control', 'id' => 'envolvidos', 'placeholder' => 'Envolvidos (Opcional - Pessoas, Empresas, Etc.)', 'maxlength' => '70']) }}
                </div>

                <div class="col-md-12 p-3">
                    {{ Form::label('nome_operacao', 'Nome da Operação') }}:
                    {{ Form::text('nome_operacao', '', ['class' => 'form form-control', 'id' => 'nome_operacao', 'placeholder' => 'Nome da Operação', 'maxlength' => '110']) }}
                </div>
            </div>
            <div class="col-md-12 p-2">
                {{ Form::submit('Busca', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>


        <br><!-- RESUMO-->
        <div class="row p-2">
            <div class="col p-2">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $rats->total() }}</h3>
                        <h3>Total Ocorrências</h3>
                        <p>Total Registros</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col p-2">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $ratChuva }} Registros</h3>
                        <h3>{{ ($ratChuva / $rats->total()) * 100 }} % das Ocorrências</h3>
                        <p>Ocorrência Chuvas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col p-2">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $ratSeca }} Registros</h3>
                        <h3>{{ number_format(($ratSeca / $rats->total()) * 100, 2) }} % das Ocorrências</h3>
                        <p>Ocorrências Seca</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <br><!-- RESUMO CHARTS -->
        <div class="row p-2">
            <div class="col p-2">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ocorrências por Mês</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="ratsAnoCorrente" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 524px;" width="524" height="250" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col p-2">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Ocorrencias por Tipo de Desastre</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="ratsTotal" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 524px;" width="524" height="250" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <br>
        Total Registros : {{ $rats->total() }}
        <div class="table table-responsive table-sm border p-3">
            <h5 class="text-center bolder">Registro das Ocorrências</h5>
            @if (count($rats) > 0)
                <table class="table table-striped
                table-hover	
                table-borderless
                table-primary
                align-middle">
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
                            <tr class="table-primary">
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
                                        <img class="imgDisabled" src='{{ asset('/imagem/icon/editar.png') }}' title="Não é possivel editar esta ocorrência !">
                                    @endif

                                    <a href="{{ url('rat/show/' . $rat->id) }}"><img width="25" src={{ asset('/imagem/icon/view.png') }}></a>
                                </td>
                            </tr>
                        @endForeach

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>


                @if (count($rats) > 0)
                    {{ $rats->links() }}
                @endif
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
    <script type="text/javascript">
        $(document).ready(function() {

            $('.js-example-basic-single').select2();

            $("#search2").hide();

            $("#btnSearch").click(function() {
                $("#search2").toggle('slow');

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



        })
    </script>

    <script>
        const ratsAnoCorrente = document.getElementById('ratsAnoCorrente');
        new Chart(ratsAnoCorrente, {
          type: 'bar',
          data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
              label: '# de Ocorrências',
              data: <?=$chart_ocor_list_ano_corrente;?>,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        const ratsTotal = document.getElementById('ratsTotal');
        new Chart(ratsAnoCorrente, {
          type: 'bar',
          data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
              label: '# of Votes',
              data: '',
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>

@endsection
