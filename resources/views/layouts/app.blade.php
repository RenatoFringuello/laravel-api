<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome v6.3.0 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="mh-100vh">
    <div id="app">
        @include('layouts.partials.header')
        
        <main class="container-md">
            @yield('content')
        </main>
        
        @include('layouts.partials.footer')

        @yield('scripts')
    </div>
</body>

</html>
