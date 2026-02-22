<x-modal id="editLineModal" title="Edit Sewing Line">
    <form id="editLineForm" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Line Name</label>
            <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="pt-4 flex gap-3">
            <button type="button" onclick="toggleModal('editLineModal')" class="flex-1 px-4 py-2 text-slate-500 font-bold text-sm">Cancel</button>
            <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg font-bold text-sm hover:bg-blue-700">Update Line</button>
        </div>
    </form>
</x-modal>

@push('scripts')
<script>
    document.getElementById('editLineForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const data = { name: this.name.value };

        axios.put(`/lines/${id}`, data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(() => location.reload())
        .catch(err => Swal.fire('Error', 'Nama line mungkin sudah digunakan.', 'error'));
    });
</script>
@endpush