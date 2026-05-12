<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'SOS Tech') }}</title>
    </head>
    <body>
        <header style="padding: 16px; border-bottom: 1px solid #e5e7eb;">
            @yield('header')
        </header>

        <main style="padding: 16px;">
            @yield('content')
        </main>
    </body>
</html>

