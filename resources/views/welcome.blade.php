<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIKADES - Portal Desa</title>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    *{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f4f7f9;
}

/* NAVBAR */

header{
background:white;
padding:15px 8%;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}

nav a{
text-decoration:none;
color:#333;
margin:0 12px;
font-weight:500;
}

.login a{
    display:flex;
    align-items:center;
    gap:8px;
    padding:2px 5px;
    color: black;
    text-decoration:none;
    border-radius:50px;
    font-weight:600;
    transition:.3s;
}

.login a:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(22,163,74,.3);
}

.login i{
    font-size:16px;
}

/* HERO */

.hero{
height:500px;
background:url('https://images.unsplash.com/photo-1506744038136-46273834b3fb')
center/cover;
position:relative;
}

.overlay{
background:rgba(0,0,0,.45);
height:100%;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
text-align:center;
color:white;
padding:20px;
}

.overlay h1{
font-size:48px;
max-width:800px;
}

.overlay p{
margin:15px 0;
}

.overlay button{
padding:15px 30px;
border:none;
border-radius:30px;
background:white;
font-weight:bold;
cursor:pointer;
}

/* STAT */

.stats{
width:80%;
margin:-50px auto 40px;
display:flex;
gap:20px;
position:relative;
z-index:10;
}

.card{
flex:1;
padding:20px;
border-radius:15px;
color:white;
display:flex;
align-items:center;
gap:15px;
box-shadow:0 8px 20px rgba(0,0,0,.15);
}

.card i{
font-size:35px;
}

.orange{
background:#f89b29;
}

.blue{
background:#3b82f6;
}

.green{
background:#10b981;
}

/* LAYOUT */

.container{
width:85%;
margin:auto;
display:grid;
grid-template-columns:3fr 1fr;
gap:30px;
}

.content h2{
margin-bottom:20px;
}

.agenda-grid{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin-bottom:40px;
}

.agenda-card{
background:white;
border-radius:15px;
overflow:hidden;
box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.agenda-card img{
width:100%;
height:180px;
object-fit:cover;
}

.body{
padding:15px;
}

.body h3{
margin-bottom:10px;
}

.body button{
margin-top:10px;
width:100%;
padding:10px;
border:none;
background:#0097a7;
color:white;
border-radius:25px;
cursor:pointer;
}

/* BERITA */

.news-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
}

