@extends('layouts.pagina_master')


{{-- breadcrumb --}}
@section('breadcrumb')
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @canany(['cedec', 'redec'])
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            @endcanany
            <li class="breadcrumb-item active" aria-current="page">Drrd</li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row p-2">
        <div class="col-12">
            <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p>
        </div>
        <div class="col-12">

            <div class="row p-2">

                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Pae Registrados</div>
                                <div class="card-body text-center">
                                    <i class="card-title display-2 bold">{{ $total_protocolo }}</i>
                                    <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 text-center">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Próximo(s) Vencimento</div>
                                <div class="card-body text-center">
                                    <i class="card-title display-2 bold">{{ $totPaeProxVenc }}</i>
                                    <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 text-center">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Notificações Vencidas</div>
                                <div class="card-body text-center">
                                    <i class="card-title display-2 bold">{{ $notificacoes }}</i>
                                    <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 text-center">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">CCPAE</div>
                                <div class="card-body text-center">
                                    <i class="card-title display-2 bold">{{ $totCcpae }}</i>
                                    <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                {{-- @canany(['cedec', 'redec']) --}}

                <div class="col">
                    <a class="btn btn-outline-primary w-100" href="{{ url('pae/protocolo') }}"><img src="{{ asset('imagem/icon/protocolo.png') }}" width="30"alt="">Protocolos</a></p>
                </div>
                <div class="col">
                    <a class="btn btn-outline-primary w-100" href="{{ url('pae/user') }}" title="Gestão de Usuários Externos (Empreendedores)"><img src="{{ asset('imagem/boss.png') }}" width="30" alt="">Acesso Externo (Mineradoras)</a></p>
                </div>
                <div class="col">
                    <a class="btn btn-outline-primary w-100" href="{{ url('pae/empdor') }}"><img src="{{ asset('imagem/icon/empreendedor.png') }}" width="30" height="" alt="">Empreendedores / Mineradoras</a></p>
                </div>

                {{-- @endcanany --}}

                {{-- Acesso somente da Mineradora --}}
                <div class="col">
                    <a class="btn btn-outline-primary w-100" href="{{ url('pae/empnto') }}"><img src="{{ asset('imagem/icon/barragem.png') }}" width="30" alt="">Empreendimentos / Barragens</a><br>
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
