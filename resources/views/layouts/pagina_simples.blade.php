<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- header css --}}
    @include('layouts/includes/header')
</head>

<body class="body">

    <!-- nav -->
    <header class="row">
        
    </header>


    {{-- conteudo container corpo --}}
    <div class="container">
        @yield('content')
    </div>


    {{-- rodape e js --}}
    <footer class="row">
        @include('layouts/includes/footer')
    </footer>

    {{-- javascript pagina global --}}
    @include('layouts/includes/script')

    @stack('other-scripts')


    {{-- js local --}}
    @yield('code')

</body>

</html>
