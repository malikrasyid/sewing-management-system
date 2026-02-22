<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($lines as $line)
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 hover:border-indigo-400 transition-all group relative overflow-hidden flex flex-col justify-between">
        
        <div class="absolute -right-6 -bottom-6 text-indigo-50 opacity-10 group-hover:scale-110 transition-transform">
            <i data-lucide="factory" class="w-24 h-24"></i>
        </div>

        <div>
            <div class="flex justify-between items-start mb-6">
                <div class="bg-indigo-50 text-indigo-600 p-3 rounded-2xl shadow-sm shadow-indigo-100">
                    <i data-lucide="factory" class="w-6 h-6"></i>
                </div>
                
                <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                    <button onclick="openEditModal('editLineModal', 'editLineForm', {{ $line }})" 
                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all"
                            title="Edit Line">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </button>
                    
                    <button onclick="confirmDelete('{{ route('lines.destroy', $line->id) }}', 'Line {{ $line->name }}')" 
                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all"
                            title="Hapus Line">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <div class="relative z-10">
                <p class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-1">Production Unit</p>
                <h4 class="text-2xl font-black text-slate-800 leading-tight">
                    {{ $line->name }}
                </h4>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-between relative z-10">
            <div class="flex items-center text-slate-400 text-[11px] font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                Ready for production
            </div>
            <span class="text-[10px] font-mono text-slate-300">ID: {{ str_pad($line->id, 3, '0', STR_PAD_LEFT) }}</span>
        </div>
    </div>
    @empty
    <div class="col-span-full py-24 flex flex-col items-center justify-center bg-white rounded-[2rem] border-2 border-dashed border-slate-200">
        <div class="bg-slate-50 p-6 rounded-full mb-4">
            <i data-lucide="layers-2" class="w-12 h-12 text-slate-200"></i>
        </div>
        <p class="text-slate-500 font-bold">No sewing lines found.</p>
        <p class="text-slate-400 text-sm">Mulai dengan menambahkan line produksi baru.</p>
    </div>
    @endforelse
</div>