.news-card{
background:white;
border-radius:15px;
overflow:hidden;
box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.news-card img{
width:100%;
height:180px;
object-fit:cover;
}

/* ASPIRASI */

.aspirasi{
background:linear-gradient(
135deg,
#0f4cdd,
#0b66ff
);

padding:20px;
border-radius:15px;
color:white;
position:sticky;
top:20px;
}

.aspirasi h3{
margin-bottom:20px;
}

.aspirasi input,
.aspirasi textarea{
width:100%;
padding:12px;
border:none;
border-radius:8px;
margin-bottom:12px;
}

.aspirasi textarea{
height:120px;
resize:none;
}

.aspirasi button{
width:100%;
padding:12px;
border:none;
background:orange;
color:white;
border-radius:25px;
font-weight:600;
}

/* FOOTER */

footer{
margin-top:60px;
background:#00838f;
padding:30px 10%;
display:flex;
justify-content:space-between;
color:white;
}

footer i{
font-size:22px;
margin-right:10px;
cursor:pointer;
}

/* RESPONSIVE */

@media(max-width:991px){

.container{
grid-template-columns:1fr;
}

.stats{
flex-direction:column;
}

.agenda-grid{
grid-template-columns:1fr;
}

.news-grid{
grid-template-columns:1fr;
}

header{
flex-direction:column;
gap:15px;
}

.overlay h1{
font-size:32px;
}

footer{
flex-direction:column;
gap:20px;
}

}
</style>
</head>

<body>

<!-- NAVBAR -->
<header>

<div class="logo">
    <h2>SIDESA</h2>
</div>

<nav>
    <a href="#">Beranda</a>
    <a href="#">Profil</a>
    <a href="#">Kegiatan</a>
    <a href="#">Struktur Organisasi</a>
</nav>

<div class="login">
    <a href="#">
                <i class="fas fa-user-lock"></i>
    </a>
</div>

</header>

<!-- HERO -->
<section class="hero">

<div class="overlay">

    <h1>SIDESA <br> Desa Medangasem</h1>

    <p>
        Mewujudkan Desa yang Transparan, Aktif,
        dan Gotong Royong
    </p>

    <button>
        PENGAJUAN MITRA
    </button>

</div>

</section>

<!-- STATISTIK -->
<section class="stats">

<div class="card orange">
    <i class="fa-solid fa-calendar-days"></i>
    <div>
        <h2>24 Hari Lagi</h2>
        <p>Kegiatan Yang Akan datang</p>
    </div>
</div>

<div class="card blue">
    <i class="fa-solid fa-users"></i>
    <div>
        <h2>150</h2>
        <p>Partisipasi</p>
    </div>
</div>

<div class="card green">
    <i class="fa-solid fa-chart-line"></i>
    <div>
        <h2>5</h2>
        <p>Program Unggulan</p>
    </div>
</div>

</section>

<div class="container">

<!-- KONTEN -->
<div class="content">

<h2>Agenda Kegiatan Desa</h2>

<div class="agenda-grid">

<div class="agenda-card">

<img src="https://picsum.photos/300/180?1">

<div class="body">
<h3>Kerja Bakti</h3>

<p>
<i class="fa-solid fa-calendar"></i>
20 Juni 2026
</p>

<p>
<i class="fa-solid fa-location-dot"></i>
Dusun 3
</p>

<p>
<i class="fa-solid fa-clock"></i>
07:00
</p>

<button>Ikut Serta</button>

</div>

</div>

<div class="agenda-card">

<img src="https://picsum.photos/300/180?2">

<div class="body">
<h3>Posyandu Balita</h3>

<p>22 Juni 2026</p>
<p>Balai Desa</p>
<p>09:00</p>

<button>Lihat Jadwal</button>

</div>

</div>

<div class="agenda-card">

<img src="https://picsum.photos/300/180?3">

<div class="body">
<h3>Musrenbangdes</h3>

<p>23 Juni 2026</p>
<p>Kantor Desa</p>
<p>13:00</p>

<button>Detail</button>

</div>

</div>

</div>

<h2>Berita & Pengumuman</h2>

<div class="news-grid">

<div class="news-card">
<img src="https://picsum.photos/300/180?4">
<div class="body">
<h4>Berita Desa</h4>
<p>Kegiatan masyarakat berjalan lancar.</p>
</div>
</div>

<div class="news-card">
<img src="https://picsum.photos/300/180?5">
<div class="body">
<h4>Posyandu Balita</h4>
<p>Meningkatkan kesehatan balita.</p>
</div>
</div>

</div>

</div>

<!-- SIDEBAR -->
<aside>

<div class="aspirasi">

<h3>Hubungi Aspirasi Anda</h3>

<form>

<input type="text"
placeholder="Nama">

<input type="email"
placeholder="Email">

<textarea
placeholder="Pesan"></textarea>

<button type="submit">
Kirim
</button>

</form>

</div>

</aside>

</div>

<!-- FOOTER -->
<footer>

<div>
<h4>Kontak Desa</h4>
<p>+62 812345678</p>
<p>desa@example.com</p>
</div>

<div>
<h4>Alamat</h4>
<p>Jl. Desa Mekar Mulya No.1</p>
</div>

<div>
<h4>Sosial Media</h4>
<i class="fa-brands fa-facebook"></i>
<i class="fa-brands fa-instagram"></i>
<i class="fa-brands fa-youtube"></i>
</div>

</footer>

</body>
</html>