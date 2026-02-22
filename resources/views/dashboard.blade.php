@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Production Overview')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-indigo-600 text-white p-3 rounded-2xl shadow-lg shadow-indigo-200">
                <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-800">Production Dashboard</h2>
                <p class="text-sm text-slate-500 font-medium tracking-tight">
                    Monitoring data tanggal: <span class="text-indigo-600 font-bold">{{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</span>
                </p>
            </div>
        </div>

        <form action="{{ route('dashboard') }}" method="GET" class="bg-white p-2 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-2">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
                <input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()"
                       class="bg-slate-50 border-none rounded-xl pl-10 pr-4 py-2 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-indigo-500 transition-all outline-none">
            </div>
            <button type="submit" class="bg-slate-900 text-white p-2 rounded-xl hover:bg-slate-800 transition shadow-md shadow-slate-200">
                <i data-lucide="filter" class="w-4 h-4"></i>
            </button>
            @if($selectedDate != now()->format('Y-m-d'))
                <a href="{{ route('dashboard') }}" class="p-2 text-slate-400 hover:text-red-500 transition" title="Reset ke Hari Ini">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 text-emerald-50 opacity-10 group-hover:scale-110 transition-transform">
                <i data-lucide="factory" class="w-24 h-24"></i>
            </div>
            <div class="bg-emerald-100 text-emerald-600 w-12 h-12 rounded-2xl flex items-center justify-center mb-4">
                <i data-lucide="factory" class="w-6 h-6"></i>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Lines</p>
            <h3 class="text-3xl font-black text-slate-800">{{ $total_lines }}</h3>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 text-amber-50 opacity-10 group-hover:scale-110 transition-transform">
                <i data-lucide="package" class="w-24 h-24"></i>
            </div>
            <div class="bg-amber-100 text-amber-600 w-12 h-12 rounded-2xl flex items-center justify-center mb-4">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Orders</p>
            <h3 class="text-3xl font-black text-slate-800">{{ $total_orders }}</h3>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 text-blue-50 opacity-10 group-hover:scale-110 transition-transform">
                <i data-lucide="calendar-check" class="w-24 h-24"></i>
            </div>
            <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-2xl flex items-center justify-center mb-4">
                <i data-lucide="calendar-check" class="w-6 h-6"></i>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Schedules</p>
            <h3 class="text-3xl font-black text-slate-800">{{ $active_schedules }}</h3>
        </div>

        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 hover:shadow-md transition-all relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 text-purple-50 opacity-10 group-hover:scale-110 transition-transform">
                <i data-lucide="percent" class="w-24 h-24"></i>
            </div>
            <div class="bg-purple-100 text-purple-600 w-12 h-12 rounded-2xl flex items-center justify-center mb-4">
                <i data-lucide="percent" class="w-6 h-6"></i>
            </div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Production Rate</p>
            <h3 class="text-3xl font-black text-slate-800">{{ $percentage }}%</h3>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden relative">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <i data-lucide="trending-up" class="w-32 h-32"></i>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 relative z-10">
            <div class="flex items-center gap-4">
                <div class="bg-slate-900 text-white p-4 rounded-2xl shadow-xl shadow-slate-200">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-xl tracking-tight">Accumulative Output</h3>
                    <p class="text-sm text-slate-400 font-medium">Realisasi target produksi pada periode terpilih.</p>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-4 rounded-2xl border border-slate-100">
                <span class="text-3xl font-black text-indigo-600">{{ number_format($total_actual) }}</span>
                <span class="text-slate-300 mx-2 text-2xl font-light">/</span>
                <span class="text-xl font-bold text-slate-400">{{ number_format($total_target) }} <span class="text-xs uppercase tracking-tighter">Pcs</span></span>
            </div>
        </div>

        <div class="relative z-10">
            <div class="flex mb-4 items-center justify-between">
                <span class="text-xs font-black py-1.5 px-4 uppercase rounded-full text-indigo-600 bg-indigo-50 border border-indigo-100">
                    Production Progress
                </span>
                <span class="text-sm font-black text-indigo-600 bg-white px-3 py-1 rounded-lg shadow-sm border border-slate-100">
                    {{ $percentage }}% Achieved
                </span>
            </div>
            
            <div class="overflow-hidden h-8 mb-4 text-xs flex rounded-2xl bg-slate-100 border-[6px] border-white shadow-inner">
                <div style="width:{{ $percentage }}%" 
                     class="shadow-lg flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-indigo-600 via-blue-500 to-emerald-400 transition-all duration-1000 ease-in-out">
                </div>
            </div>

            <div class="flex items-center gap-2 mt-6 text-slate-400">
                <i data-lucide="info" class="w-4 h-4"></i>
                <p class="text-[11px] font-medium italic">Data diperbarui secara otomatis berdasarkan input aktual di menu Schedule.</p>
            </div>
        </div>
    </div>
@endsection