<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Sewing Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/util.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [data-lucide] { stroke-width: 2.5px; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">

    <div class="flex min-h-screen overflow-hidden">
        
        <aside class="w-72 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col shadow-2xl z-50">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-900/50">
                        <i data-lucide="cpu" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold tracking-tight leading-none">SEWING<span class="text-blue-500">MS</span></h1>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]">Management System</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>
                
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center px-4 py-3.5 rounded-2xl transition-all group {{ Route::is('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 {{ Route::is('dashboard') ? 'text-white' : 'group-hover:text-blue-400' }}"></i>
                    <span class="font-bold text-sm">Dashboard</span>
                </a>

                <a href="{{ route('schedules.index') }}" 
                   class="flex items-center px-4 py-3.5 rounded-2xl transition-all group {{ Route::is('schedules.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="calendar-range" class="w-5 h-5 mr-3 {{ Route::is('schedules.*') ? 'text-white' : 'group-hover:text-emerald-400' }}"></i>
                    <span class="font-bold text-sm">Production Schedule</span>
                </a>

                <p class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-widest mt-8 mb-4">Master Data</p>

                <a href="{{ route('orders.index') }}" 
                   class="flex items-center px-4 py-3.5 rounded-2xl transition-all group {{ Route::is('orders.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="package" class="w-5 h-5 mr-3 {{ Route::is('orders.*') ? 'text-white' : 'group-hover:text-amber-400' }}"></i>
                    <span class="font-bold text-sm">Order / PO</span>
                </a>

                <a href="{{ route('lines.index') }}" 
                   class="flex items-center px-4 py-3.5 rounded-2xl transition-all group {{ Route::is('lines.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i data-lucide="factory" class="w-5 h-5 mr-3 {{ Route::is('lines.*') ? 'text-white' : 'group-hover:text-indigo-400' }}"></i>
                    <span class="font-bold text-sm">Sewing Lines</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 bg-slate-50 h-screen overflow-y-auto">
            
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40 px-8 py-4 flex justify-between items-center">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em]">
                    @yield('header_title', 'Sewing Management System')
                </h2>
                
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-3 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-full">
                        <div class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </div>
                        
                        <div class="leading-none">
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">System Online</p>
                        </div>
                    </div>

                    <div class="w-px h-8 bg-slate-200"></div>

                    <button class="relative text-slate-400 hover:text-blue-600 transition group">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>
                </div>
            </header>

            <div class="p-8 max-w-[1600px] mx-auto w-full">
                @yield('content')
            </div>

        </main>
    </div>

    @stack('modals')

    @stack('scripts')

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Helper untuk re-inisialisasi icon jika ada perubahan DOM
        window.refreshIcons = () => lucide.createIcons();
    </script>
</body>
</html>