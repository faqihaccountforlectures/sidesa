@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')

<!-- Main Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['total_penduduk'] ?? 2163, 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Total Penduduk</p>
        </div>
    </div>

    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['total_surat'], 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Pengajuan Surat</p>
        </div>
    </div>

    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-comments"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['total_pengaduan'], 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Total Pengaduan</p>
        </div>
    </div>

    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-purple-50 text-purple-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['total_agenda'], 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Agenda Desa</p>
        </div>
    </div>
</div>

<!-- Pengaduan Summary -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-slate-800 m-0">Statistik Pengaduan</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="content-card border-l-4 border-slate-400">
            <div class="flex flex-col">
                <span class="text-3xl font-bold text-slate-700 mb-1">{{ number_format($stats['total_pengaduan'], 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-slate-500">Total Pengaduan</span>
            </div>
        </div>
        <div class="content-card border-l-4 border-amber-400">
            <div class="flex flex-col">
                <span class="text-3xl font-bold text-amber-600 mb-1">{{ number_format($stats['pengaduan_diproses'], 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-slate-500">Diproses</span>
            </div>
        </div>
        <div class="content-card border-l-4 border-emerald-400">
            <div class="flex flex-col">
                <span class="text-3xl font-bold text-emerald-600 mb-1">{{ number_format($stats['pengaduan_selesai'], 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-slate-500">Selesai</span>
            </div>
        </div>
        <div class="content-card border-l-4 border-red-400">
            <div class="flex flex-col">
                <span class="text-3xl font-bold text-red-600 mb-1">{{ number_format($stats['pengaduan_ditolak'], 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-slate-500">Ditolak</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Table -->
<div class="content-card overflow-hidden">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-slate-800 m-0">Pengaduan Terbaru</h3>
        <a href="{{ route('admin.pengaduan') }}" class="text-sm font-medium text-sidesa-600 hover:text-sidesa-700 hover:underline">Lihat Semua <i class="fa-solid fa-arrow-right ml-1"></i></a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-sidesa-50/50">
                    <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100 rounded-tl-xl">Pelapor</th>
                    <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100">Kategori</th>
                    <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100">Tanggal</th>
                    <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100 rounded-tr-xl">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduanTerbaru as $item)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="py-4 px-5 border-b border-slate-50">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-sidesa-100 text-sidesa-600 flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                            </div>
                            <span class="font-medium text-slate-700">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td class="py-4 px-5 border-b border-slate-50 text-slate-600 text-sm">
                        {{ ucfirst($item->kategori) }}
                    </td>
                    <td class="py-4 px-5 border-b border-slate-50 text-slate-500 text-sm">
                        {{ $item->created_at->translatedFormat('d F Y') }}
                    </td>
                    <td class="py-4 px-5 border-b border-slate-50">
                        @if($item->status == 'Diproses')
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-semibold">Diproses</span>
                        @elseif($item->status == 'Selesai')
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Selesai</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center gap-3">
                            <i class="fa-solid fa-inbox text-4xl text-slate-300"></i>
                            <p class="m-0">Belum ada pengaduan terbaru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
