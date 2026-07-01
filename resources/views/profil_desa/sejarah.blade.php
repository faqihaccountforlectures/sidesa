<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sejarah Desa</title>

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
    linear-gradient(rgba(0,0,0,.55),
    rgba(0,0,0,.55)),
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
    opacity:.9;
}

/* CONTAINER */

.container{
    width:90%;
    max-width:1200px;
    margin:auto;
    padding:60px 0;
}

/* STORY */

.story{
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    margin-bottom:40px;
}

.story h2{
    color:#166534;
    margin-bottom:20px;
}

.story p{
    line-height:1.9;
    color:#555;
    text-align:justify;
}

/* TIMELINE */

.section-title{
    text-align:center;
    margin-bottom:50px;
}

.section-title h2{
    color:#166534;
    font-size:35px;
}

.timeline{
    position:relative;
    margin:50px auto;
}

.timeline::before{
    content:'';
    position:absolute;
    left:50%;
    top:0;
    width:4px;
    height:100%;
    background:#16a34a;
    transform:translateX(-50%);
}

.timeline-item{
    width:50%;
    padding:20px 40px;
    position:relative;
}

.timeline-item:nth-child(odd){
    left:0;
    text-align:right;
}

.timeline-item:nth-child(even){
    left:50%;
}

.timeline-content{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.timeline-content h3{
    color:#166534;
    margin-bottom:10px;
}

.timeline-item::before{
    content:'';
    width:20px;
    height:20px;
    background:#16a34a;
    border-radius:50%;
    position:absolute;
    top:30px;
    right:-10px;
}

.timeline-item:nth-child(even)::before{
    left:-10px;
}

/* GALERI */

.gallery{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-top:30px;
}

.gallery img{
    width:100%;
    height:250px;
    object-fit:cover;
    border-radius:15px;
    transition:.3s;
}

.gallery img:hover{
    transform:scale(1.03);
}

/* TOKOH */

.tokoh{
    margin-top:60px;
}

.tokoh-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
}

.tokoh-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.tokoh-card img{
    width:100%;
    height:280px;
    object-fit:cover;
}

.tokoh-card h3{
    margin-top:15px;
    color:#166534;
}

.tokoh-card p{
    padding:10px 20px 20px;
    color:#666;
}

@media(max-width:768px){

    .timeline::before{
        left:20px;
    }

    .timeline-item{
        width:100%;
        left:0 !important;
        text-align:left;
        padding-left:60px;
    }

    .timeline-item::before{
        left:10px !important;
    }

    .gallery,
    .tokoh-grid{
        grid-template-columns:1fr;
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
    <h1>Sejarah Desa Medangasem</h1>
    <p>Menelusuri perjalanan panjang desa dari masa ke masa</p>
</div>

</section>
    <!-- CERITA -->
    <div class="story">

        <h2>Awal Berdirinya Desa</h2>

        <p>
            Desa Medangasem merupakan salah satu desa yang memiliki
            sejarah panjang dalam perkembangan wilayah pedesaan.
            Berdasarkan cerita para sesepuh, desa ini bermula dari
            pemukiman kecil yang dibangun oleh para pendatang yang
            membuka lahan pertanian dan perkebunan.

            Seiring berjalannya waktu, jumlah penduduk terus bertambah
            hingga terbentuk pemerintahan desa yang resmi dan menjadi
            pusat kegiatan masyarakat hingga saat ini.
        </p>

    </div>

    <!-- TIMELINE -->
    <div class="section-title">
        <h2>Perjalanan Desa</h2>
    </div>

    <div class="timeline">

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>1905</h3>
                <p>Pembukaan wilayah pemukiman pertama.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>1925</h3>
                <p>Pembangunan balai desa pertama.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>1960</h3>
                <p>Desa mulai berkembang menjadi pusat pertanian.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>1998</h3>
                <p>Pembangunan jalan utama desa.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-content">
                <h3>2026</h3>
                <p>Transformasi menuju Desa Digital.</p>
            </div>
        </div>

    </div>

    <!-- GALERI -->
    <div class="section-title">
        <h2>Galeri Sejarah</h2>
    </div>

    <div class="gallery">

        <img src="https://picsum.photos/500/300?1">
        <img src="https://picsum.photos/500/300?2">
        <img src="https://picsum.photos/500/300?3">

    </div>

    <!-- TOKOH -->
    <div class="tokoh">

        <div class="section-title">
            <h2>Tokoh Berjasa</h2>
        </div>

        <div class="tokoh-grid">

            <div class="tokoh-card">
                <img src="https://picsum.photos/400/500?4">
                <h3>Bapak Ahmad</h3>
                <p>Pelopor pembukaan wilayah desa.</p>
            </div>

            <div class="tokoh-card">
                <img src="https://picsum.photos/400/500?5">
                <h3>Bapak Hasan</h3>
                <p>Tokoh pembangunan desa tahun 1960.</p>
            </div>

            <div class="tokoh-card">
                <img src="https://picsum.photos/400/500?6">
                <h3>Bapak Rahmat</h3>
                <p>Penggagas program desa digital.</p>
            </div>

        </div>

    </div>

</div>
    @endsection

</body>
</html>