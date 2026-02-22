<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">No. PO / Order</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Barang (Item)</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($orders as $order)
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-6 py-4">
                    <span class="font-bold text-blue-600">{{ $order->order_number }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600">
                    {{ $order->item_name }}
                </td>
                <td class="px-6 py-4 text-center">
                    <button onclick="deleteOrder({{ $order->id }}, '{{ $order->order_number }}')" 
                            class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-md transition text-xs font-bold">
                        HAPUS
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic">Belum ada data order.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    function deleteOrder(id, name) {
        Swal.fire({
            title: 'Hapus Order?',
            text: `Anda akan menghapus ${name}. Schedule terkait juga akan hilang!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/orders/${id}`, {
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                }).then(() => location.reload());
            }
        });
    }
</script>
@endpush