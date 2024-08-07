<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('/storage/css/style.css') }}" rel="stylesheet" type="text/css">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="background-image"></div>
    <div class="overlay"></div>

    @env('local')
    <div class="cartao" style="color: white; font-size: 25px; position: fixed; top: 10px; right: 10px; z-index: 1000; background: rgba(0, 0, 0, 0.7); padding: 10px; border-radius: 5px;">
        <p class="d-block d-sm-none">TELA XS - max-width: 575px</p>
        <p class="d-none d-sm-block d-md-none">TELA SM - max-width: 767px</p>
        <p class="d-none d-md-block d-lg-none">TELA MD - max-width: 991px</p>
        <p class="d-none d-lg-block d-xl-none">TELA LG - max-width: 1199px</p>
        <p class="d-none d-xl-block d-xxl-none">TELA XL - max-width: 1399px</p>
        <p class="d-none d-xxl-block">TELA XXL - min-width: 1400px</p>
    </div>
    <div class="cartao" style="color: white; font-size: 30px; position: fixed; top: 10px; left: 10px; z-index: 1000; background: rgba(0, 0, 0, 0.7); padding: 10px; border-radius: 5px;">
        <p>MODO DE DESENVOLVIMENTO</p>
        <p>APP_ENV=local</p>
    </div>
    @endenv

    <div class="cartao d-flex flex-column justify-content-center align-items-center min-h-screen">
        <div class="mb-6">
            <a href="/" wire:navigate>
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="{{ asset('/storage/js/vlibras.js') }}"></script>
</body>

</html>
