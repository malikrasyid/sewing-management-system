<x-modal id="addScheduleModal" title="Add New Production Schedule">
    <form id="addScheduleForm" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Select Line</label>
            <select name="line_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Choose Line --</option>
                @foreach($lines as $l)
                    <option value="{{ $l->id }}">{{ $l->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Select Order</label>
            <select name="order_id" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Choose Order --</option>
                @foreach($orders as $o)
                    <option value="{{ $o->id }}">{{ $o->order_number }} - {{ $o->item_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Start Date</label>
                <input type="date" name="start_sewing" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">End Date</label>
                <input type="date" name="finish_sewing" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Total Quantity</label>
            <input type="number" name="qty_total_target" required min="1" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="pt-4 flex gap-3">
            <button type="button" onclick="toggleModal('addScheduleModal')" class="flex-1 px-4 py-2 border border-slate-200 text-slate-600 rounded-lg font-bold text-sm hover:bg-slate-50">Cancel</button>
            <button type="submit" class="flex-1 px-4 py-2 bg-slate-900 text-white rounded-lg font-bold text-sm hover:bg-slate-800 transition">Save</button>
        </div>
    </form>
</x-modal>

@push('scripts')
<script>
    document.getElementById('addScheduleForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        Swal.fire({ title: 'Menyimpan...', didOpen: () => Swal.showLoading(), allowOutsideClick: false });

        axios.post("{{ route('schedules.store') }}", data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(res => {
            Swal.fire({ icon: 'success', title: 'Berhasil!', timer: 1500, showConfirmButton: false })
            .then(() => location.reload());
        })
        .catch(err => {
            const errMsg = err.response?.data?.message || 'Terjadi kesalahan.';
            Swal.fire({ icon: 'error', title: 'Gagal', text: errMsg });
        });
    });
</script>
@endpush