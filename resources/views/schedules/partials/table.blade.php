<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Line</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Order</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Periode</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Target</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Aktual</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($schedules as $item)
            @php
                $start = \Carbon\Carbon::parse($item->start_sewing);
                $finish = \Carbon\Carbon::parse($item->finish_sewing);
                $days = $start->diffInDays($finish) + 1;
                $rem = $item->qty_total_target % $days;
            @endphp
            <tr class="hover:bg-slate-50/50 transition">
                <td class="px-6 py-4 font-bold text-slate-700">{{ $item->line->name }}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-blue-600">{{ $item->order->order_number }}</div>
                    <div class="text-[11px] text-slate-400">{{ $item->order->item_name }}</div>
                </td>
                <td class="px-6 py-4 text-xs">
                    <div class="font-medium">{{ $item->start_sewing }}</div>
                    <div class="text-blue-600 font-bold italic">sampai {{ $item->finish_sewing }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold">{{ $item->daily_target_output }} <span class="text-[10px] text-slate-400 font-normal">/hari</span></div>
                    @if($rem > 0) <div class="text-[10px] text-amber-600">Terakhir: {{ $item->daily_target_output + $rem }}</div> @endif
                </td>
                <td class="px-6 py-4">
                    <input type="number" id="actual-{{ $item->id }}" value="{{ $item->actual_output }}"
                           class="w-20 bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm outline-none focus:ring-2 focus:ring-blue-400">
                </td>
                <td class="px-6 py-4 text-center">
                    <button onclick="updateActual({{ $item->id }})" class="text-xs font-bold text-slate-600 border border-slate-200 px-3 py-1.5 rounded hover:bg-slate-900 hover:text-white transition">UPDATE</button>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-12 text-center text-slate-400 italic text-sm">Data schedule tidak ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    function updateActual(id) {
        const val = document.getElementById(`actual-${id}`).value;
        
        Swal.fire({ title: 'Memproses Balancing...', didOpen: () => Swal.showLoading(), allowOutsideClick: false });

        axios.patch(`/schedules/${id}/actual`, { actual_output: val }, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        })
        .then(res => {
            Swal.fire({ icon: 'success', title: 'Updated!', timer: 1000, showConfirmButton: false })
            .then(() => location.reload());
        })
        .catch(err => {
            Swal.fire('Error', 'Gagal update balancing.', 'error');
        });
    }
</script>
@endpush