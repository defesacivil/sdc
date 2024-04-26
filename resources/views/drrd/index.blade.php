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

            <div class="row p-2">
                <div class="col-3">
                    <div class="col p-3">
                        <img src="{{ asset('imagem/icon/protocolo.png') }}" width="30"alt=""><a class="" href="{{ url('pae/protocolo') }}">Protocolos</a>
                    </div>
                    <div class="col p-3">
                        <a href="{{ url('pae/empdor') }}"><img src="{{ asset('imagem/icon/empreendedor.png') }}" width="30" height="" alt="">Empreendedores / Empresas</a><br>
                    </div>
                    <div class="col p-3">
                        <a href="{{ url('pae/empnto') }}"><img src="{{ asset('imagem/icon/barragem.png') }}" width="30"
                                alt="">Empreendimentos / Barragens</a><br>
                    </div>

                </div>
                <!--<div class="col text-center">
                                        <a href="pae/analise"><img src="https://via.placeholder.com/160?text=Análises" alt=""></a><br><span>Análises</span>
                                    </div>
                                    <div class="col text-center">
                                        <a href="#"><img src="https://via.placeholder.com/160?text=Notificações" alt=""></a><br><span>Notificações</span>
                                    </div>-->

                <div class="col text-center p-2">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Quantidade Pae Registrados</div>
                        <div class="card-body text-center">
                            <i class="card-title display-2 bold">{{ $total_protocolo }}</i>
                            <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col text-center p-2">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">PAE Próximo(s) do Vencimento</div>
                        <div class="card-body text-center">
                            <i class="card-title display-2 bold">0</i>
                            <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                        </div>
                    </div>
                </div>

                <div class="col text-center  p-2">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Notificações Vencidas</div>
                        <div class="card-body text-center">
                            <i class="card-title display-2 bold">{{ $notificacoes }}</i>
                            <p class="card-text"><a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a></p>
                        </div>
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
