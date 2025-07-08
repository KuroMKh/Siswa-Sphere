<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiswaSphere</title>
    <link href="favicon.ico" rel="icon">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-sans antialiased min-h-screen flex flex-col justify-between overflow-hidden">

    {{-- Blurred Background Layer --}}
    <div class="absolute inset-0 z-0">
        <img src="/bg/bg.jpg" alt="background" class="w-full h-full object-cover blur-md brightness-55">
    </div>

    {{-- Page Content Wrapper --}}
    <div class="relative z-10 flex flex-col min-h-screen justify-between">

        {{-- Navigation --}}
        <header class="w-full px-6 py-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">SiswaSphere</h1>
            </div>
        </header>

        {{-- Hero Section --}}
        <main class="flex-grow flex items-center justify-center px-6">
            <div class="max-w-3xl text-center">
                <h2 class="text-4xl sm:text-5xl font-bold leading-tight mb-6">
                    Welcome to <span class="text-green-600">SiswaSphere</span>
                </h2>
                <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
                    Your all-in-one student management and engagement platform, designed to connect, support and empower.
                </p>
                @guest
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-semibold transition">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="border border-green-600 text-green-600 hover:bg-green-50 dark:hover:bg-gray-800 px-6 py-2 rounded-md font-semibold transition">
                            Log in
                        </a>
                    </div>
                @else
                    <a href="{{ url('/dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-semibold transition">
                        Go to Dashboard
                    </a>
                @endguest
            </div>
        </main>

        {{-- Footer --}}
        <footer class="text-center text-sm py-6 text-gray-500 dark:text-gray-400 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md">
            &copy; {{ now()->year }} SiswaSphere. All rights reserved.
        </footer>
        
    </div>
</body>
</html>
