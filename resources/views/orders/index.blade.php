@extends('layouts.app')

@section('title', 'Master Order')
@section('header_title', 'Master Data Order')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-slate-700">Daftar Order Produksi</h3>
        <button onclick="toggleModal('addOrderModal')" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
            + Tambah Order
        </button>
    </div>

    @include('orders.partials.table')
@endsection

@push('modals')
    @include('orders.partials.add-modal')
@endpush