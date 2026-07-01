@extends('layouts.utama')

@section('title','Layanan Online')

@section('content')

<style>

.layanan-section{
    width:90%;
    margin:40px auto;
}

/* HEADER */

.hero-layanan{
    background:linear-gradient(135deg,#16a34a,#166534);
    color:white;
    padding:45px;
    border-radius:25px;
    text-align:center;
    margin-bottom:35px;
    box-shadow:0 15px 35px rgba(22,163,74,.25);
}

.hero-layanan h1{
    font-size:38px;
    margin-bottom:10px;
}

.hero-layanan p{
    font-size:16px;
    opacity:.9;
}

/* GRID */

.layanan-grid{

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;

}

.card-layanan{

    background:white;
    border-radius:20px;
    padding:30px;
    text-align:center;
    transition:.35s;
    box-shadow:0 8px 20px rgba(0,0,0,.08);

}

.card-layanan:hover{

    transform:translateY(-8px);

    box-shadow:0 18px 35px rgba(0,0,0,.15);

}

.icon{

    width:90px;
    height:90px;
    margin:auto;
    border-radius:50%;
    background:#ecfdf5;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;

}

.icon i{

    font-size:42px;
    color:#16a34a;

}

.card-layanan h3{

    margin-bottom:12px;
    color:#166534;

}

.card-layanan p{

    color:#666;
    line-height:1.7;
    margin-bottom:25px;

}

.btn-layanan{

    display:inline-block;
    text-decoration:none;
    background:#16a34a;
    color:white;
    padding:12px 25px;
    border-radius:30px;
    transition:.3s;
    font-weight:600;

}

.btn-layanan:hover{

    background:#14532d;

}

/* INFO */

.info-box{

    margin-top:50px;
    background:#fff;
    border-left:6px solid #16a34a;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);

}

.info-box h3{

    color:#166534;
    margin-bottom:15px;

}

.info-box ul{

    margin-left:20px;
    color:#555;
    line-height:2;

}

@media(max-width:768px){

.hero-layanan{
    padding:30px 20px;
}

.hero-layanan h1{
    font-size:28px;
}

}

</style>

<section class="layanan-section">

    <div class="hero-layanan">

        <h1>
            <i class="fa-solid fa-laptop-file"></i>
            Layanan Online Desa
        </h1>

        <p>
            Ajukan berbagai pelayanan administrasi desa secara online,
            mudah, cepat, dan tanpa harus datang ke kantor desa.
        </p>

    </div>

    <div class="layanan-grid">

        @foreach($services as $slug => $service)
        <div class="card-layanan">
            <div class="icon">
                <i class="fa-solid {{ $service['icon'] }}"></i>
            </div>
            <h3>{{ $service['name'] }}</h3>
            <p>
                Pengajuan {{ strtolower($service['name']) }} secara online.
            </p>
            <a href="{{ auth()->check() ? (auth()->user()->role === 'warga' ? route('user.pengajuan.create', $slug) : route('admin.dashboard')) : route('auth.login') }}" class="btn-layanan">
                Ajukan
            </a>
        </div>
        @endforeach

    </div>

    <div class="info-box">

        <h3>
            <i class="fa-solid fa-circle-info"></i>
            Informasi Pelayanan
        </h3>

        <ul>
            <li>Pastikan data diri yang dimasukkan sudah benar.</li>
            <li>Unggah dokumen pendukung apabila diperlukan.</li>
            <li>Permohonan akan diverifikasi oleh perangkat desa.</li>
            <li>Status pengajuan dapat dipantau melalui akun warga.</li>
            <li>Surat yang telah selesai dapat diambil di kantor desa atau diunduh jika tersedia.</li>
        </ul>

    </div>

</section>

@endsection
