@props(['id', 'title'])

<div id="{{ $id }}" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all border border-slate-200">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800">{{ $title }}</h3>
            <button onclick="toggleModal('{{ $id }}')" class="text-slate-400 hover:text-slate-600 font-bold text-2xl transition-colors">&times;</button>
        </div>
        
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>