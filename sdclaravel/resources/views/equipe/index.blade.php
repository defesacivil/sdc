@extends('layouts/master')
@section('title', 'SDC - Sistema de Defesa Civil')

@section('content_header')

@stop

@section('content')
@section('content')
@if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if ($errors->any())
	<ul class='errors'>
		@foreach ( $errors->all() as $error )
			<li class='error'>{{ $error }}</li>
		@endforeach
	</ul>
@endif

<!-- breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Equipe</li>
  </ol>
</nav>
    <div class="row">
        <div class="col p-3">
            <p class='text-center'><a class='btn btn-success btn-sm' href='dashboard'>Voltar</a></p><br>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-md-2 col-lg-3">
            <div class="col bg-gray-100 sm:rounded-lg text-center">
                <figure class="figure">
                    <a href='{{url('dsp')}}'>
                        <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/dsp.png') }}'
                            alt=""></a>
                    <figcaption class="figure-caption text-center">DSP</figcaption>
                </figure>
            </div>
        </div>
        <div class="col-6 col-md-2 col-lg-3">
            <div class="col bg-gray-100 sm:rounded-lg text-center">
                {{-- <figure class="figure">
                    <a href='{{url('diario')}}'>
                        <img class="figure-img img-fluid rounded" src='{{ asset('/imagem/icon/diario.png') }}'
                            alt=""></a>
                    <figcaption class="figure-caption text-center">DIARIO PLANTÃO</figcaption>
                </figure> --}}
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
