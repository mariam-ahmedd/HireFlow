<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @if (app()->getLocale() === 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Cairo', ui-sans-serif, system-ui, sans-serif; }
        </style>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ $title ?? 'HireFlow' }}</title>
</head>

<body class="bg-hireflow-bg min-h-screen flex flex-col text-hireflow-text">
    <x-Navbar />

    <main class="flex-1 mx-4 md:mx-20">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
