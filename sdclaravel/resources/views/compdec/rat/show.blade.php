@extends('layouts.pagina_master')

{{-- header --}}
@section('header')
    <style>
        @media print {
            #breadcrumb {
                display: none;
            }

            #btn {
                display: none;
            }
        }
    </style>

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" id="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('rat') }}">Rat</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="container">


        
        {{-- <div class="row flex-fill m-4">
            <div class="flex-fill logo"></div>
            <div class="flex-fill logo">
                <img class="logo" width="100" src="{{ url('/imagem/DEFESACIVILMG_400.png') }}" alt="">
            </div>
            <div class="flex-fill logo"></div>
            <div class="flex-fill text-right logo">
                <img class="logo" width="100" src="{{ url('/imagem/brasao.png') }}" alt="">
            </div>
            <div class="flex-fill logo"></div>

        </div> --}}

        <div class="col-md-12">
            <p class="pt-4" id="btn">
                <a class='btn btn-success btn-sm' href={{ url('rat') }} title="Voltar para página Index">Voltar</a>
                <!--<a class='btn btn-warning btn-sm' href={{ url('rat/edit/'.$rat->id) }} onclick="return confirm('Deseja Editar o Relatório ?')" title="Imprimir Documento">Editar</a>-->
                <a class='btn btn-primary btn-sm' onclick="window.print()" title="Imprimir Documento">Imprimir</a>
            </p>
            <p class="text-center m-4">
                <legend>RELATÓRIO DE ATIVIDADES</legend>
            </p>

            <div class="row">
                <div class="col-md-6 border p-2">
                    <label>Número</label> : <span class="h5">{{ $rat->num_ocorrencia }}</span>
                </div>
                <div class="col-md-6 border p-2">
                    <label>Data Ocorrência</label> : <span class="h5">{{ \Carbon\Carbon::parse($rat->dt_ocorrencia)->format('d/m/Y H:i:s') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 border p-2">
                    <label>Município</label> : <span class="h5">{{ $rat->municipio->nome }}</span>
                </div>
                <div class="col-md-6 border p-2">
                    <label>Operador</label> : <span class="h5">{{ $rat->operador->name }} / {{ $rat->operador->cpf }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 border p-2">
                    <label>Ocorrência</label> : <span class="h5">{{ $rat->ocorrencia->cod }} / {{ $rat->ocorrencia->descricao }}</span>
                </div>
                <div class="col-md-6 border p-2">
                    <label>Alvo da Ocorrência</label> : <span class="h5">{{ $rat->alvo_id }} / {{ $rat->alvo->alvo }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 border p-2">
                    <label>Cobrade</label> : <span class="h5">{{ $rat->cobrade->codigo }} / {{ $rat->cobrade->descricao }}</span>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12 border p-2">
                    <label>Descrição do Lugar</label> :<br>
                    <span class="h5">{{ $rat->lugar_descricao }}</span>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-12 border p-2">
                    <label>Envolvidos</label> : <span class="h5">{{ $rat->envolvidos }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 border p-2">
                    <label>Nome da Operação</label> : <span class="h5">{{ $rat->nome_operacao }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 border p-2">
                    <label>Endereço</label> : <span class="h5">{{ $rat->endereco }}</span>
                </div>
                <div class="col-md-2 border p-2">
                    <label>Número</label> : <span class="h5">{{ $rat->numero }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 border p-2">
                    <label>Bairro</label> : <span class="h5">{{ $rat->bairro }}</span>
                </div>
                <div class="col-md-3 border p-2">
                    <label>Estado</label> : <span class="h5">{{ $rat->estado }}</span>
                </div>
                <div class="col-md-3 border p-2">
                    <label>Cep</label> : <span class="h5">{{ $rat->cep }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 border p-2">
                    <label>Referência</label> :<br>
                    <span class="text-justify h5">{{ $rat->referencia }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 border p-2">
                    <label>Descrição / Ações / Relatório</label> :<br>
                    <p class="text-justify p-3 h5 text-uppercase">{!! $rat->acoes !!}</p>
                </div>
            </div>

            <br>

            <div class="row">
                @if ($files)
                    <legend>Imagens Relacionadas</legend>
                    @foreach ($files as $file)
                        <div class="col-md-6 text-center img-thumbnail p-3">
                            <img width="400" src="{{ asset('storage/rat_uploads/' . $rat->id . '/' . basename($file)) }}">
                        </div>
                    @endForeach
                @endif
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
