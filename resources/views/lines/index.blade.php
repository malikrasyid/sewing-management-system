@extends('layouts.app')

@section('title', 'Master Line')
@section('header_title', 'Master Data Line')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-slate-700">Manajemen Sewing Line</h3>
        <button onclick="toggleModal('addLineModal')" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
            + Tambah Line
        </button>
    </div>
    @include('lines.partials.table')
@endsection

@push('modals')
    @include('lines.partials.add-modal')
@endpush