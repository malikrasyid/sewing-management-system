<x-modal id="addLineModal" title="Tambah Line Baru">
    <form id="addLineForm" class="space-y-4">
        <div>
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-wider">Nama / Kode Line</label>
            <input type="text" name="name" required placeholder="Contoh: Line 01 atau Sewing-A" 
                   class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="pt-2 flex gap-3">
            <button type="button" onclick="toggleModal('addLineModal')" class="flex-1 px-4 py-2 text-slate-500 font-bold text-sm">Batal</button>
            <button type="submit" class="flex-1 bg-slate-900 text-white py-2 rounded-lg font-bold text-sm hover:bg-slate-800 transition shadow-lg shadow-slate-200">
                Simpan Line
            </button>
        </div>
    </form>
</x-modal>

@push('scripts')
<script>
    document.getElementById('addLineForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(this).entries());

        Swal.fire({ title: 'Menyimpan...', didOpen: () => Swal.showLoading() });

        axios.post("{{ route('lines.store') }}", data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(() => {
            Swal.fire({ icon: 'success', title: 'Berhasil!', timer: 1000, showConfirmButton: false })
            .then(() => location.reload());
        })
        .catch(err => {
            const msg = err.response?.data?.message || 'Gagal menyimpan. Nama line mungkin sudah ada.';
            Swal.fire('Gagal', msg, 'error');
        });
    });
</script>
@endpush