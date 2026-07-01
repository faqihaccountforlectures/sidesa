@extends('layouts.utama')

@section('title','Layanan Manual')

@section('content')

<style>
.content {
    padding-top: 2rem;
    margin: auto;
    width: 90%;
}

.manual-header{
    background:linear-gradient(135deg,#16a34a,#166534);
    color:#fff;
    padding:70px 30px;
    border-radius:20px;
    text-align:center;
    margin-bottom:40px;
}

.manual-header h1{
    font-size:40px;
    margin-bottom:10px;
}

.manual-header p{
    opacity:.9;
    font-size:16px;
}

/* INFO */

.info-box{
    background:#fff;
    border-left:5px solid #16a34a;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    margin-bottom:35px;
}

.info-box h3{
    color:#166534;
    margin-bottom:10px;
}

.info-box p{
    color:#555;
    line-height:1.8;
}

/* GRID */

.service-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:25px;
}

.service-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
}

.service-card:hover{
    transform:translateY(-8px);
}

.card-header{
    background:linear-gradient(135deg,#22c55e,#16a34a);
    color:white;
    padding:25px;
    text-align:center;
}

.card-header i{
    font-size:45px;
    margin-bottom:15px;
}

.card-header h3{
    font-size:22px;
}

.card-body{
    padding:25px;
}

.card-body h4{
    color:#166534;
    margin-bottom:12px;
}

.card-body ul{
    padding-left:18px;
    margin-bottom:20px;
}

.card-body li{
    margin-bottom:8px;
    color:#555;
}

.btn-service{
    display:block;
    text-align:center;
    text-decoration:none;
    background:#16a34a;
    color:white;
    padding:12px;
    border-radius:10px;
    transition:.3s;
    font-weight:600;
}

.btn-service:hover{
    background:#166534;
}

/* JAM */

.schedule{
    margin-top:50px;
    background:white;
    border-radius:20px;
    padding:35px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.schedule h2{
    color:#166534;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,
table td{
    padding:15px;
    border-bottom:1px solid #eee;
    text-align:left;
}

table th{
    background:#f0fdf4;
    color:#166534;
}

.note{
    margin-top:20px;
    background:#fff8e1;
    padding:15px;
    border-left:5px solid orange;
    border-radius:10px;
    color:#555;
}

</style>
<div class="content">
<div class="manual-header">

    <h1>
        <i class="fa-solid fa-building"></i>
        Panduan Layanan Manual Desa
    </h1>

    <p>
        Pelayanan administrasi yang dilakukan secara langsung di Kantor Desa.
    </p>

</div>

<div class="info-box">

    <h3>
        <i class="fa-solid fa-circle-info"></i>
        Informasi
    </h3>

    <p>
        Panduan Layanan Manual Desa ini berisi informasi mengenai jenis layanan yang tersedia, persyaratan yang diperlukan, serta prosedur yang harus diikuti untuk mendapatkan layanan. Layanan manual merupakan pelayanan yang mengharuskan masyarakat datang langsung ke Kantor Desa dengan membawa seluruh persyaratan administrasi yang diperlukan. Pastikan dokumen telah lengkap agar proses pelayanan dapat berjalan dengan cepat.
    </p>

</div>

<div class="service-grid">

    @foreach($services as $slug => $service)
    <div class="service-card">
        <div class="card-header">
            <i class="fa-solid {{ $service['icon'] }}"></i>
            <h3>{{ $service['name'] }}</h3>
        </div>
        <div class="card-body">
            <h4>Persyaratan Umum</h4>
            <ul>
                @foreach($service['syarat_umum'] as $syarat)
                <li>{{ $syarat }}</li>
                @endforeach
            </ul>
            <a href="{{ route('layanan.manual.detail', $slug) }}" class="btn-service">
                Lihat Detail
            </a>
        </div>
    </div>
    @endforeach

</div>

<div class="schedule">

    <h2>
        <i class="fa-solid fa-clock"></i>
        Jam Pelayanan
    </h2>

    <table>

        <tr>
            <th>Hari</th>
            <th>Jam Pelayanan</th>
        </tr>

        <tr>
            <td>Senin - Kamis</td>
            <td>08.00 - 15.00 WIB</td>
        </tr>

        <tr>
            <td>Jumat</td>
            <td>08.00 - 11.30 WIB</td>
        </tr>

        <tr>
            <td>Sabtu</td>
            <td>08.00 - 12.00 WIB</td>
        </tr>

        <tr>
            <td>Minggu</td>
            <td>Tutup</td>
        </tr>

    </table>

    <div class="note">
        <strong>Catatan :</strong>
        Mohon membawa dokumen asli untuk proses verifikasi oleh petugas desa.
    </div>

</div>
</div>
@endsection
