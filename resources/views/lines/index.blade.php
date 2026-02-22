@extends('layouts.app')

@section('title', 'Master Line')
@section('header_title', 'Master Data Line')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-indigo-600 text-white p-2.5 rounded-xl shadow-lg shadow-indigo-200">
                <i data-lucide="factory" class="w-6 h-6"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Sewing Lines Management</h3>
                <p class="text-sm text-slate-500 font-medium">Daftar semua jalur produksi aktif.</p>
            </div>
        </div>

        <button onclick="toggleModal('addLineModal')" 
                class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200 group">
            <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
            <span>Tambah Line</span>
        </button>
    </div>

    @include('lines.partials.grid')
@endsection

@push('modals')
    @include('lines.partials.add-modal')
    @include('lines.partials.edit-modal')
@endpush