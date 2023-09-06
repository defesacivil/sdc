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
            <li class="breadcrumb-item"><a href="{{ url('compdec/vistoria') }}">Ajuda Humanitária</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="container">


        <div class="row flex-fill m-4">
            {{-- <div class="flex-fill logo"></div>
        <div class="flex-fill logo">
            <img class="logo" width="100" src="{{ url('/imagem/DEFESACIVILMG_400.png') }}" alt="">
        </div>
        <div class="flex-fill logo"></div>
        <div class="flex-fill text-right logo">
            <img class="logo" width="100" src="{{ url('/imagem/brasao.png') }}" alt="">
        </div>
        <div class="flex-fill logo"></div> --}}

            <div class="col-md-12">
                <p class="pt-4" id="btn">
                    <a class='btn btn-success btn-sm' href={{ url('vistoria') }} title="Voltar para página Index">Voltar</a>
                    <a class='btn btn-primary btn-sm' onclick="window.print()" title="Imprimir Documento">Imprimir</a>
                </p>
                <p class="text-center m-4">
                    <legend>TERMO DE INTERDIÇÃO
                        Nº 0{{ $interdicao->numero }}/{{ \Carbon\Carbon::parse($interdicao->dt_registr)->year }} </legend>
                </p>

                <div class="row">
                    <div class="col-md-12 border p-3">
                        <p class="fs-3" style="font-size: 15pt">
                            Vistoria realizada em <strong>{{ \Carbon\Carbon::parse($interdicao->dt_registro)->format('d/m/Y') }} </strong> equipe de Proteção e Defesa Civil de <strong>{{ $interdicao->municipio->nome }}/MG</strong>, relacionado com o Relatório de Vistoria nº
                            <strong>{{ $interdicao->ids_vistoria }}/{{ \Carbon\Carbon::parse($interdicao->dt_registr)->year }}</strong>.
                        </p>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-12 border p-3">
                        <p class="text-center">
                            <legend>Local de Vistoria</legend>
                        </p>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Logradouro:</h4>
                            </div>
                            <div class="col-md-9">
                                <h4>{{ $interdicao->endereco }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <h4>Bairro : </h4>
                            </div>
                            <div class="col-md-9">
                                <h4>{{ $interdicao->bairro }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <h4>Municipio : </h4>
                            </div>
                            <div class="col-md-9">
                                <h4>{{ $interdicao->municipio_id }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 border p-3 text-center">
                        <p class="text-center">
                            <legend>Indentificação do Notificado</legend>
                        </p>
                        <h4>Nome:____________________________________________________________ RG:____________________________</h4>
                        <h4>Endereço:_________________________________________________________________________ Nº:____________</h4>
                        <h4>Complemento:___________________________________ Bairro:__________________________________________</h4>
                        <h4>Cidade:________________________________________ Contato/Telefone:_________________________________</h4>

                    </div>
                </div>

                <br>
                <div class="row border">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 text-justify">
                        <p class="text-center">
                            <legend>Motivo da Interdição</legend>
                        </p>

                        <p class="fs-3" style="font-size: 15pt">Em decorrência das anomalias constatadas na edificação/solo pelo vistoriador de Proteção e
                            Defesa Civil e relatadas no relatório de vistoria nº <strong>{{ $interdicao->ids_vistoria }}/{{ \Carbon\Carbon::parse($interdicao->dt_registr)->year }}</strong>, fica INTERDITADO o imóvel da
                            <strong>{{ $interdicao->endereco . ' ' . $interdicao->bairro }} </strong> manifestações
                            patológicas comprometem o desempenho da construção e colocam em risco à vida de seus
                            moradores/usuários.
                            O notificado deve providenciar a remoção imediata de todos os moradores e seus usuários,
                            devendo a edificação permanecer INTERDITADA até que as condições de segurança e
                            habitabilidade sejam restabelecidas.
                            O vistoriador atesta que a presente interdição obedece criteriosamente aos princípios da Lei
                            Federal Nº 12.608, de 10 de abril de 2012, que aduz no Art.2º a seguinte redação:
                            Art. 2º É dever da União, dos Estados, do Distrito Federal e dos Municípios adotar as medidas
                            necessárias à redução dos riscos de desastre.
                            § 2o A incerteza quanto ao risco de desastre não constituirá óbice para a adoção das medidas
                            preventivas e mitigadoras da situação de risco.</h4>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col"><br><br><br>
                        <p class="">_________________________________________________________
                        <p>
                            <span class="m-50">Nome:</span>
                    </div>
                    <div class="col-md-4"></div>
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
