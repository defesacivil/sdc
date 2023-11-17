@extends('layouts.pagina_master')

{{-- header --}}
@section('header')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Drrd</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row flex-fill">

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
                <div class="col-12 p-3">
                    <p class='text-center'><a class='btn btn-success' href='{{ url('drrd') }}'>Voltar</a></p><br>
                    <p class="text-center">
                        <legend>Protocolo PAEBM</legend>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="serach">Busca:</label>
                    {{ Form::open(['url' => 'pae/protocolo', 'method' => 'POST']) }}
                    {{ Form::token() }}
                    <div class="input-group mb-3">
                        {{ Form::text('search', '', ['class' => 'form form-control col-md-3']) }}
                        <div class="input-group-append">
                            {{ Form::submit('Pesquisa', ['class' => 'btn btn-outline-secondary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- BUTTON NOVO REGISTRO -->
                    <p class=""><a class="btn btn-primary" href="{{ url('pae/protocolo/create') }}"
                            title="Inserir novo Registro">+ Novo Protocolo</a></p>
                    <p class='text-right'>Total Registros : {{ $protocolos->total() }}</p>
                    <table class="table table-bordered table-sm">
                        <tr>
                            <th>Cod</th>
                            <th>Num. Protocolo</th>
                            <th>Data Entrada</th>
                            <th>Data Limite</th>
                            <th Title="Dias Restantes Para Vencimento Protocolo">Dias Rest.</th>
                            <th>Ccpae</th>
                            <th>Vencimento Ccpae</th>
                            <th>Empreendimento</th>
                            <th>Opções</th>
                        </tr>

                        @foreach ($protocolos as $key => $protocolo)
                            @php
                                $dt_limite = \Carbon\Carbon::parse($protocolo->limite_analise);
                                $dt_entrada = \Carbon\Carbon::parse($protocolo->dt_entrada);
                                $dif = $dt_limite->diffInDays($dt_entrada);
                                
                                $cor = '';
                                $title = '';
                                if ($dif <= 5) {
                                    $cor = 'table-danger';
                                    $title = 'Falta' . $dif . ' dia(s) para o fim da validade deste PAE !';
                                }
                                
                            @endphp
                            <tr>
                                <td class='{{ $cor }}' title='{{ $title }}'>{{ $protocolo->id }}</td>
                                <td class='{{ $cor }}' title='Formato Protocolo = id_empreendedor-id_empreendimento-num_aleatorio_ate_999-data_entrada-(id_protocolo+1)'>
                                    {{ $protocolo->num_protocolo }}</td>
                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ \Carbon\Carbon::parse($protocolo->dt_entrada)->format('d/m/Y H:i:s') }}</td>
                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ \Carbon\Carbon::parse($protocolo->limite_analise)->format('d/m/Y') }}</td>
                                <td class='{{ $cor }}' title='{{ $title }}'>{{ $dif }} dia(s)</td>
                                <td class='{{ $cor }}' title='{{ $title }}'>{{ $protocolo->ccpae }}</td>
                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ !is_null($protocolo->ccpae_venc) ? \Carbon\Carbon::parse($protocolo->ccpae_venc)->format('d/m/Y') : $protocolo->ccpae_venc }}
                                </td>
                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    {{ $protocolo->empreendimento->nome }}</td>

                                <td class='{{ $cor }}' title='{{ $title }}'>
                                    @php
                                        if (true) {
                                            $aviso = "<img width='25' src='" . asset('imagem/icon/aviso.png') . "' title='Exite(m) notificações que estão prestes a vencer verifique !'>";
                                        } else {
                                            $aviso = '';
                                        }
                                    @endphp
                                    {!! $aviso !!}

                                    {{-- $protocolo->getNotificacao(4) --}}
                                    <a href='{{ url('pae/analise/create/' . $protocolo->id) }}'
                                        title='Gerar registro de Análise'><img width='25'
                                            src='{{ asset('imagem/icon/cadastro.png') }}'></a>
                                    <a href='{{ url('pae/protocolo/edit/' . $protocolo->id) }}'><img  width='25' src='{{ asset('imagem/icon/editar.png') }}'></a>
                                    <!--<a onclick="return confirm('Deseja realmente apagar esse Registro !')" href='#'><img  width='25' src='{{ asset('imagem/icon/delete.png') }}'></a>-->
                                    <a href='{{ url('pae/protocolo/show/' . $protocolo->id) }}'><img width='25'
                                            src='{{ asset('imagem/icon/view.png') }}'></a>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7" class='text-center'>
                                {{ $protocolos->links() }}

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







@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
