<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_title }} - Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css'))}}" />
    </head>
    <body class="antialiased">

        <x-topbar />

        <div class="relative flex flex-col items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">

            @auth
                Bonjour, vous êtes connecté !
            @endauth

            @if(session('ok'))
            <div class="block px-3 py-3 mb-4 border rounded text-white border-green-500 bg-green-400">
                {{ session('ok') }}
            </div>
            @endif

            @if($errors->count())
                <div class="block py-1 px-2 mb-4 text-white bg-red-600 rounded-md">
                @foreach ($errors->all() as $message)
                {{ $message }}<br/>
                @endforeach
                </div>
            @endif

            <x-menu />

            {{ $slot }}

        </div>
    </body>
</html>
