@extends('layouts.app')

@section('title', 'Production Schedule')
@section('header_title', 'Production Scheduling System')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-slate-700">Daftar Schedule</h3>
        <button onclick="toggleModal('addScheduleModal')" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
            + Tambah Schedule
        </button>
    </div>
    @include('schedules.partials.filter-bar')
    @include('schedules.partials.table')
@endsection

@push('modals')
    @include('schedules.partials.add-modal')
@endpush