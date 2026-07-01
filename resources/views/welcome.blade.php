@extends('layouts.utama')

@push('styles')
<style>
.home-section{
    padding:72px 0 24px;
    background:linear-gradient(180deg,#f8fafc 0%,#eef7f1 100%);
}
.section-eyebrow{
    color:#15803d;
    font-size:.78rem;
    font-weight:700;
    letter-spacing:.12em;
    text-transform:uppercase;
}
.section-title{
    color:#0f172a;
    font-weight:700;
    margin-bottom:8px;
}
.section-subtitle{
    color:#64748b;
    max-width:620px;
}
.agenda-card,.news-card{
    border:0;
    border-radius:24px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 18px 45px rgba(15,23,42,.08);
    transition:.25s ease;
    height:100%;
}
.agenda-card:hover,.news-card:hover{
    transform:translateY(-6px);
    box-shadow:0 24px 60px rgba(15,23,42,.14);
}
.agenda-card img,.news-card img{
    width:100%;
    height:210px;
    object-fit:cover;
}
.card-body-professional{
    padding:24px;
}
.badge-upcoming{background:#dbeafe;color:#1d4ed8;}
.badge-active{background:#dcfce7;color:#166534;}
.badge-finish{background:#fee2e2;color:#dc2626;}
.info-line{
    display:flex;
    gap:10px;
    align-items:center;
    color:#64748b;
    font-size:.93rem;
    margin-bottom:8px;
}
.info-line i{color:#15803d;width:18px;}
.cta-card{
    border-radius:28px;
    padding:28px;
    background:linear-gradient(135deg,#14532d,#16a34a);
    color:#fff;
    box-shadow:0 22px 50px rgba(22,101,52,.24);
}
.cta-card .btn{
    border-radius:999px;
    font-weight:700;
    padding:12px 20px;
}
.empty-state{
    border:1px dashed #cbd5e1;
    border-radius:24px;
    padding:42px;
    text-align:center;
    color:#64748b;
    background:#fff;
}
</style>
@endpush

@section('content')
<section class="home-section">
    <div class="container">
        <div class="row align-items-end mb-4 g-3">
            <div class="col-lg-8">
                <div class="section-eyebrow">Informasi Desa</div>
                <h2 class="section-title">Agenda Kegiatan Desa</h2>
                <p class="section-subtitle mb-0">Pantau kegiatan terbaru desa, lokasi acara, dan jadwal pelayanan masyarakat dalam satu halaman.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ url('kegiatan') }}" class="btn btn-success rounded-pill px-4">
                    Lihat Semua Agenda <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        @if($agendas->count())
        <div class="row g-4 mb-5">
            @foreach($agendas as $item)
            <div class="col-md-6 col-xl-4">
                <article class="agenda-card">
                    <img src="{{ $item->gambar ? Storage::url($item->gambar) : 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $item->judul }}">
                    <div class="card-body-professional">
                        @if($item->status == 'Akan Datang')
                            <span class="badge rounded-pill badge-upcoming mb-3">Akan Datang</span>
                        @elseif($item->status == 'Berlangsung')
                            <span class="badge rounded-pill badge-active mb-3">Berlangsung</span>
                        @else
                            <span class="badge rounded-pill badge-finish mb-3">Selesai</span>
                        @endif
                        <h5 class="fw-bold mb-3 text-dark">{{ $item->judul }}</h5>
                        <div class="info-line"><i class="fa-solid fa-calendar"></i><span>{{ $item->tanggal }}</span></div>
                        <div class="info-line"><i class="fa-solid fa-location-dot"></i><span>{{ $item->lokasi }}</span></div>
                        <div class="info-line mb-4"><i class="fa-solid fa-clock"></i><span>{{ $item->jam }}</span></div>
                        <button class="btn btn-outline-success w-100 rounded-pill fw-semibold">Ikut Serta</button>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state mb-5">
            <i class="fa-solid fa-calendar-xmark fa-2x mb-3 text-success"></i>
            <h5 class="fw-bold text-dark">Belum ada agenda</h5>
            <p class="mb-0">Agenda kegiatan desa akan tampil setelah admin menambahkan data.</p>
        </div>
        @endif

        <div class="row g-4 align-items-stretch">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <div class="section-eyebrow">Kabar Terkini</div>
                        <h2 class="section-title mb-0">Berita & Pengumuman</h2>
                    </div>
                    <a href="{{ url('berita') }}" class="btn btn-light border rounded-pill px-4">Lihat Berita</a>
                </div>
                <div class="row g-4">
                    @forelse($beritas as $berita)
                    <div class="col-md-6">
                        <article class="news-card">
                            <img src="{{ $berita->gambar ? Storage::url($berita->gambar) : 'https://picsum.photos/600/360?4' }}" alt="{{ $berita->judul }}">
                            <div class="card-body-professional">
                                <span class="badge rounded-pill text-bg-success mb-3">{{ $berita->kategori }}</span>
                                <h5 class="fw-bold">{{ $berita->judul }}</h5>
                                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($berita->konten, 90) }}</p>
                            </div>
                        </article>
                    </div>
                    @empty
                    <div class="col-12">
                        <article class="empty-state">
                            <h5 class="fw-bold text-dark mb-2">Belum ada berita</h5>
                            <p class="mb-0">Berita desa akan tampil setelah admin menambahkan konten.</p>
                        </article>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cta-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <i class="fa-solid fa-headset fa-2x mb-3"></i>
                        <h3 class="fw-bold">Butuh Layanan Desa?</h3>
                        <p class="mb-4 opacity-75">Ajukan pengaduan, cek informasi pelayanan, dan akses data desa dengan mudah.</p>
                    </div>
                    <a href="{{ route('pengaduan.landing') }}" class="btn btn-warning text-dark">Buat Pengaduan</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
