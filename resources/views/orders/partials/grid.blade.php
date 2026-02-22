<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($orders as $order)
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 hover:border-amber-400 transition-all group relative overflow-hidden flex flex-col justify-between">
        <div class="absolute -right-6 -bottom-6 text-amber-50 opacity-10 group-hover:scale-110 transition-transform">
            <i data-lucide="package" class="w-24 h-24"></i>
        </div>

        <div>
            <div class="flex justify-between items-start mb-6">
                <div class="bg-amber-50 text-amber-600 p-3 rounded-2xl shadow-sm shadow-amber-100">
                    <i data-lucide="package" class="w-6 h-6"></i>
                </div>
                <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                    <button onclick="openEditModal('editOrderModal', 'editOrderForm', {{ $order }})" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all"><i data-lucide="pencil" class="w-4 h-4"></i></button>
                    <button onclick="confirmDelete('{{ route('orders.destroy', $order->id) }}', 'Order {{ $order->order_number }}')" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                </div>
            </div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] mb-1">Purchase Order</p>
                <h4 class="text-xl font-black text-slate-800 leading-tight uppercase">{{ $order->order_number }}</h4>
                <p class="text-sm text-slate-500 font-medium mt-1">{{ $order->item_name }}</p>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-between relative z-10 text-slate-400 text-[11px] font-medium italic">
            <span>Added {{ $order->created_at->format('d M Y') }}</span>
            <i data-lucide="info" class="w-3 h-3"></i>
        </div>
    </div>
    @empty
    @endforelse
</div>