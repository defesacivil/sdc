@extends('layouts/master')

@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')

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

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Escola</li>
        </ol>
    </nav>

    <div class="row text-center">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p><br>
            <p class="text-center">
                <legend>MÓDULO ESCOLA DE DEFESA CIVIL</legend>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <picture>   
                    <a href="{{ url('escola/curso/curso') }}"><img src="{{ asset('imagem/icon/curso.png') }}"
                            alt=""></a><br><span>Curso</span>
            </picture>

        </div>
        <div class="col text-center">
            <picture>
                <a href="{{ url('escola/curso/turma') }}"><img src="{{ asset('imagem/icon/turma.png') }}"
                        alt=""></a><br><span>Turma</span>
            </picture>
        </div>
        <div class="col text-center">
            <picture>
                
                    <a href="{{ url('escola/curso/aluno') }}"><img src="{{ asset('imagem/icon/alunos.png') }}"
                            alt=""></a><br><span>Alunos</span>
                
            </picture>
        </div>

    </div>
    <div class="row p-2">
        <div class="col p-2">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $total_alunos_treinados }}</h3>
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







@stop

@section('css')
    <!--<link rel="stylesheet" href="/css/admin_custom.css">-->
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
