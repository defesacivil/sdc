<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    

    {{-- header css --}}
    @include('layouts/includes/header')
    
    <!--@if (session('message'))
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
    @endif-->
</head>

<body class="body" style="background-color: rgb(215, 217, 219)">

    <!-- nav -->
    <div class="row">
        @include('layouts/includes/nav')
    </div>

    {{-- header --}}
    @yield('header')


    {{-- conteudo container corpo --}}
    <div class="min-vh-100">
        @yield('content')

    </div>


    {{-- Rodape --}}
    @include('layouts/includes/footer')


    
    {{-- javascript pagina global --}}
    @include('layouts/includes/script')
    
    {{-- js local --}}
    @yield('code')





</body>

</html>
