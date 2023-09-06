@extends('layouts.pagina_master')
{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/pae/protocolo') }}">Protocolo</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualização</li>
        </ol>
    </nav>
@endsection

<style>
    @media print {

        .btn {
            display: none;
        }

        * {
            background-color: white !important;
        }


        .col-sm-12 {
            width: 100%;
        }

        .col-sm-11 {
            width: 91.66666667%;
        }

        .col-sm-10 {
            width: 83.33333333%;
        }

        .col-sm-9 {
            width: 75%;
        }

        .col-sm-8 {
            width: 66.66666667%;
        }

        .col-sm-7 {
            width: 58.33333333%;
        }

        .col-sm-6 {
            width: 50%;
        }

        .col-sm-5 {
            width: 41.66666667%;
        }

        .col-sm-4 {
            width: 33.33333333%;
        }

        .col-sm-3 {
            width: 25%;
        }

        .col-sm-2 {
            width: 16.66666667%;
        }

        .col-sm-1 {
            width: 8.33333333%;
        }
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />


@section('content')

    <div class="row flex-fill">
        <div class="col-md-12">

            <div class="row">
                <div class="col p-3">
                    <p class='text-center'><a class='btn btn-success' href='{{ url('pae/protocolo') }}'>Voltar</a></p><br>
                    <legend>PROTOCOLO PABM</legend>
                </div>
            </div>
            <div class="row">
                <div class='col-md-3'>
                    <div id="jstree_div">
                        <ul>
                            <li id="protocolo_info" data-jstree='{"opened":true,"selected":true}'>Protocolo :
                                {{ $protocolos[0]->num_protocolo }}</li>

                            <li id="analise">Análise - Qtd : <b>{{ count($protocolos[0]->analises) }}</b></li>

                            {{-- <li id="notificacao">Notificações </li> --}}
                        </ul>

                    </div>
                </div>


                <div class='col-md-9'>
                    <div class="row border border-primary" id="show_dados_protocolo">
                        <!-- DADOS DO PROTOCOLO -->
                        <legend>INFORMAÇÕES PROTOCOLO</legend>
                        <div class="col">
                            <table class="table table-primary table-bordered table-sm">
                                <tr>
                                    <th class="">CÓDIGO:</th>
                                    <td class="">{{ $protocolos[0]->id }}</td>
                                </tr>
                                <tr>
                                    <th class="">USUÁRIO:</th>
                                    <td>{{ $protocolos[0]->usuario->name }}</td>
                                </tr>
                                <tr>
                                    <th>PROTOCOLO:</th>
                                    <td>{{ $protocolos[0]->num_protocolo }}</td>
                                </tr>
                                <tr>
                                    <th>DATA ENTRADA:</th>
                                    <td>{{ \Carbon\Carbon::parse($protocolos[0]->dt_entrada)->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>EMPREENDEDOR:</th>
                                    <td>{{ $protocolos[0]->empreendimento->empreendedor->nome }}</td>
                                </tr>
                                <tr>
                                    <th>LIMITE ANÁLISE:</th>
                                    <td>{{ $protocolos[0]->limite_analise }}</td>
                                </tr>
                                <tr>
                                    <th>EMPREENDIMENTO:</th>
                                    <td>{{ $protocolos[0]->empreendimento->nome }}</td>
                                </tr>
                                <tr>
                                    <th>CCPAE:</th>
                                    <td>{{ $protocolos[0]->ccpae }}</td>
                                </tr>
                                <tr>
                                    <th>CCPAE VENCIMENTO</th>
                                    <td>
                                        @php
                                            $venc_ccpae = !empty($protocolos[0]->ccpae_venc) ? \Carbon\Carbon::parse($protocolos[0]->ccpae_venc)->format('d/m/Y') : '';
                                        @endphp
                                        {{ $venc_ccpae }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>OBS:</th>
                                    <td>{{ $protocolos[0]->obs }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <div class="row border border-primary">
                        <div class='col' id='show_analise'>
                            <!-- ANALISES -->
                            <legend>ANÁLISE</legend>
                            @foreach ($protocolos[0]->analises as $key => $analise)
                                {{-- <div class="row"> --}}
                                {{-- <div class="col"> --}}
                                <hr>
                                <table class="table table-primary table-sm">

                                    <tr>
                                        <td class="col-sm-1" rowspan="8"># {{ $analise->id }}
                                            <br>
                                            <a href="{{ url('pae/analise/edit/' . $analise->id) }}"
                                                title="Editar Registro de Análise nº {{ $key + 1 }}">
                                                <img src='{{ asset('imagem/icon/editar.png') }}'>
                                            </a>
                                            <br>
                                            <a href="{{ url('pae/analise/delete/' . $analise->id) }}"
                                                onclick="if (confirm('Tem certeza que deseja deletar esse registro ?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                title="Remover Análise nº {{ $key + 1 }}">
                                                <img src='{{ asset('imagem/icon/delete.png') }}'>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=""><b>CÓDIGO : </b>{{ $analise->id }} - {{ \Carbon\Carbon::parse($analise->created_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>ANALISTA : </b>{{ $analise->usuario->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>FASE :</b>{{ $analise->tipo == 1 ? ' FASE 1' : 'FASE 2' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>OBS :</b><br>{{ $analise->obs }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>PARECER :</b><br>{!! $analise->parecer !!}</td>
                                    </tr>
                                    <tr>
                                        <td><b>ANEXOS :</b>
                                            @php
                                                $anexos = Storage::AllFiles('public/uploads');
                                                foreach ($anexos as $key => $anexo) {
                                                    $nomeArquivo = Str::substr($anexo, 15);
                                                    $id_analise = Str::substr($nomeArquivo, 0, strpos($nomeArquivo, '-'));
                                                    if ($id_analise == $analise->id) {
                                                        print "<a href='" . url('pae/analise/download/' . $nomeArquivo) . "'>" . $nomeArquivo . '</a><br>';
                                                    }
                                                }
                                                
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- NOTIFICACOES  -->
                                            <table class="table table-secondary border border-primary">

                                                @foreach ($analise->notificacoes as $key1 => $notificacao)
                                                    <tr>
                                                        <td rowspan="8" class="col-sm-1">Notificação
                                                            #{{ $key1 + 1 }}
                                                            <a href='{{ url('pae/notificacao/edit/' . $notificacao->id) }}'
                                                                class='btn btn-primary'
                                                                title="Editar Registro de Análise nº {{ $key1 + 1 }}">Editar</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>ANALISTA : </b>{{ $notificacao->usuario->name }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>CÓDIGO :</b>{{ $notificacao->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>SEI : </b>{{ $notificacao->num_sei }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>DATA NOTIFICAÇÃO :</b>
                                                            {{ \Carbon\Carbon::parse($notificacao->dt_notificacao)->format('d/m/Y H:i:s') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>PRORROGAÇÃO :</b>
                                                            {{ $notificacao->prorrogacao == 0 ? 'Não' : 'Sim' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>DATA DEVOLUTIVA :</b>
                                                            {{ \Carbon\Carbon::parse($notificacao->dt_devolutiva)->format('d/m/Y H:i:s') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>OBSERVAÇÃO :</b><br> {{ $notificacao->obs }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td colspan="2">
                                                        <a href='{{ url('pae/notificacao/create/' . $analise->id) }}'
                                                            class='btn btn-success'
                                                            title='Lancar notificação para esta registro de Análise'>Add
                                                            Notificação</a>
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                {{-- </div> --}}
                                {{-- </div> --}}
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


    <script type="text/javascript">
        $(function() {
            $('#jstree_div').jstree();
        });



        $(document).ready(function() {
            $("#show_dados_protocolo").hide();
            $("#show_analise").hide();


            $('#jstree_div').on("changed.jstree", function(e, data) {

                if (data.selected == 'protocolo_info') {
                    $("#show_dados_protocolo").fadeToggle();
                    $("#show_analise").hide();
                } else if (data.selected == 'analise') {
                    $("#show_analise").fadeToggle();
                    $("#show_dados_protocolo").hide();
                }
            });


            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "showDuration": "800",
            }
            @if (session('message'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "showDuration": "600",
                }
                toastr.success("{{ session('message') }}");
            @endif
            @if ($errors->any())

                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}")
                @endforeach
            @endif

        });
    </script>
@stop
