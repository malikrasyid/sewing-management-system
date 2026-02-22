@extends('layouts.app')

@section('title', 'Master Order')
@section('header_title', 'Master Data Order')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-4">
            <div class="bg-amber-500 text-white p-2.5 rounded-xl shadow-lg shadow-amber-200">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Production Orders</h3>
                <p class="text-sm text-slate-500 font-medium">Manajemen Purchase Order dan detail item.</p>
            </div>
        </div>

        <button onclick="toggleModal('addOrderModal')" 
                class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200 group">
            <i data-lucide="plus" class="w-4 h-4 transition-transform group-hover:rotate-90"></i>
            <span>Tambah Order</span>
        </button>
    </div>

    @include('orders.partials.grid')
@endsection

@push('modals')
    @include('orders.partials.edit-modal')
    @include('orders.partials.add-modal')
@endpush