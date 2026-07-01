@extends('layouts.utama')

@section('title', 'Detail Layanan - ' . $service['name'])

@section('content')
<style>
.content {
    padding-top: 2rem;
    margin: auto;
    width: 90%;
    max-width: 800px;
}

.detail-header {
    background: linear-gradient(135deg, #16a34a, #166534);
    color: #fff;
    padding: 50px 30px;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 40px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.detail-header i {
    font-size: 50px;
    margin-bottom: 15px;
}

.detail-header h1 {
    font-size: 36px;
    margin-bottom: 10px;
}

.detail-header p {
    opacity: .9;
    font-size: 16px;
}

.detail-box {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,.08);
    margin-bottom: 30px;
}

.detail-box h3 {
    color: #166534;
    margin-bottom: 15px;
    border-bottom: 2px solid #f0fdf4;
    padding-bottom: 10px;
}

.detail-box ul {
    padding-left: 20px;
}

.detail-box li {
    margin-bottom: 10px;
    color: #555;
    line-height: 1.6;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.info-item {
    background: #f0fdf4;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.info-item h4 {
    color: #16a34a;
    margin-bottom: 5px;
}

.info-item p {
    color: #333;
    font-weight: bold;
    font-size: 18px;
    margin: 0;
}

.btn-back {
    display: inline-block;
    background: #e5e7eb;
    color: #374151;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: .3s;
    margin-bottom: 20px;
}

.btn-back:hover {
    background: #d1d5db;
}

.langkah-box ol {
    padding-left: 20px;
}
.langkah-box li {
    margin-bottom: 10px;
    color: #555;
}

</style>

<div class="content">

    <a href="{{ route('layanan.manual') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Layanan
    </a>

    <div class="detail-header">
        <i class="fa-solid {{ $service['icon'] }}"></i>
        <h1>{{ $service['name'] }}</h1>
        <p>{{ $service['desc'] }}</p>
    </div>

    <div class="info-grid" style="margin-bottom: 30px;">
        <div class="info-item">
            <h4>Estimasi Waktu</h4>
            <p><i class="fa-solid fa-clock"></i> {{ $service['estimasi'] }}</p>
        </div>
        <div class="info-item">
            <h4>Biaya</h4>
            <p><i class="fa-solid fa-rupiah-sign"></i> {{ $service['biaya'] }}</p>
        </div>
    </div>

    <div class="detail-box">
        <h3>Persyaratan Umum</h3>
        <ul>
            @foreach($service['syarat_umum'] as $syarat)
            <li>{{ $syarat }}</li>
            @endforeach
        </ul>
    </div>

    @if(!empty($service['syarat_khusus']))
    <div class="detail-box">
        <h3>Persyaratan Khusus</h3>
        <ul>
            @foreach($service['syarat_khusus'] as $syarat)
            <li>{{ $syarat }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="detail-box langkah-box">
        <h3>Langkah Pengurusan</h3>
        <ol>
            <li>Siapkan seluruh berkas persyaratan umum dan khusus (asli & fotokopi).</li>
            <li>Datang ke Kantor Desa pada jam operasional layanan.</li>
            <li>Ambil nomor antrean dan tunggu panggilan dari petugas pelayanan.</li>
            <li>Serahkan berkas persyaratan ke petugas untuk diverifikasi.</li>
            <li>Jika berkas lengkap dan sesuai, petugas akan memproses permohonan.</li>
            <li>Terima dokumen / surat yang telah dilegalisasi atau ditandatangani oleh Kepala Desa.</li>
        </ol>
    </div>

    <div class="detail-box" style="text-align: center;">
        <h3>Kontak Kantor Desa</h3>
        <p>Jika ada pertanyaan lebih lanjut mengenai layanan ini, silakan hubungi Kantor Desa.</p>
        <p style="font-size: 20px; font-weight: bold; color: #166534; margin-top: 10px;">
            <i class="fa-solid fa-phone"></i> (021) 12345678
        </p>
    </div>

</div>
@endsection
