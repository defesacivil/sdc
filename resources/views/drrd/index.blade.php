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
            <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p><br>

            <div class="row">
                <div class="col text-center">
                    <a href="{{ url('pae/protocolo') }}"><img src="{{ asset('imagem/icon/protocolo.png') }}" width="160"
                            alt=""></a><br><span>Protocolos</span>
                </div>
                <div class="col text-center">
                    <picture>
                        <a href="{{ url('pae/empdor') }}"><img src="{{ asset('imagem/icon/empreendedor.png') }}" width="160" height="170"
                                alt=""></a><br><span>Empreendedores</span>
                    </picture>
                </div>
                <div class="col text-center p-4">
                    <a href="{{ url('pae/empnto') }}"><img src="{{ asset('imagem/icon/barragem.png') }}" width="160"
                            alt=""></a><br><span>Empreendimentos</span>
                </div>
                <!--<div class="col text-center">
                            <a href="pae/analise"><img src="https://via.placeholder.com/160?text=Análises" alt=""></a><br><span>Análises</span>
                        </div>
                        <div class="col text-center">
                            <a href="#"><img src="https://via.placeholder.com/160?text=Notificações" alt=""></a><br><span>Notificações</span>
                        </div>-->
            </div>
            <div class="row p-2">
                <div class="col p-2">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_protocolo }}</h3>
                            <p>PAEBM Registrados</p>
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
                            <h3>0</h3>
                            <p>PAEBM Próximo(s) do Vencimento</p>
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
                            <h3>0</h3>
                            <p>Notificações PAEBM Próximo(s) do Vencimento</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
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
