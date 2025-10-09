<!DOCTYPE html>
<html lang="id">

<head>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/menu-detail.css') }}">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <main class="flex-1 container mx-auto p-6">
        @yield('content')
    </main>
</body>

</html>