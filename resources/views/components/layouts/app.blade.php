<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Meta description -->
    <meta name="description" content="A simple weather app demo">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-blue-500">
    <div class="flex justify-center pt-16">
        {{ $slot }}
    </div>
</body>

</html>
