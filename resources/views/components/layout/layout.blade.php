<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Library</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900 min-h-screen antialiased">
    <x-layout.nav />
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        {{ $slot }}
    </main>
</body>
</html>
