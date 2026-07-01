@extends('layouts.admin')

@section('title','Pengaturan Peta Desa')
@section('header','Pengaturan Peta')

@section('content')

<div class="card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,.05);">
    <h3 style="color:#166534; margin-bottom: 20px;">Link Google Maps Embed</h3>

    @if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div style="background: #f8fafc; padding: 20px; border-radius: 10px; border-left: 4px solid #f59e0b; margin-bottom: 25px; font-size: 14px; color: #475569;">
        <strong><i class="fa-solid fa-circle-info"></i> Petunjuk:</strong>
        <p class="mb-0 mt-2">
            Pastikan Anda menggunakan link <strong>"Embed a map"</strong> (Sematkan peta) dari Google Maps, BUKAN link share (bagikan) biasa.
            <br><br>
            <strong>Cara mendapatkan link embed:</strong><br>
            1. Buka Google Maps dan cari lokasi desa.<br>
            2. Klik tombol "Bagikan" (Share).<br>
            3. Pilih tab "Sematkan peta" (Embed a map).<br>
            4. Klik "Salin HTML" (Copy HTML).<br>
            5. Paste (tempel) kodenya ke Notepad sementara, lalu ambil URL yang ada di dalam <code>src="..."</code>.<br>
            Contoh: <code>https://www.google.com/maps/embed?pb=!1m18...</code>
        </p>
    </div>

    <form action="{{ route('admin.settings.peta.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">URL Embed Map (src iframe):</label>
            <input type="url" name="map_embed_url" value="{{ old('map_embed_url', $mapLink) }}" class="form-control" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px;" placeholder="https://www.google.com/maps/embed?pb=..." required>
            @error('map_embed_url')
                <div style="color: #ef4444; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" style="background: #16a34a; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: 600; cursor: pointer;">
            <i class="fa-solid fa-save"></i> Simpan Peta
        </button>
    </form>
</div>

@if($mapLink)
<div class="card" style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,.05); margin-top: 25px;">
    <h3 style="color:#166534; margin-bottom: 20px;">Pratinjau Peta Saat Ini</h3>
    <iframe src="{{ $mapLink }}" width="100%" height="450" style="border:0; border-radius:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
@endif

@endsection
