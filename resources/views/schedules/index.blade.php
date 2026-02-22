@extends('layouts.app')

@section('title', 'Production Schedule')
@section('header_title', 'Production Scheduling System')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-emerald-600 text-white p-2.5 rounded-xl shadow-lg shadow-emerald-200">
                <i data-lucide="calendar-days" class="w-6 h-6"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Production Schedules</h3>
                <p class="text-sm text-slate-500 font-medium">Penjadwalan jalur produksi dan balancing.</p>
            </div>
        </div>

        <button onclick="toggleModal('addScheduleModal')" 
                class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200 group">
            <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
            <span>Buat Jadwal</span>
        </button>
    </div>

    @include('schedules.partials.filter-bar')
    @include('schedules.partials.grid')
@endsection

@push('modals')
    @include('schedules.partials.edit-modal')
    @include('schedules.partials.add-modal')
@endpush