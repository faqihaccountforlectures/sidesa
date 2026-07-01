@extends('layouts.utama')

@section('title','Struktur Organisasi Desa')

@section('content')

<style>

.page-header{
    background:linear-gradient(135deg,#16a34a,#166534);
    color:white;
    padding:60px 30px;
    border-radius:20px;
    text-align:center;
    margin-bottom:40px;
}

.page-header h1{
    font-size:38px;
    margin-bottom:10px;
}

.page-header p{
    opacity:.9;
}

/* Struktur */

.organisasi{
    max-width:1200px;
    margin:auto;
    text-align:center;
}

/* Card */

.org-card{
    width:220px;
    background:white;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
    margin:auto;
}

.org-card:hover{
    transform:translateY(-8px);
}

.org-card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.org-card .body{
    padding:18px;
}

.org-card h3{
    color:#166534;
    margin-bottom:5px;
}

.org-card p{
    color:#666;
    font-size:14px;
}

/* Garis */

.line{
    width:3px;
    height:45px;
    background:#16a34a;
    margin:auto;
}

.line-horizontal{
    width:80%;
    height:3px;
    background:#16a34a;
    margin:auto;
}

/* Sekretaris */

.second-row{
    display:flex;
    justify-content:center;
    gap:80px;
    margin:40px 0;
}

/* Kasi */

.third-row{
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
    margin-top:40px;
}

.section-title{
    margin:60px 0 30px;
    color:#166534;
    text-align:center;
}

.section-title h2{
    font-size:30px;
}

.bottom-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    margin-top:30px;
}

.bottom-card{
    background:white;
    border-radius:18px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
}

.bottom-card:hover{
    transform:translateY(-6px);
}

.bottom-card i{
    font-size:40px;
    color:#16a34a;
    margin-bottom:15px;
}

.bottom-card h4{
    color:#166534;
    margin-bottom:8px;
}

.bottom-card p{
    color:#666;
    font-size:14px;
}

/* Responsive */

@media(max-width:768px){

.second-row{
    flex-direction:column;
    align-items:center;
}

.third-row{
    flex-direction:column;
    align-items:center;
}

.line-horizontal{
    display:none;
}

}

</style>

<div class="page-header">

    <h1>
        <i class="fa-solid fa-sitemap"></i>
        Struktur Organisasi Desa
    </h1>

    <p>
        Susunan Pemerintahan Desa Medangasem
    </p>

</div>


<div class="organisasi">

    <!-- Kepala Desa -->

    <div class="org-card">

        <img src="{{ $kades && $kades->foto ? Storage::url($kades->foto) : 'https://i.pravatar.cc/100' }}">

        <div class="body">

            <h3>{{ $kades ? $kades->jabatan : 'Kepala Desa' }}</h3>

            <p>{{ $kades ? $kades->nama : 'Belum diatur' }}</p>

        </div>

    </div>

    <div class="line"></div>

    <div class="line-horizontal"></div>

    <!-- Sekretaris -->

    <div class="second-row">

        <div class="org-card">

            <img src="{{ $sekdes && $sekdes->foto ? Storage::url($sekdes->foto) : 'https://i.pravatar.cc/400?img=12' }}">

            <div class="body">

                <h3>{{ $sekdes ? $sekdes->jabatan : 'Sekretaris Desa' }}</h3>

                <p>{{ $sekdes ? $sekdes->nama : 'Belum diatur' }}</p>

            </div>

        </div>

    </div>

    <div class="line"></div>

    <!-- Kasi -->

    <div class="third-row">

        @forelse($perangkat as $p)
        <div class="org-card">

            <img src="{{ $p->foto ? Storage::url($p->foto) : 'https://i.pravatar.cc/400?img=25' }}">

            <div class="body">

                <h3>{{ $p->jabatan }}</h3>

                <p>{{ $p->nama }}</p>

            </div>

        </div>
        @empty
            <p>Data perangkat desa lainnya belum diatur.</p>
        @endforelse

    </div>

</div>

<div class="section-title">

    <h2>Perangkat Desa Lainnya</h2>

</div>

<div class="bottom-grid">

    <div class="bottom-card">

        <i class="fa-solid fa-users"></i>

        <h4>Kepala Dusun</h4>

        <p>Mengelola pemerintahan di wilayah dusun.</p>

    </div>

    <div class="bottom-card">

        <i class="fa-solid fa-building-columns"></i>

        <h4>BPD</h4>

        <p>Badan Permusyawaratan Desa sebagai mitra pemerintah desa.</p>

    </div>

    <div class="bottom-card">

        <i class="fa-solid fa-hand-holding-heart"></i>

        <h4>LPM</h4>

        <p>Lembaga Pemberdayaan Masyarakat Desa.</p>

    </div>

    <div class="bottom-card">

        <i class="fa-solid fa-people-group"></i>

        <h4>PKK</h4>

        <p>Pemberdayaan dan Kesejahteraan Keluarga.</p>

    </div>

    <div class="bottom-card">

        <i class="fa-solid fa-house"></i>

        <h4>Ketua RW</h4>

        <p>Mengkoordinasikan seluruh RT di wilayahnya.</p>

    </div>

    <div class="bottom-card">

        <i class="fa-solid fa-location-dot"></i>

        <h4>Ketua RT</h4>

        <p>Melayani administrasi masyarakat tingkat RT.</p>

    </div>

</div>

@endsection