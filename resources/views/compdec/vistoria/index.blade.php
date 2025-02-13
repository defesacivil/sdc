@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('vistoria/menu') }}">Vistoria - Interdição</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vistoria</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div style="background-color:#e9ecef;" class="container p-3 border">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="pt-4"><a class='btn btn-success btn-sm' href={{ url('vistoria/menu') }}>Voltar</a>
                    <a class='btn btn-info btn-sm' href={{ url('vistoria/create') }} title="Criar novo Registro">+ Novo</a>
                    <a class='btn btn-primary btn-sm' id='btnSearch' title="Criar novo Registro">Pesquisa</a>
                    <span>&nbsp;&nbsp;&nbsp;</span>
                    <a class='btn btn-warning btn-sm' href={{ url('vistoria/exportVistoria') }}  title="Criar novo Registro">Exportar Excel ({{$vistorias->total()}}} - Registros)</a>
                </p>

                <legend class="p-4">Relatório de Vistoria</legend>

                {{ Form::open(['url' => 'vistoria/search']) }}

                <div class="row" id="search2">
                    <div class="p-1 border col-md-6">
                        <div class='p-3 row'>
                            <div class='col-md-6'>
                                {{ Form::token() }}
                                {{ Form::label('ano', 'Ano') }} :
                                {{ Form::text('ano', '', ['class' => 'form form-control', 'id' => 'ano', 'name' => 'ano', 'maxlength'=>'4']) }}
                            </div>
                            <div class='col-md-6'>
                                {{ Form::label('num_vistoria', 'Número da Vistoria') }} :
                                {{ Form::text('num_vistoria', '', ['class' => 'form form-control', 'maxlength'=>'12']) }}
                            </div>
                        </div>
                        <div class='p-3 row'>
                            <div class="col">
                                {{ Form::label('municipio_id', 'Nome do Município') }}:
                                {{ Form::select('municipio_id', $optionMunicipio, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'municipio_id', 'placeholder' => 'Nome do Município', 'data-municipio_id' => '']) }}
                            </div>

                        </div>
        
                        <div class='p-3 row'>
                            <div class='col-md-6'>
                                {{ Form::label('-', 'Período Inicial') }}:
                                {{ Form::date('data_inicio', '', ['class' => 'form form-control', 'name' => 'data_inicio', 'id' => 'data_inicio']) }}
                            </div>
                            <div class='col-md-6'>
                                {{ Form::label('-', 'Período Final') }}
                                {{ Form::date('data_final', '', ['class' => 'form form-control', 'name' => 'data_final', 'id' => 'data_final']) }}
                            </div>
                        </div>
                        
                        {{-- <div class="p-2 row">
                            <div class="col-md-12">
                                {{ Form::label('historico', 'Parte do Texto da Ocorrência') }}:
                                {{ Form::text('historico', '', ['class' => 'form form-control', 'id' => 'historico', 'placeholder' => 'Parte do Texto da Ocorrência', 'maxlength' => '110']) }}
                            </div>
                        </div> --}}
                    </div>
                    <div class="p-1 border col-md-6">
                        {{-- <div class="p-3 col-md-12">
                            {{ Form::label('ocorrencia_id', 'Tipo da Ocorrência') }}:
                            {{ Form::select('ocorrencia_id', $optionOcorrencia, '-', ['class' => 'js-example-basic-single form form-control', 'id' => 'ocorrencia_id', 'placeholder' => 'Código da Ocorrência', 'data-ocorrencia_id' => '']) }}
                        </div> --}}

                        <div class="p-3 col-md-12">
                            {{ Form::label('tp_imovel', 'Tipo do Imóvel') }}:
                            {{ Form::select('tp_imovel', $tp_imovel, '-', ['class' => 'form form-control', 'id' => 'tp_imovel', 'placeholder' => 'Tipo do Imóvel', 'data-tp_imovel' => '']) }}
                        </div>

                        <div class="p-3 col-md-12">
                            {{ Form::label('interdicao', 'Vistorias com Interdições ?') }}:
                            {{ Form::select('interdicao', ['Não', 'Sim'], '-', ['class' => 'form form-control', 'id' => 'interdicao', 'data-interdicao' => '']) }}
                        </div>

                        <div class="p-3 col-md-12">
                            {{ Form::label('endereco', 'Endereço da Vistoria/Interdição') }}:
                            {{ Form::text('endereco', '', ['class' => 'form form-control', 'id' => 'endereco', 'placeholder' => 'Endereço da Ocorrência', 'maxlength' => '100']) }}
                        </div>
               
                        {{-- <div class="p-3 col-md-12">
                            {{ Form::label('cobrade_id', 'Código Cobrade') }}:
                            {{ Form::select('cobrade_id', $optionCobrade, '', ['class' => 'js-example-basic-single form form-control', 'id' => 'cobrade_id', 'placeholder' => 'Código Brasileiro de Desastre', 'data-cobrade_id' => '']) }}
                        </div> --}}
                       
                        
                    </div>
                    <div class="p-2 col-md-12">
                        {{ Form::submit('Busca', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>
                </div>


                <div class="table table-responsive table-sm">
                    <table class="table align-middle table-striped table-hover table-bordered">
                        <thead class="table-light">
                            <caption></caption>
                            <tr>
                                <th style="font-weight:bold">Número<br><br></th>
                                <th style="font-weight:bold">Município</th>
                                <th style="font-weight:bold">Tipo Ocorrência</th>
                                <th style="font-weight:bold">Endereço</th>
                                <th style="font-weight:bold">Data Registro</th>
                                <th style="font-weight:bold">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($vistorias as $key => $vistoria)
                                <tr class="">
                                    <td scope="row">{{ $vistoria->numero }}</td>
                                    <td>{{ $vistoria->municipio }}</td>
                                    <td>{{ $vistoria->tp_ocorrencia }}</td>
                                    <td>{{ $vistoria->endereco }}</td>
                                    <td>{{ \Carbon\Carbon::parse($vistoria->dt_vistoria)->format('d/m/Y H:i:s') }}</td>
                                    <td>

                                        {{-- Tempo para edição  15 dias com aviso: --}}
                                        {{-- @can('compdec') --}}
                                            <a href="{{ url('vistoria/edit/' . $vistoria->id) }}"><img width="25" src={{ asset('/imagem/icon/editar.png') }}></a>
                                        {{-- @endcan --}}
                                            @if ($vistoria->ck_clas_risc_muito_alta == 1)
                                                
                                                {{-- <a href="{{ url('interdicao/show/'.$vistoria->id) }}" title='Termo de Interdição'><img width="25" src={{ asset('/imagem/icon/relatorio.png') }} ></a> --}}
                                            @endif
                                        <a href="{{ url('vistoria/show/' . $vistoria->id) }}"><img width="25" src={{ asset('/imagem/icon/view.png') }}></a>
                                        @can('cedec_redec_delete')
                                    <a href="{{ url('vistoria/destroy/' . $vistoria->id) }}"><img width="25" src={{ asset('/imagem/icon/delete.png') }} onclick="return confirm('Confirma a Exclusão do Registro')"></a>
                                    @endcan
                                    </td>
                                </tr>
                            @endForeach

                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
                {{ $vistorias->links() }}


            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('code')

    <script type="text/javascript">
        $(document).ready(function() {

            $('.js-example-basic-single').select2();

            $("#search2").hide();

            $("#btnSearch").click(function() {
                $("#search2").toggle('slow');

            });



        })
    </script>

@endsection
