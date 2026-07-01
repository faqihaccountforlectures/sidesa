@extends('layouts.admin')

@section('title', 'Agenda Desa')
@section('header', 'Agenda Desa')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div class="page-title">
        <p class="text-slate-500 m-0">Kelola seluruh kegiatan dan agenda desa</p>
    </div>

    <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sidesa-600 text-white font-semibold hover:bg-sidesa-700 shadow-sm transition-colors">
        <i class="fa-solid fa-plus"></i> Tambah Agenda
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="content-card flex items-center justify-between !p-6">
        <div>
            <h3 class="text-sm font-semibold text-slate-500 mb-1">Total Agenda</h3>
            <h1 class="text-3xl font-bold text-slate-800 m-0">{{ $agenda->count() }}</h1>
        </div>
        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-xl">
            <i class="fa-regular fa-calendar"></i>
        </div>
    </div>

    <div class="content-card flex items-center justify-between !p-6 border-b-4 border-b-blue-500">
        <div>
            <h3 class="text-sm font-semibold text-slate-500 mb-1">Akan Datang</h3>
            <h1 class="text-3xl font-bold text-slate-800 m-0">{{ $agenda->where('status','Akan Datang')->count() }}</h1>
        </div>
        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center text-xl">
            <i class="fa-regular fa-calendar-plus"></i>
        </div>
    </div>

    <div class="content-card flex items-center justify-between !p-6 border-b-4 border-b-emerald-500">
        <div>
            <h3 class="text-sm font-semibold text-slate-500 mb-1">Selesai</h3>
            <h1 class="text-3xl font-bold text-slate-800 m-0">{{ $agenda->where('status','Selesai')->count() }}</h1>
        </div>
        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl">
            <i class="fa-regular fa-calendar-check"></i>
        </div>
    </div>
</div>

<div class="relative w-full mb-8">
    <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
    <input type="text" placeholder="Cari agenda desa..." class="w-full bg-white border border-slate-200 text-slate-700 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block pl-10 p-3.5 transition-colors shadow-sm">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

    @foreach($agenda as $item)
    <div class="content-card !p-0 overflow-hidden flex flex-col">
        
        <div class="relative h-48">
            @if($item->gambar)
                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
            @else
                <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Default Image" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent"></div>
            
            <div class="absolute top-3 right-3">
                @if($item->status == 'Akan Datang')
                    <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-xs font-semibold shadow-sm">Akan Datang</span>
                @elseif($item->status == 'Berlangsung')
                    <span class="px-3 py-1 bg-amber-500 text-white rounded-full text-xs font-semibold shadow-sm">Berlangsung</span>
                @else
                    <span class="px-3 py-1 bg-slate-500 text-white rounded-full text-xs font-semibold shadow-sm">Selesai</span>
                @endif
            </div>
        </div>

        <div class="p-5 flex-1 flex flex-col">
            <h3 class="text-lg font-bold text-slate-800 mb-3 line-clamp-2 leading-tight">{{ $item->judul }}</h3>

            <div class="space-y-2.5 mb-5 flex-1">
                <div class="flex items-center gap-2.5 text-sm text-slate-600">
                    <i class="fa-solid fa-calendar w-5 text-sidesa-500 text-center"></i>
                    <span>{{ $item->tanggal }}</span>
                </div>
                
                <div class="flex items-center gap-2.5 text-sm text-slate-600">
                    <i class="fa-solid fa-clock w-5 text-sidesa-500 text-center"></i>
                    <span>{{ $item->jam }}</span>
                </div>
                
                <div class="flex items-start gap-2.5 text-sm text-slate-600">
                    <i class="fa-solid fa-location-dot w-5 text-sidesa-500 text-center mt-0.5"></i>
                    <span class="line-clamp-2">{{ $item->lokasi }}</span>
                </div>
            </div>

            <div class="flex items-center gap-2 mt-auto pt-4 border-t border-slate-100">
                <a href="{{ route('admin.agenda.edit', $item->id) }}" class="flex-1 text-center py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors font-medium text-sm">
                    Edit
                </a>

                <form action="{{ route('admin.agenda.destroy', $item->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-center py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors font-medium text-sm cursor-pointer" onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?');">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

    </div>
    @endforeach

</div>

<div class="mt-8">
    {{ $agenda->links() }}
</div>

@endsection
