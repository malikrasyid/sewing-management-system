<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus ERP - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/util.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-50 font-sans antialiased">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold tracking-wider text-blue-400">NEXUS<span class="text-white">ERP</span></div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" 
                    class="flex items-center p-3 rounded-lg transition-colors {{ Route::is('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="mr-3 w-5 text-center">📊</span> 
                    <span class="font-medium">Dashboard Overview</span>
                </a>
                
                <a href="{{ route('schedules.index') }}" 
                    class="flex items-center p-3 rounded-lg transition-colors {{ Route::is('schedules.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="mr-3 w-5 text-center">🗓️</span> 
                    <span class="font-medium">Production Schedule</span>
                </a>

                <a href="{{ route('orders.index') }}" 
                    class="flex items-center p-3 rounded-lg transition-colors {{ Route::is('orders.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="mr-3 w-5 text-center">📦</span> 
                    <span class="font-medium">Master Order</span>
                </a>

                <a href="{{ route('lines.index') }}" 
                    class="flex items-center p-3 rounded-lg transition-colors {{ Route::is('lines.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="mr-3 w-5 text-center">🏭</span> 
                    <span class="font-medium">Master Line</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-slate-800">@yield('header_title')</h2>
            </header>

            <div class="p-8 overflow-y-auto">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('modals')
    @stack('scripts')
</body>
</html>