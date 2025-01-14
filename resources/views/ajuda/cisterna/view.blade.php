@extends('layouts.pagina_master')

{{-- header --}}
@section('header')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/ajuda') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Projeto Cisterna</li>
        </ol>
    </nav>

@endsection

@section('content')
    <div class="container border p-3 min-vh-100" style="background-color:#e9ecef;">
        <div class="row flex-fill">

            <div class="col-md-12">
                <p class="p-4 text-center"><a class='btn btn-success btn-sm' href={{ url('cisterna') }}>Voltar</a>&nbsp;
                    <a class='btn btn-warning btn-sm' href={{ url('exportar') }} title="Exportar dados para Excel">Exportar Excel</a>
                </p>


                @hasrole('cedec')
                    <div class="row bg-white rounded">


                        <div class="row p-3">
                            <div class="col-2">id</div>
                            <div class="col-9">{{ $cisterna->id }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Id interno do App</div>
                            <div class="col-9">{{ $cisterna->id_cad }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Municipio </div>
                            <div class="col-9">{{ $cisterna->getMunicipio['nome'] }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Comunidade</div>
                            <div class="col-9">{{ $cisterna->comunidade }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Nome do Beneficiário</div>
                            <div class="col-9">{{ $cisterna->nome }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Endereco</div>
                            <div class="col-9">{{ $cisterna->endereco }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Lat/Long</div>
                            <div class="col-9">{{ $cisterna->localiza }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">CPF </div>
                            <div class="col-9">{{ $cisterna->cpf }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Data Nascimento</div>
                            <div class="col-9">{{ $cisterna->dtNasc }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Cadastro Único</div>
                            <div class="col-9">{{ $cisterna->cadUnico }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Qtd Pessoas </div>
                            <div class="col-9">{{ $cisterna->qtdPessoa }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Renda </div>
                            <div class="col-9">{{ $cisterna->renda }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Tipo Moradia </div>
                            <div class="col-9">{{ $cisterna->moradia }}</div>
                        </div>

                        @if ($cisterna->moradia == 'outros')
                            <div class="row p-3">
                                <div class="col-2">Outro Tipo de Moradia</div>
                                <div class="col-9">{{ $cisterna->outroMoradia }}</div>
                            </div>
                        @endif

                        <div class="row p-3">
                            <div class="col-2">Comprimento do Telhado </div>
                            <div class="col-9">{{ $cisterna->compTelhado }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Largura / Comprimento do Telhado</div>
                            <div class="col-9">{{ $cisterna->larguracompTelhado }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Área Total do Telhado</div>
                            <div class="col-9">{{ $cisterna->areaTotalTelhado }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Comprimento da Testada </div>
                            <div class="col-9">{{ $cisterna->compTestada }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Número de Caidas do Telhado </div>
                            <div class="col-9">{{ $cisterna->numCaidaTelhado }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Cobertura do Telhado</div>
                            <div class="col-9">{{ $cisterna->coberturaTelhado }}</div>
                        </div>

                        @if ($cisterna->coberturaTelhado == 'outros')
                            <div class="row p-3">
                                <div class="col-2">Outros Tipos de Cobertura de Telhados </div>
                                <div class="col-9">{{ $cisterna->coberturaOutros }}</div>
                            </div>
                        @endif

                        <div class="row p-3">
                            <div class="col-2">Existe Fogao à Lenha</div>
                            <div class="col-9">{{ ($cisterna->existeFogaoLenha == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        @if ($cisterna->existeFogaoLenha == 1)
                            <div class="row p-3">
                                <div class="col-2">Medida do Telhado da Área do Fogao à Lenha</div>
                                <div class="col-9">{{ $cisterna->medidaTelhadoAreaFogao }}</div>
                            </div>

                            <div class="row p-3">
                                <div class="col-2">Testada Disponível na Parte do Fogão à Lenha </div>
                                <div class="col-9">{{ $cisterna->testadaDispParteFogao }}</div>
                            </div>
                        @endif

                        <div class="row p-3">
                            <div class="col-2">Existen Atendimento de Caminhão Pipa </div>
                            <div class="col-9">{{ ($cisterna->atendPipa == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Outro Tipo de Atendimento de Caminhão Pipa</div>
                            <div class="col-9">{{ ($cisterna->outroAtendPipa == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Defesa Civil é Responsãvel pelo Atendimento Pipa </div>
                            <div class="col-9">{{ ($cisterna->respAtDefesaCivil == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Exercito é Responsãvel pelo Atendimento Pipa </div>
                            <div class="col-9">{{ ($cisterna->respAtExercito == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Iniciativa Particular é Responsãvel pelo Atendimento Pipa </div>
                            <div class="col-9">{{ ($cisterna->respAtParticular == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Prefeitura é Responsãvel pelo Atendimento Pipa </div>
                            <div class="col-9">{{ ($cisterna->respAtPrefeitura == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Outros Tipo de Modalidade é Responsãvel pelo Atendimento Pipa </div>
                            <div class="col-9">{{ ($cisterna->respAtOutros == 0) ? 'Não' : 'Sim' }}</div>
                        </div>

                        @if ($cisterna->respAtOutros == 1)
                            <div class="row p-3">
                                <div class="col-2">Observações </div>
                                <div class="col-9">{{ $cisterna->outrObs }}</div>
                            </div>
                        @endif

                        <div class="row p-3">
                            <div class="col-2">Nome do Agente</div>
                            <div class="col-9">{{ $cisterna->nomeAgente }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">CPF do Agente </div>
                            <div class="col-9">{{ $cisterna->cpfAgente }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Nome Engenheiro </div>
                            <div class="col-9">{{ $cisterna->nomeEng }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">CREA do Engenheiro</div>
                            <div class="col-9">{{ $cisterna->creaEng }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Data Atualizaçãop</div>
                            <div class="col-9">{{ $cisterna->updated_at }}</div>
                        </div>

                        <div class="row p-3">
                            <div class="col-2">Data de Criação </div>
                            <div class="col-9">{{ $cisterna->created_at }}</div>
                        </div>


                        {{-- imagens --}}
                        <div class="row text-center">
                            <label>Imagens Relacionadas</label>
                            @if ($images)
                                @foreach ($images as $image)
                                    <div class="col-3">
                                        <label class="font-bold m-4">{{ ucfirst(substr($image, 32, -5)) }}</label>
                                        <img width="300" src={{ asset('storage/'.$image) }}>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endrole
                </div>
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
