<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDESA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{
    --village-primary:#166534;
    --village-secondary:#d97706;
    --village-dark:#0f172a;
    --village-muted:#64748b;
    --village-soft:#f8fafc;
}
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f8fafc;color:var(--village-dark);}
a{text-decoration:none;}
.hero-header{
    min-height:560px;
    background:linear-gradient(120deg,rgba(15,23,42,.78),rgba(22,101,52,.58)),url('https://images.unsplash.com/photo-1511578314322-379afb476865?w=1600');
    background-size:cover;
    background-position:center;
    position:relative;
}
.topbar{
    position:absolute;
    top:24px;
    left:50%;
    transform:translateX(-50%);
    width:min(1180px,calc(100% - 32px));
    padding:14px 18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.18);
    border-radius:22px;
    backdrop-filter:blur(14px);
    box-shadow:0 24px 60px rgba(15,23,42,.18);
    z-index:5;
}
.site-info{display:flex;align-items:center;gap:12px;color:white;}
.site-info img,.hero-logo{filter:drop-shadow(0 8px 18px rgba(0,0,0,.22));}
.site-info img{width:48px;height:48px;object-fit:contain;}
.site-info h4{font-size:15px;font-weight:700;margin:0;}
.site-info small{font-size:12px;opacity:.82;}
.top-right{display:flex;align-items:center;gap:12px;}
.search-box{display:flex;background:#fff;border-radius:999px;overflow:hidden;border:1px solid rgba(255,255,255,.35);}
.search-box input{border:0;padding:10px 14px;width:230px;outline:0;font-size:14px;}
.search-box button{background:var(--village-secondary);border:0;color:white;width:44px;}
.login a{width:44px;height:44px;display:grid;place-items:center;color:white;background:rgba(255,255,255,.14);border-radius:50%;font-size:20px;transition:.25s;}
.login a:hover{background:#fff;color:var(--village-primary);}
.hero-content{min-height:560px;display:flex;flex-direction:column;justify-content:center;align-items:center;color:white;text-align:center;padding:120px 16px 80px;}
.hero-logo{width:96px;margin-bottom:18px;}
.hero-content h1{font-size:clamp(42px,7vw,78px);font-weight:800;line-height:1.05;letter-spacing:-.04em;color:#facc15;margin:0;}
.hero-content span{display:inline-block;color:#fff;font-size:clamp(28px,4vw,52px);font-weight:700;margin-top:8px;}
.menu{
    width:min(1180px,calc(100% - 32px));
    margin:-34px auto 0;
    position:relative;
    z-index:10;
    background:#fff;
    display:flex;
    justify-content:center;
    flex-wrap:wrap;
    border-radius:22px;
    box-shadow:0 18px 45px rgba(15,23,42,.12);
    padding:8px;
    list-style:none;
}
.menu a,.dropdown > a{color:#334155;text-decoration:none;padding:13px 16px;font-size:14px;font-weight:600;border-radius:16px;transition:.25s;display:block;}
.menu a:hover,.dropdown:hover > a{background:#ecfdf5;color:var(--village-primary);}
.dropdown{position:relative;list-style:none;}
.dropdown > a::after{content:'\f107';font-family:'Font Awesome 6 Free';font-weight:900;font-size:11px;margin-left:8px;}
.submenu{position:absolute;top:115%;left:0;min-width:250px;background:#fff;border:1px solid #e2e8f0;border-radius:18px;box-shadow:0 20px 50px rgba(15,23,42,.14);list-style:none;padding:8px;opacity:0;visibility:hidden;transform:translateY(8px);transition:.25s ease;z-index:999;}
.dropdown:hover .submenu{opacity:1;visibility:visible;transform:translateY(0);top:100%;}
.submenu a{padding:11px 14px;color:#475569;font-size:14px;border-radius:12px;}
.submenu a:hover{background:#f0fdf4;color:var(--village-primary);padding-left:18px;}
footer{margin-top:0;background:#0f3d2e;padding:38px 10%;display:flex;justify-content:space-between;gap:24px;color:white;}
footer h4{font-size:18px;font-weight:700;margin-bottom:12px;}
footer p{margin-bottom:6px;color:rgba(255,255,255,.78);}
footer i{font-size:22px;margin-right:12px;cursor:pointer;color:#facc15;}
@media(max-width:991px){
    .topbar{position:relative;top:16px;transform:none;left:auto;flex-direction:column;gap:14px;}
    .search-box input{width:180px;}
    .menu{margin-top:16px;}
    .submenu{position:static;display:none;box-shadow:none;border:0;background:#f8fafc;margin-top:4px;}
    .dropdown:hover .submenu{display:block;}
    footer{flex-direction:column;}
}
</style>
@stack('styles')
</head>
<body>
<!-- NAVBAR -->
<header class="hero-header">

    <div class="topbar">

        <div class="site-info">
            <img src="{{ asset('gambar/logo-desa.png') }}" alt="Logo Desa">
            <div>
                <h4>Website Resmi Desa</h4>
                <small>Kec. Medangasem, Kab. Karawang</small>
            </div>
        </div>

        <div class="top-right">

            <div class="search-box">
                <input type="text" placeholder="Cari Berita">
                <button>
                    <i class="fas fa-search"></i>
                </button>
            </div>

           <div class="login">
    @guest
        <a href="{{ route('auth.login') }}">
            <i class="bi bi-person-fill-lock"></i>
        </a>
    @else
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" title="Ke Dashboard Admin">
                <i class="bi bi-person-circle user-icon text-primary"></i>
            </a>
        @else
            <a href="{{ route('profile') }}">
                <i class="bi bi-person-circle user-icon"></i>
            </a>
        @endif
    @endguest
</div>

        </div>

    </div>

    <div class="hero-content">


        <img src="{{ asset('gambar/logo-desa.png') }}" class="hero-logo" alt="Logo Desa">
        <h1>SIDESA <br><span> Desa Medangasem</span></h1>

    </div>

</header>

<nav class="menu">
    <a href="/">Beranda</a>
    <div class="dropdown">
        <a href="#">Profil Desa</a>
        <ul class="submenu">
            <li><a href="/sejarah">Sejarah Desa</a></li>
            <li><a href="/visi_misi">Visi & Misi</a></li>
            <li><a href="/struktur-organisasi">Struktur Organisasi</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <a href="#">Pemerintahan</a>
        <ul class="submenu">
            <li><a href="/ketuaRW">Ketua RW</a></li>
            <li><a href="/ketuaRT">Ketua RT</a></li>
            <li><a href="/pkk">PKK</a></li>
            <li><a href="/lpm">LPM</a></li>
            <li><a href="/bpd">BPD</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <a href="#">Layanan</a>
        <ul class="submenu">
            <li><a href="/layanan-manual">Layanan Manual</a></li>
            <li><a href="/layanan-online">Layanan online</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <a href="#">Status IDM</a>
        <ul class="submenu">
            <li><a href="/statusIDM26">Status IDM 2026</a></li>
            <li><a href="/statusIDM25">Status IDM 2025</a></li>
        </ul>
    </div>
    <a href="{{ route('pengaduan.landing') }}">Pengaduan</a>
    <a href="/peta">Peta</a>
    <a href="/kegiatan">Kegiatan</a>
    <a href="/berita">Berita</a>
</nav>
@yield('content')
<!-- FOOTER -->
<footer>

<div>
<h4>Kontak Desa</h4>
<p>+62 812345678</p>
<p>desamedangasem@gmail.com</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

