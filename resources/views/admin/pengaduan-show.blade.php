@extends('layouts.admin')

@section('title', 'Detail Pengaduan')
@section('header', 'Detail Pengaduan')

@section('content')

<div class="content-card overflow-hidden">
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-8 p-6">
        <div class="flex-1 space-y-6">
            <div>
                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Informasi Pelapor</h6>
                <p class="text-lg font-bold text-slate-800 m-0">{{ $pengaduan->nama }} <span class="text-sm font-normal text-slate-500">({{ $pengaduan->nik }})</span></p>
            </div>

            <div>
                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Kategori Laporan</h6>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-sidesa-50 text-sidesa-700 border border-sidesa-200">
                    {{ $pengaduan->kategori }}
                </span>
            </div>

            <div>
                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Isi Laporan</h6>
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-slate-700 leading-relaxed text-sm">
                    {{ $pengaduan->laporan }}
                </div>
            </div>

            @if($pengaduan->foto)
            <div>
                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Lampiran Foto</h6>
                <div class="rounded-xl overflow-hidden border border-slate-200 inline-block shadow-sm">
                    <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Laporan" class="max-w-md w-full h-auto object-cover hover:scale-105 transition-transform duration-500">
                </div>
            </div>
            @endif
        </div>

        <div class="w-full md:w-80 space-y-6 border-t md:border-t-0 md:border-l border-slate-200 pt-6 md:pt-0 md:pl-8">
            <div>
                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Status Saat Ini</h6>
                
                @if($pengaduan->status == 'Diproses')
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-center gap-3">
                        <i class="fa-solid fa-spinner fa-spin text-amber-500 text-xl"></i>
                        <span class="font-bold text-amber-700">Sedang Diproses</span>
                    </div>
                @elseif($pengaduan->status == 'Selesai')
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-center gap-3">
                        <i class="fa-solid fa-check-circle text-emerald-500 text-xl"></i>
                        <span class="font-bold text-emerald-700">Telah Selesai</span>
                    </div>
                @else
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center gap-3">
                        <i class="fa-solid fa-xmark-circle text-red-500 text-xl"></i>
                        <span class="font-bold text-red-700">Laporan Ditolak</span>
                    </div>
                @endif
            </div>

            <div class="bg-slate-50 rounded-xl p-5 border border-slate-200">
                <h6 class="text-xs font-bold text-slate-600 uppercase tracking-wider mb-4">Ubah Status</h6>
                <form action="{{ route('admin.pengaduan.updateStatus', $pengaduan->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <select name="status" class="w-full bg-white border border-slate-300 text-slate-700 rounded-lg focus:ring-sidesa-500 focus:border-sidesa-500 block p-2.5 text-sm">
                            <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full text-white bg-sidesa-600 hover:bg-sidesa-700 font-semibold rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
            
            <a href="{{ route('admin.pengaduan') }}" class="inline-block w-full text-center text-slate-600 bg-white border border-slate-300 hover:bg-slate-50 font-semibold rounded-lg text-sm px-5 py-2.5 transition-colors">
                Kembali
            </a>
        </div>
    </div>
</div>

@endsection
