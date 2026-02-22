<div class="space-y-4">
    @forelse($schedules as $item)
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 p-6 hover:border-emerald-400 transition-all group relative overflow-hidden flex flex-wrap lg:flex-nowrap items-center gap-8">
        
        <div class="absolute -right-4 -bottom-4 text-emerald-50 opacity-10 group-hover:scale-110 transition-transform">
            <i data-lucide="calendar-check" class="w-32 h-32"></i>
        </div>

        <div class="w-full lg:w-40 flex-shrink-0 relative z-10 border-r border-slate-100 pr-4">
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1">Line Unit</p>
            <h4 class="text-xl font-black text-slate-800">{{ $item->line->name }}</h4>
        </div>

        <div class="flex-1 relative z-10">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Order Details</p>
            <h4 class="text-sm font-bold text-slate-800 uppercase">{{ $item->order->order_number }}</h4>
            <p class="text-xs text-slate-500 font-medium">{{ $item->order->item_name }}</p>
        </div>

        <div class="w-full lg:w-56 bg-slate-50 rounded-2xl p-4 flex items-center justify-between border border-slate-100 relative z-10">
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase">Target Daily</p>
                <p class="text-lg font-black text-slate-800">{{ number_format($item->daily_target_output) }} <span class="text-[10px] text-slate-400 font-bold uppercase">Pcs</span></p>
            </div>
            <div class="w-px h-8 bg-slate-200"></div>
            <div class="text-right">
                <p class="text-[9px] font-black text-blue-500 uppercase">Actual</p>
                <input type="number" value="{{ $item->actual_output }}" onchange="updateActual({{ $item->id }}, this.value)"
                       class="w-20 bg-transparent text-right text-lg font-black text-blue-600 focus:outline-none border-none p-0">
            </div>
        </div>

        <div class="flex lg:flex-col gap-2 relative z-10 opacity-0 group-hover:opacity-100 transition-all">
            <button onclick="openEditModal('editScheduleModal', 'editScheduleForm', {{ $item }})" class="p-2.5 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all">
                <i data-lucide="pencil" class="w-4 h-4"></i>
            </button>
            <button onclick="confirmDelete('{{ route('schedules.destroy', $item->id) }}', 'Jadwal {{ $item->order->order_number }}')" class="p-2.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
            </button>
        </div>
    </div>
    @empty
    @endforelse
</div>