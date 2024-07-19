@extends('layouts.pagina_master')

{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @can('cedec', 'redec')
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            @endcan
            <li class="breadcrumb-item active" aria-current="page">Drrd</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            @inject('protocolo', 'App\Models\Drrd\PaeProtocolo')
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
            <div class="row">
                <div class="p-3 col-12">


                    @if (auth()->user()->hasAnyRole(['cedec']))
                        <a class="btn btn-primary" href="{{ url('pae/protocolo/create') }}"
                            title="Inserir novo Registro">+ Novo</a>

                        <a class='btn btn-warning' id="btnShowSearch">Pesquisar</a>
                    @endif
                    <a class='btn btn-success' href='{{ url('drrd') }}'>Voltar</a>
                    <p class="text-center">
                        <legend>Protocolo PAEBM</legend>
                    </p>
                    <i class="text-light bg-danger">Processo Finalizado Encerrado</i>
                    <i class="text-light bg-warning">Prazo de Vencimento Próximo</i>
                </div>
            </div>

            {{-- DIV PESQUISA --}}
            <fieldset class="p-3" id="divsearch">

                <div class="p-2 row">
                    <div class="col-4">
                        <label for="search">Pesquisar: </label> (nome da Barragem ou parte do nome / Nr Protocolo )
                        {{ Form::open(['url' => 'pae/protocolo', 'method' => 'POST']) }}
                        {{ Form::token() }}

                        {{ Form::text('search', '', ['class' => 'form form-control', 'id' => 'search']) }}
                    </div>
                </div>
                <div class="p-2 row" id="dtSearch">
                    <div class="p-2 col-4">
                        <label>Período Inicial Entrada</label>
                        <input type="date" class="form form-control col-6" name="dtInicio" id="dtInicio">
                    </div>
                    <div class="p-2 col-4">
                        <label>Período Final Entrada</label>
                        <input type="date" class="form form-control col-6" name="dtFinal" id="dtFinal">
                    </div>
                </div>
                <div class="p-2 row">
                    <div class="col">
                        {{ Form::submit('Pesquisa', ['class' => 'btn btn-outline-secondary']) }}
                    </div>


                    {{ Form::close() }}
                </div>
            </fieldset>

            <div class="p-2 row">
                <div class="col">
                    <!-- BUTTON NOVO REGISTRO -->

                    <p class='text-right'>Total Registros : {{ $protocolos->count() }}</p>
                    <table class="table table-bordered table-sm" id="listProtocolo" style="font-size: 12px">
                        <tr>
                            <th class="bg-dark text-light" data-prot="145">Protocolo</th>
                            <th class="bg-dark text-light">Nº. Sei</th>
                            <th class="bg-dark text-light">Status</th>
                            <th class="bg-dark text-light">Dt Entrada/Usuário</th>
                            <th class="bg-dark text-light">Data Limite</th>
                            <th class="bg-dark text-light" Title="Dias Restantes Para Vencimento Protocolo">Dias Rest.</th>
                            {{-- <th class="bg-dark text-light">Ccpae</th>
                            <th class="bg-dark text-light">Vencimento Ccpae</th> --}}
                            <th class="bg-dark text-light">Empreendimento</th>
                            <th class="bg-dark text-light">Situação Mancha</th>
                            <th class="bg-dark text-light">Últ Atualização</th>
                            <th class="bg-dark text-light">Opções</th>
                        </tr>

                        @foreach ($protocolos as $key => $protocolo)
                            @php

                                //dd(\Carbon\Carbon::now()->subDays(5));
                                $dt_limite = \Carbon\Carbon::parse($protocolo->limite_analise);
                                $dt_entrada = \Carbon\Carbon::parse($protocolo->dt_entrada);
                                $hoje = \Carbon\Carbon::now();
                                $dif = $hoje > $dt_limite ? '-' . $hoje->diffInDays($dt_limite) : $hoje->diffInDays($dt_limite);

                                $cor = '';
                                $title = '';
                                if ($dif <= 5 && $dif > 0) {
                                    $cor = 'bg-warning';
                                    $title = 'Falta' . $dif . ' dia(s) para o fim da validade deste PAE !';
                                } elseif ($dif < 0) {
                                    $dif = 0;
                                    $cor = 'bg-warning';
                                    $title = 'Protocolo de PAE vencido !';
                                }

                                if ($protocolo->status == 'Finalizado') {
                                    $cor = 'text-light bg-danger';
                                    $title = 'Protocolo Finalizado / Encerrado';
                                }

                            @endphp
                            <tr class="collapse-btn" id="{{ $protocolo->id }}">
                                <td class='{{ $cor }}' title='{{ $title }}'>{{ $protocolo->id }}</td>

                                <td class='{{ $cor }}' title=''>
                                    {{-- <td class='{{ $cor }}' title='Formato Protocolo = id_empreendedor-id_empreendimento-num_aleatorio_ate_999-data_entrada-(id_protocolo+1)'> --}}
                                    {{ $protocolo->sei }}</td>

                                <td class='{{ $cor }}' title='{{ $title }}'>{{ $protocolo->status }} /<br> <span style="font-size: 10; font-style: italic; font-weight: bolder">{{ $protocolo->analista }}</span></td>

                                <td class='{{ $cor }}' title='{{ $title }}'> {{ \Carbon\Carbon::parse($protocolo->dt_entrada)->format('d/m/Y H:i:s') }}
                                    <br>
                                    <span style="font-size: 10; font-style: italic; font-weight: bolder">-</span>
                                </td>

                                <td class='{{ $cor }}' title='{{ $title }}'> {{ \Carbon\Carbon::parse($protocolo->limite_analise)->format('d/m/Y') }}</td>

                                <td class='{{ $cor }}' title='{{ $title }}'>{{ $dif }} dia(s)</td>
                                {{-- <td class='{{ $cor }}' title='{{ $title }}'>{{ $protocolo->ccpae }}</td>
                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ !is_null($protocolo->ccpae_venc) ? \Carbon\Carbon::parse($protocolo->ccpae_venc)->format('d/m/Y') : $protocolo->ccpae_venc }} --}}
                                </td>
                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ $protocolo->empreendimento->nome }} - <b>{{ $protocolo->empreendimento->empreendedor->nome }}</b></td>


                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ $protocolo->sit_mancha }}</td>

                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ $protocolo->user_update }}
                                </td>

                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{-- @php
                                        if (true) {
                                            $aviso = "<img width='20' src='" . asset('imagem/icon/aviso.png') . "' title='Exite(m) notificações que estão prestes a vencer verifique !'>|";
                                        } else {
                                            $aviso = '';
                                        }
                                    @endphp
                                    {!! $aviso !!} --}}

                                    @can('cedec')
                                        {{-- $protocolo->getNotificacao(4) --}}
                                        |<a href='{{ url('pae/analise/create/' . $protocolo->id) }}' title='Gerar registro de Análise'><img width='25' src='{{ asset('imagem/icon/cadastro.png') }}'></a>

                                        {{-- editar --}}
                                        |<a href='{{ url('pae/protocolo/edit/' . $protocolo->id) }}'><img width='20' src='{{ asset('imagem/icon/editar.png') }}'></a>

                                        {{-- Deletar --}}
                                        |<a href='{{ url('pae/protocolo/deletar/' . $protocolo->id) }}' onclick="return confirm('Deseja realmente apagar esse Registro !')"><img width='25' src='{{ asset('imagem/icon/delete.png') }}'></a>

                                        {{-- Encerrar --}}
                                        |<a onclick="return confirm('Deseja realmente Encerrar esse protocolo ?')" href='{{ url('pae/protocolo/encerrar/' . $protocolo->id) }}'><img width='25' src='{{ asset('imagem/icon/icon_deletar.png') }}'></a>
                                    @endcan
                                    {{-- show --}}
                                    |<a href='{{ url('pae/protocolo/show/' . $protocolo->id) }}'><img width='20' src='{{ asset('imagem/icon/view.png') }}'></a>

                                    {{-- notificações --}}
                                    {{-- |<a href='{{ url('pae/protocolo/show/' . $protocolo->id) }}'><img width='20' src='{{ asset('imagem/icon/view.png') }}'></a>| --}}

                                </td>
                            </tr>

                            <!---->
                            <tr class='{{ $cor }} collapse' title='{{ $title }}'>
                                <td colspan="10">
                                    <div class="row border">
                                        <div class="col-12">
                                            <p class="text-center font-weight-bold">Análise Técnica PAE</p>
                                            <table class="table table-sm table-bordered" style="font-size: 10px">
                                                <tr>
                                                    <th class="table-dark text-center">#</th>
                                                    <th class="table-dark text-center">Data</th>
                                                    <th class="table-dark text-center">Status</th>
                                                    <th class="table-dark text-center">Obs</th>
                                                    <th class="table-dark text-center">Usuário</th>
                                                    <th class="table-dark text-center">Notificações</th>
                                                </tr>


                                                @foreach ($protocolo->analises as $key => $analise)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $analise->dt_analise }}</td>
                                                        <td>{{ $analise->status }}</td>
                                                        <td>{{ $analise->obs }}</td>
                                                        <td>{{ $analise->user_id }}</td>
                                                        <td>
                                                            @if (count($analise->notificacoes) > 0)
                                                                <table class="table-bordered">
                                                                    <tr class="text-light bg-dark">
                                                                        <td class="text-center">#</td>
                                                                        <td class="text-center">Data</td>
                                                                        <td class="text-center">Dt. Devolutiva</td>
                                                                        <td class="text-center">Sei</td>
                                                                    </tr>
                                                                    @foreach ($analise->notificacoes as $key1 => $notificacao)
                                                                        <tr>
                                                                            <td>
                                                                                {{ $key1 + 1 }}
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalNotificacao{{ $notificacao->id }}">{{ \Carbon\Carbon::parse($notificacao->dt_notificacao)->format('d/m/Y H:i:s') }}</button>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalNotificacao{{ $notificacao->id }}">{{ \Carbon\Carbon::parse($notificacao->dt_devolutiva)->format('d/m/Y H:i:s') }}</button>
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#modalNotificacao{{ $notificacao->id }}">{{ $notificacao->num_sei }}</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </table>
                                        </div>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="10" class='text-center'>
                                {{ $protocolos->appends(request()->all())->links() }}

                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col"></div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalNotificacao1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notificação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="showNotificacao"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('code')
    <script>
        $(document).ready(function() {

            $("#divsearch").hide();

            $("#btnShowSearch").click(function() {
                $("#divsearch").toggle();
            });

            //$(".default_col").addClass('collapsed');

            $(".collapse-btn").dblclick(function() {
                var targetId = $(this).attr("id");
                $(this).closest("tr").next("tr").toggle('slow');

            });

        });
    </script>
@stop
