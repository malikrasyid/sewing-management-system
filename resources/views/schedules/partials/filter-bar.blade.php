<form action="{{ route('schedules.index') }}" method="GET" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200 mb-6">
    <div class="flex flex-wrap lg:flex-nowrap items-center gap-4">
        
        <div class="flex-1 min-w-[300px] relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                <i data-lucide="search" class="w-4 h-4"></i>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari PO, Item, atau Nama Line..." 
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
        </div>

        <div class="w-full lg:w-48 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="factory" class="w-4 h-4"></i>
            </div>
            <select name="line_id" onchange="this.form.submit()" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none appearance-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                <option value="">Semua Line</option>
                @foreach($lines as $line)
                    <option value="{{ $line->id }}" {{ request('line_id') == $line->id ? 'selected' : '' }}>
                        {{ $line->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="w-full lg:w-48 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i data-lucide="calendar" class="w-4 h-4"></i>
            </div>
            <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                   class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-500/20">
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200 flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4"></i>
                <span>Filter</span>
            </button>
            
            @if(request()->anyFilled(['search', 'line_id', 'date']))
                <a href="{{ route('schedules.index') }}" class="p-2.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all" title="Reset Filter">
                    <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
                </a>
            @endif
        </div>
    </div>
</form>