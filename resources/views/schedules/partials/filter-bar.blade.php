<div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-8">
    <form action="{{ route('schedules.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
        <div class="flex-1 min-w-[250px]">
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-wider">Cari Order</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="No. PO atau Nama Barang..." 
                   class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500 transition">
        </div>

        <div class="w-56">
            <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-wider">Filter Line</label>
            <select name="line_id" class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Line</option>
                @foreach($lines as $l)
                    <option value="{{ $l->id }}" {{ request('line_id') == $l->id ? 'selected' : '' }}>{{ $l->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-slate-900 text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-slate-800 transition shadow-sm">
                Terapkan
            </button>
            @if(request()->anyFilled(['search', 'line_id']))
                <a href="{{ route('schedules.index') }}" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-slate-200 transition">Reset</a>
            @endif
        </div>
    </form>
</div>