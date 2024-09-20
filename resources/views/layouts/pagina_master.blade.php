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

<body>
    <div class="container-fluid gx-0 overflow-x-hidden">
        {{-- Impressao do header no PDF --}}
        @if (!isset($pdf))
            <!-- nav -->
            <div class="row print" id='barra'>
                <div class="col-12">
                    @include('layouts/includes/nav')
                </div>
            </div>

            <div class="row" id="breadcrumb">
                <div class="col-12">
                    {{-- breadcrumb/pg master --}}
                    @yield('breadcrumb')
                </div>
            </div>
        @endif

        <div class="row" id="corpo">
            <div class="col-2 col-md-2 print">
                @include('layouts/pagina_menu')
            </div>
            {{-- conteudo container corpo --}}
            <div class="col-10 col-md-10">
                @yield('content')
            </div>
        </div>

        {{-- Impressao do header no PDF --}}
        @if (!isset($pdf))
            {{-- Rodape --}}
            <div class="row justify-content-center  print" id="footer">
                <div class="col">
                    @include('layouts/includes/footer')
                </div>
            </div>
        @endif


    </div>
    {{-- javascript pagina global --}}
    @include('layouts/includes/script')

    @stack('other-scripts')


    {{-- js local --}}
    @yield('code')
    <script>
        var barra = $('#barra').height();
        var breadcrumb = $('#breadcrumb').height();
        var footer = $('#footer').height();
        var view = window.innerHeight;
        $("#corpo").css('min-height', (view - barra - breadcrumb - footer));
    </script>



</body>

</html>
