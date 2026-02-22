<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider w-20">ID</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Line</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($lines as $line)
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-6 py-4 text-sm text-slate-400 font-mono">#{{ $line->id }}</td>
                <td class="px-6 py-4">
                    <span class="font-bold text-slate-700">{{ $line->name }}</span>
                </td>
                <td class="px-6 py-4 text-center">
                    <button onclick="deleteLine({{ $line->id }}, '{{ $line->name }}')" 
                            class="text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-md transition text-xs font-bold">
                        HAPUS
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic">Belum ada data line sewing.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    function deleteLine(id, name) {
        Swal.fire({
            title: 'Hapus Line?',
            text: `Anda akan menghapus ${name}. Tindakan ini tidak bisa dibatalkan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/lines/${id}`, {
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                })
                .then(() => {
                    Swal.fire({ icon: 'success', title: 'Dihapus!', timer: 1000, showConfirmButton: false })
                    .then(() => location.reload());
                })
                .catch(err => Swal.fire('Error', 'Gagal menghapus data.', 'error'));
            }
        });
    }
</script>
@endpush