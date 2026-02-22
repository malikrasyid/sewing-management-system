<x-modal id="editOrderModal" title="Edit Purchase Order">
    <form id="editOrderForm" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Order Number (PO)</label>
            <input type="text" name="order_number" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Item Name</label>
            <input type="text" name="item_name" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="pt-4 flex gap-3">
            <button type="button" onclick="toggleModal('editOrderModal')" class="flex-1 px-4 py-2 text-slate-500 font-bold text-sm">Cancel</button>
            <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-bold text-sm hover:bg-blue-700 transition">Update Order</button>
        </div>
    </form>
</x-modal>

@push('scripts')
<script>
    document.getElementById('editOrderForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const data = Object.fromEntries(new FormData(this).entries());

        axios.put(`/orders/${id}`, data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        }).then(() => location.reload());
    });
</script>
@endpush