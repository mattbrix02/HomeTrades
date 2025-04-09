<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>TradeHome</title>

        @routes()
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @inertiaHead


    </head>
    <body class="bg-white  text-gray-800 dark:bg-gray-900 dark:text-gray-300" class="{{ session('theme', 'light') }}">
        @inertia
    </body>
</html>
