<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- header css --}}
    @include('layouts/includes/header')

    
</head>

<body class="min-vh-100" style="background-color: rgb(215, 217, 219)">

    {{-- Impressao do header no PDF --}}
    @if (!isset($pdf))
        <!-- nav -->
        <div class="row print" id='barra'>
            @include('layouts/includes/web/nav')
        </div>

        <div class="row" id="cabecalho">
            {{-- header --}}
            @yield('header')
        </div>
    @endif

    <div class="container">
    
    <div class="row" id="corpo">

            {{-- conteudo container corpo --}}
            <div class="col-12 col-md-12">
                @yield('content')
            </div>

        </div>
        
    </div>

        {{-- Impressao do header no PDF --}}
        @if (!isset($pdf))
            {{-- Rodape --}}
            <div class="row justify-content-center  print" id="footer">
                @include('layouts/includes/footer')
            </div>
        @endif



    {{-- javascript pagina global --}}
    @include('layouts/includes/script')

    @stack('other-scripts')


    {{-- js local --}}
    @yield('code')
    <script>
        var barra = $('#barra').height();
        var cabecalho = $('#cabecalho').height();
        var footer = $('#footer').height();
        var view = window.innerHeight;
        $("#corpo").css('min-height',(view - barra - cabecalho - footer));
        
        
    </script>



</body>

</html>
