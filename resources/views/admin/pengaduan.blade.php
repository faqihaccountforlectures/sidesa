@extends('layouts.admin')

@section('title', 'Data Pengaduan')
@section('header', 'Data Pengaduan Masyarakat')

@section('content')

<!-- Stat Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">

    <div class="content-card border-l-4 border-blue-500 flex flex-col justify-center hover:-translate-y-1 transition-transform">
        <h3 class="text-sm font-bold text-slate-500 mb-2">Total Pengaduan</h3>
        <h1 class="text-4xl font-black text-slate-800 m-0">{{ $pengaduan->count() }}</h1>
    </div>

    <div class="content-card border-l-4 border-amber-500 flex flex-col justify-center hover:-translate-y-1 transition-transform">
        <h3 class="text-sm font-bold text-slate-500 mb-2">Diproses</h3>
        <h1 class="text-4xl font-black text-amber-600 m-0">{{ $pengaduan->where('status','Diproses')->count() }}</h1>
    </div>

    <div class="content-card border-l-4 border-emerald-500 flex flex-col justify-center hover:-translate-y-1 transition-transform">
        <h3 class="text-sm font-bold text-slate-500 mb-2">Selesai</h3>
        <h1 class="text-4xl font-black text-emerald-600 m-0">{{ $pengaduan->where('status','Selesai')->count() }}</h1>
    </div>

    <div class="content-card border-l-4 border-red-500 flex flex-col justify-center hover:-translate-y-1 transition-transform">
        <h3 class="text-sm font-bold text-slate-500 mb-2">Ditolak</h3>
        <h1 class="text-4xl font-black text-red-600 m-0">{{ $pengaduan->where('status','Ditolak')->count() }}</h1>
    </div>
    
    <div class="content-card flex flex-col items-center justify-center bg-gradient-to-br from-sidesa-600 to-sidesa-800 text-white border-0 shadow-lg shadow-sidesa-600/30">
        <i class="fa-solid fa-file-export text-3xl mb-2 opacity-80"></i>
        <span class="font-semibold text-sm">Export Data</span>
        <button class="mt-2 text-xs bg-white/20 hover:bg-white/30 px-4 py-1.5 rounded-full transition-colors font-bold backdrop-blur-sm">Download PDF</button>
    </div>

</div>

<!-- Main Data Card -->
<div class="content-card overflow-hidden !p-0">
    <div class="p-6 border-b border-slate-100 bg-white flex flex-col sm:flex-row justify-between items-center gap-4">
        <h3 class="text-lg font-bold text-slate-800 m-0"><i class="fa-solid fa-list-check text-sidesa-500 mr-2"></i>Daftar Laporan Masuk</h3>
        
        <div class="relative w-full sm:w-64">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" placeholder="Cari NIK atau Nama..." class="w-full bg-slate-50 border border-slate-200 text-sm rounded-lg focus:ring-sidesa-500 focus:border-sidesa-500 block pl-10 p-2.5 transition-colors">
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/80">
                    <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200">#</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200">Pelapor</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200">Kategori</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200">Tanggal</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200 text-center">Status</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-200 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @foreach($pengaduan as $index => $item)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 text-sm text-slate-600 font-medium">
                        {{ $pengaduan->firstItem() + $index }}
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-sidesa-100 text-sidesa-700 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-800 text-sm m-0">{{ $item->nama }}</h4>
                                <span class="text-xs text-slate-500">{{ $item->nik }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                            @if($item->kategori == 'Infrastruktur') <i class="fa-solid fa-road"></i>
                            @elseif($item->kategori == 'Pelayanan') <i class="fa-solid fa-users-gear"></i>
                            @elseif($item->kategori == 'Keamanan') <i class="fa-solid fa-shield-halved"></i>
                            @else <i class="fa-solid fa-tag"></i> @endif
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-sm text-slate-600">
                        <div class="flex flex-col">
                            <span class="font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                            <span class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        @if($item->status == 'Diproses')
                            <span class="inline-flex px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold border border-amber-200">
                                <i class="fa-solid fa-spinner fa-spin mr-1.5"></i> Diproses
                            </span>
                        @elseif($item->status == 'Selesai')
                            <span class="inline-flex px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold border border-emerald-200">
                                <i class="fa-solid fa-check mr-1.5"></i> Selesai
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold border border-red-200">
                                <i class="fa-solid fa-xmark mr-1.5"></i> Ditolak
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors" title="Lihat Detail">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                
                @if($pengaduan->count() == 0)
                <tr>
                    <td colspan="6" class="py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <i class="fa-solid fa-inbox text-5xl mb-4 text-slate-300"></i>
                            <p class="text-lg font-medium">Belum ada data pengaduan masuk.</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end">
        {{ $pengaduan->links('pagination::tailwind') }}
    </div>
</div>

@endsection
