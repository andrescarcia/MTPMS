<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/path/to/your/output.css" rel="stylesheet">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


</head>

<body class="flex flex-col min-h-screen font-sans antialiased dark:bg-black dark:text-white/50">
    <section class="relative w-full px-8 text-gray-700 bg-white body-font" data-tails-scripts="//unpkg.com/alpinejs"
        {!! $attributes ?? '' !!}>
        <div class="container flex flex-col flex-wrap items-center justify-between py-5 mx-auto md:flex-row max-w-7xl">
            <a href="#_"
                class="relative z-10 flex items-center w-auto text-2xl font-extrabold leading-none text-black select-none">MTPMS.</a>

            <nav
                class="top-0 left-0 z-0 flex items-center justify-center w-full h-full py-5 -ml-0 space-x-5 text-base md:-ml-5 md:py-0 md:absolute">
            </nav>

            <div class="relative z-10 inline-flex items-center space-x-3 md:ml-5 lg:justify-end">

                <spa class="inline-flex rounded-md shadow-sm">
                    <a href="{{ route('filament.admin.auth.login') }}"
                        class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap bg-teal-600 border border-teal-700 rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                        data-rounded="rounded-md" data-primary="blue-600">
                        Entrar
                    </a>
                </spa>
            </div>
        </div>
    </section>
    <section class="flex-grow px-2 py-32 bg-white md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div
                        class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1
                            class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                            <span class="block xl:inline">MT Solutions</span>
                            <span class="block text-teal-600 xl:inline" data-primary="indigo-600">Part Management
                                System</span>
                        </h1>
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">Este sistema de
                            manejo de compras de partes es una extension de las funciones de MT Stock</p>
                        <div class="relative flex flex-col sm:flex-row sm:space-x-4">
                            <a href="{{ route('filament.admin.auth.login') }}"
                                class="flex items-center w-full px-6 py-3 mb-3 text-lg text-white bg-teal-500 rounded-md sm:mb-0 hover:bg-green-500 sm:w-auto"
                                data-primary="indigo-600" data-rounded="rounded-md">
                                Entrar
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-arrow-right">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                            <a href="#_"
                                class="flex items-center px-6 py-3 text-gray-500 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-gray-600"
                                data-rounded="rounded-md">
                                MT Stock
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl"
                        data-rounded="rounded-xl" data-rounded-max="rounded-full">
                        @php
                            $backgroundImages = glob(
                                public_path('images/backgrounds/*.{jpg,jpeg,png,gif}'),
                                GLOB_BRACE,
                            );
                            $randomImage = str_replace(
                                public_path(),
                                '',
                                $backgroundImages[array_rand($backgroundImages)],
                            );
                        @endphp
                        <img src="{{ asset($randomImage) }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="w-full text-gray-700 bg-white body-font" {!! $attributes ?? '' !!}>
        <div class="container flex flex-col items-center px-8 py-8 mx-auto max-w-7xl sm:flex-row">
            <a href="#_" class="text-xl font-black leading-none text-gray-900 select-none logo">MT Solutions<span
                    class="text-indigo-600">.</span></a>
            <p class="mt-4 text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l sm:border-gray-200 sm:mt-0">&copy; 2024 MT
                Solutions - Todos los derechos reservados.
            </p>
            
            
        </div>
    </section>

</body>
<script src="https://cdn.tailwindcss.com"></script>
<script src="//unpkg.com/alpinejs" defer></script>

</html>
