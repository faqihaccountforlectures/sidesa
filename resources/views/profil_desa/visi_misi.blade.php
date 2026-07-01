<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visi & Misi Desa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fb;
}

/* HERO */

.hero{
    height:150px;
    background:
    linear-gradient(rgba(0,0,0,.5),
    rgba(0,0,0,.5)),
    url('https://images.unsplash.com/photo-1506744038136-46273834b3fb');
    background-size:cover;
    background-position:center;
    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:white;
    margin-bottom: 3rem;
    border-radius:20px;
}

.hero h1{
    font-size:50px;
}

.hero p{
    margin-top:10px;
}

/* CONTAINER */

.container{
    width:90%;
    max-width:1200px;
    margin:auto;
    padding:60px 0;
}

/* VISI */

.visi-box{
    background:white;
    padding:40px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    margin-bottom:40px;
}

.visi-icon{
    width:90px;
    height:90px;
    background:#16a34a;
    color:white;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    margin-bottom:20px;
}

.visi-icon i{
    font-size:40px;
}

.visi-box h2{
    color:#166534;
    margin-bottom:20px;
}

.visi-box p{
    font-size:18px;
    color:#555;
    line-height:1.8;
}

/* MISI */

.section-title{
    text-align:center;
    margin-bottom:40px;
}

.section-title h2{
    color:#166534;
    font-size:35px;
}

.misi-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:25px;
}

.misi-card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    display:flex;
    gap:20px;
    transition:.3s;
}

.misi-card:hover{
    transform:translateY(-5px);
}

.nomor{
    min-width:55px;
    height:55px;
    background:#16a34a;
    color:white;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:22px;
    font-weight:bold;
}

.misi-content h3{
    color:#166534;
    margin-bottom:10px;
}

.misi-content p{
    color:#666;
    line-height:1.7;
}

/* PROGRAM */

.program{
    margin-top:60px;
}

.program-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
}

.program-card{
    background:white;
    padding:30px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.program-card i{
    font-size:45px;
    color:#16a34a;
    margin-bottom:15px;
}

.program-card h3{
    color:#166534;
    margin-bottom:10px;
}

.program-card p{
    color:#666;
}

/* RESPONSIVE */

@media(max-width:768px){

    .misi-grid,
    .program-grid{
        grid-template-columns:1fr;
    }

    .hero h1{
        font-size:36px;
    }

}

</style>
</head>
<body>
@extends('layouts.utama')
@section('content')
<!-- HERO -->
<div class="container">
<section class="hero">

    <div>
        <h1>Visi & Misi Desa</h1>
        <p>Membangun Desa yang Maju, Mandiri dan Sejahtera</p>
    </div>

</section>
    <!-- VISI -->
    <div class="visi-box">

        <div class="visi-icon">
            <i class="fa-solid fa-eye"></i>
        </div>

        <h2>Visi Desa</h2>

        <p>
            "Terwujudnya Desa Medangasem yang Maju,
            Mandiri, Transparan, Berbudaya,
            dan Sejahtera melalui pembangunan yang
            berkelanjutan serta partisipasi aktif masyarakat."
        </p>

    </div>

    <!-- MISI -->

    <div class="section-title">
        <h2>Misi Desa</h2>
    </div>

    <div class="misi-grid">

        <div class="misi-card">

            <div class="nomor">1</div>

            <div class="misi-content">
                <h3>Peningkatan Pelayanan Publik</h3>
                <p>
                    Memberikan pelayanan yang cepat,
                    transparan, dan mudah diakses oleh masyarakat.
                </p>
            </div>

        </div>

        <div class="misi-card">

            <div class="nomor">2</div>

            <div class="misi-content">
                <h3>Pemberdayaan Masyarakat</h3>
                <p>
                    Meningkatkan kualitas sumber daya manusia
                    melalui pendidikan dan pelatihan.
                </p>
            </div>

        </div>

        <div class="misi-card">

            <div class="nomor">3</div>

            <div class="misi-content">
                <h3>Pembangunan Infrastruktur</h3>
                <p>
                    Mewujudkan pembangunan yang merata
                    untuk menunjang aktivitas masyarakat.
                </p>
            </div>

        </div>

        <div class="misi-card">

            <div class="nomor">4</div>

            <div class="misi-content">
                <h3>Pelestarian Budaya</h3>
                <p>
                    Menjaga dan melestarikan nilai budaya
                    serta kearifan lokal desa.
                </p>
            </div>

        </div>

    </div>

    <!-- PROGRAM UNGGULAN -->

    <div class="program">

        <div class="section-title">
            <h2>Program Unggulan</h2>
        </div>

        <div class="program-grid">

            <div class="program-card">
                <i class="fa-solid fa-seedling"></i>
                <h3>Desa Hijau</h3>
                <p>
                    Program penghijauan dan pelestarian lingkungan desa.
                </p>
            </div>

            <div class="program-card">
                <i class="fa-solid fa-laptop"></i>
                <h3>Desa Digital</h3>
                <p>
                    Digitalisasi pelayanan dan informasi desa.
                </p>
            </div>

            <div class="program-card">
                <i class="fa-solid fa-hand-holding-heart"></i>
                <h3>Desa Sejahtera</h3>
                <p>
                    Peningkatan ekonomi masyarakat dan UMKM desa.
                </p>
            </div>

        </div>

    </div>

</div>
    @endsection

</body>
</html>