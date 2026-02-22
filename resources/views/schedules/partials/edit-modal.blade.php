<x-modal id="editScheduleModal" title="Edit Production Schedule">
    <form id="editScheduleForm" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Sewing Line</label>
            <select name="line_id" id="edit_line_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($lines as $l)
                    <option value="{{ $l->id }}">{{ $l->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Order / PO</label>
            <select name="order_id" id="edit_order_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($orders as $o)
                    <option value="{{ $o->id }}">{{ $o->order_number }} - {{ $o->item_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Start Date</label>
                <input type="date" name="start_sewing" id="edit_start_sewing" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">End Date</label>
                <input type="date" name="finish_sewing" id="edit_finish_sewing" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Total Quantity Target</label>
            <input type="number" name="qty_total_target" id="edit_qty_total_target" required min="1" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-4 flex gap-3">
            <button type="button" onclick="toggleModal('editScheduleModal')" class="flex-1 px-4 py-2 text-slate-500 font-bold text-sm">Cancel</button>
            <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Update Schedule</button>
        </div>
    </form>
</x-modal>

@push('scripts')
<script>
    document.getElementById('editScheduleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        Swal.fire({ title: 'Updating Schedule...', didOpen: () => Swal.showLoading() });

        axios.put(`/schedules/${id}`, data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(res => {
            Swal.fire({ icon: 'success', title: 'Updated!', text: res.data.message, timer: 1500, showConfirmButton: false })
            .then(() => location.reload());
        })
        .catch(err => {
            Swal.fire('Error', err.response?.data?.message || 'Gagal update jadwal.', 'error');
        });
    });
</script>
@endpush