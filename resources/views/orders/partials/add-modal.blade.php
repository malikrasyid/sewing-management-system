<x-modal id="addOrderModal" title="Tambah Order Baru">
    <form id="addOrderForm" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-wider">Nomor PO / Order</label>
            <input type="text" name="order_number" required placeholder="Contoh: PO-2026-001" 
                   class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-wider">Nama Barang</label>
            <input type="text" name="item_name" required placeholder="Contoh: T-Shirt Premium XL" 
                   class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="pt-2 flex gap-3">
            <button type="button" onclick="toggleModal('addOrderModal')" class="flex-1 px-4 py-2 text-slate-500 font-bold text-sm">Batal</button>
            <button type="submit" class="flex-1 bg-slate-900 text-white py-2 rounded-lg font-bold text-sm hover:bg-slate-800 transition">Simpan Order</button>
        </div>
    </form>
</x-modal>

@push('scripts')
<script>
    document.getElementById('addOrderForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(this).entries());

        axios.post("{{ route('orders.store') }}", data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(() => location.reload())
        .catch(err => {
            Swal.fire('Gagal', err.response.data.message || 'Cek nomor PO (mungkin duplikat)', 'error');
        });
    });
</script>
@endpush