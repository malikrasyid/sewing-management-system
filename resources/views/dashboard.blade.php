@extends('layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Production Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="text-blue-600 bg-blue-50 w-10 h-10 rounded-lg flex items-center justify-center mb-4 text-xl">🏭</div>
            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Lines</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $total_lines }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="text-amber-600 bg-amber-50 w-10 h-10 rounded-lg flex items-center justify-center mb-4 text-xl">📦</div>
            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Orders</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $total_orders }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="text-emerald-600 bg-emerald-50 w-10 h-10 rounded-lg flex items-center justify-center mb-4 text-xl">🗓️</div>
            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Active Schedules</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $active_schedules }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <div class="text-purple-600 bg-purple-50 w-10 h-10 rounded-lg flex items-center justify-center mb-4 text-xl">🚀</div>
            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Production Progress</p>
            <h3 class="text-2xl font-bold text-slate-800">{{ $percentage }}%</h3>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-slate-800 text-lg">Overall Production Accomplishment</h3>
            <span class="text-sm text-slate-500 font-medium italic">Actual vs Total Target</span>
        </div>

        <div class="space-y-4">
            <div class="flex justify-between text-sm font-bold text-slate-600">
                <span>{{ number_format($total_actual) }} pcs achieved</span>
                <span>Target: {{ number_format($total_target) }} pcs</span>
            </div>
            
            <div class="w-full bg-slate-100 rounded-full h-4 overflow-hidden">
                <div class="bg-blue-600 h-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(37,99,235,0.4)]" 
                     style="width: {{ $percentage }}%"></div>
            </div>

            <p class="text-xs text-slate-400 mt-2">
                *Data dihitung berdasarkan akumulasi seluruh order yang tercatat di sistem Nexus ERP.
            </p>
        </div>
    </div>
@endsection