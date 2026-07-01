@extends('layouts.user')

@section('title', 'Dashboard Warga')
@section('header', 'Dashboard')

@section('content')

<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-sidesa-700 to-sidesa-800 rounded-3xl p-8 mb-8 text-white shadow-lg relative overflow-hidden">
    <div class="relative z-10 md:w-2/3">
        <h2 class="text-3xl font-bold mb-3">Selamat Datang 👋</h2>
        <p class="text-sidesa-50 text-lg leading-relaxed mb-0">
            Selamat datang di Sistem Informasi Desa (SIDESA).
            Anda dapat mengajukan surat, melihat agenda desa, serta menyampaikan pengaduan secara online dengan mudah.
        </p>
    </div>
    <!-- Decorative element -->
    <div class="absolute right-0 bottom-0 opacity-20 transform translate-x-1/4 translate-y-1/4 hidden md:block">
        <i class="fa-solid fa-seedling" style="font-size: 15rem;"></i>
    </div>
</div>

<!-- Main Stats -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-file-lines"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['surat'] ?? 0, 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Pengajuan Surat</p>
        </div>
    </div>

    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-comments"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['pengaduan'] ?? 0, 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Pengaduan Saya</p>
        </div>
    </div>

    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['agenda'] ?? 0, 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Agenda Aktif</p>
        </div>
    </div>

    <div class="content-card flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
        <div class="w-16 h-16 rounded-2xl bg-purple-50 text-purple-500 flex items-center justify-center text-3xl shadow-sm">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-slate-800 m-0">{{ number_format($stats['berita'] ?? 0, 0, ',', '.') }}</h2>
            <p class="text-sm font-medium text-slate-500 m-0">Berita Desa</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Riwayat Pengaduan -->
    <div class="lg:col-span-2 space-y-6">
        <div class="content-card overflow-hidden h-full">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800 m-0">Riwayat Pengaduan Saya</h3>
                <a href="{{ route('pengaduan.index') }}" class="text-sm font-medium text-sidesa-600 hover:text-sidesa-700 hover:underline">Lihat Semua <i class="fa-solid fa-arrow-right ml-1"></i></a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-sidesa-50/50">
                            <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100 rounded-tl-xl">Kategori</th>
                            <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100">Tanggal</th>
                            <th class="py-4 px-5 text-sm font-semibold text-slate-600 border-b border-slate-100 rounded-tr-xl">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduanTerbaru as $item)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-4 px-5 border-b border-slate-50 text-slate-700 font-medium">
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
                            <td colspan="3" class="py-8 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <i class="fa-solid fa-folder-open text-4xl text-slate-300"></i>
                                    <p class="m-0">Belum ada riwayat pengaduan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Agenda Desa -->
    <div class="lg:col-span-1">
        <div class="content-card h-full">
            <h3 class="text-lg font-bold text-slate-800 mb-6 m-0">Agenda Desa</h3>
            
            <div class="space-y-4">
                @forelse($agendaTerbaru as $agenda)
                <div class="flex items-start gap-4 p-4 rounded-2xl border border-slate-100 hover:border-sidesa-200 hover:bg-sidesa-50/30 transition-colors group cursor-pointer">
                    <div class="w-14 h-14 rounded-xl bg-sidesa-100 text-sidesa-700 flex flex-col items-center justify-center flex-shrink-0 group-hover:bg-sidesa-500 group-hover:text-white transition-colors">
                        <span class="text-xl font-bold leading-none">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d') }}</span>
                        <span class="text-xs font-medium uppercase mt-1">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('M') }}</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 m-0 mb-1 leading-tight line-clamp-2">{{ $agenda->judul }}</h4>
                        <div class="flex items-center gap-1.5 text-xs text-slate-500">
                            <i class="fa-solid fa-location-dot text-sidesa-500"></i>
                            <span class="line-clamp-1">{{ $agenda->lokasi }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fa-regular fa-calendar-xmark text-4xl text-slate-300 mb-3 block"></i>
                    <p class="text-slate-500 m-0">Belum ada agenda desa terbaru.</p>
                </div>
                @endforelse
            </div>
            
            @if(count($agendaTerbaru) > 0)
            <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                <a href="{{ route('kegiatan') }}" class="text-sm font-semibold text-sidesa-600 hover:text-sidesa-700">Lihat Semua Agenda</a>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
