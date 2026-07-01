@extends('layouts.utama')
@section('title', 'Warta Desa Terkini')

@section('content')
<style>
.warta-section {
    padding: 60px 0;
    background-color: #f8fafc;
    min-height: 100vh;
}
.warta-header {
    margin-bottom: 40px;
}
.warta-header h1 {
    font-size: 38px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 15px;
}
.warta-header p {
    font-size: 16px;
    color: #475569;
    max-width: 600px;
    line-height: 1.6;
}

/* Filter Tabs */
.filter-tabs {
    display: flex;
    gap: 12px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.filter-btn {
    border: none;
    padding: 8px 20px;
    border-radius: 20px;
    background: #e2e8f0;
    color: #475569;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.filter-btn:hover, .filter-btn.active {
    background: #0f172a;
    color: white;
}

/* Featured Layout */
.featured-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 25px;
    margin-bottom: 40px;
}
@media (min-width: 992px) {
    .featured-grid {
        grid-template-columns: 2fr 1fr;
    }
}

/* Main Featured Card */
.main-featured-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    height: 100%;
}
.main-featured-img {
    width: 100%;
    height: 350px;
    object-fit: cover;
}
.main-featured-body {
    padding: 30px;
    flex-grow: 1;
}
.badge-category {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    background: #dcfce7;
    color: #166534;
    margin-bottom: 15px;
}
.badge-unggulan {
    background: #1e293b;
    color: white;
}
.main-featured-title {
    font-size: 28px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 15px;
    line-height: 1.3;
}
.warta-meta {
    display: flex;
    gap: 20px;
    color: #64748b;
    font-size: 13px;
    margin-bottom: 15px;
}
.warta-meta i {
    margin-right: 5px;
}
.main-featured-desc {
    color: #475569;
    font-size: 15px;
    line-height: 1.6;
}

/* Sidebar List */
.sidebar-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.sidebar-item {
    background: white;
    border-radius: 16px;
    padding: 15px;
    display: flex;
    gap: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
}
.sidebar-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
.sidebar-img {
    width: 90px;
    height: 90px;
    border-radius: 12px;
    object-fit: cover;
    flex-shrink: 0;
}
.sidebar-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.sidebar-category {
    font-size: 11px;
    font-weight: 700;
    color: #16a34a;
    text-transform: uppercase;
    margin-bottom: 5px;
}
.sidebar-title {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.4;
    margin-bottom: 5px;
}
.sidebar-date {
    font-size: 12px;
    color: #64748b;
}

/* Grid Cards */
.warta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
}
.warta-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
}
.warta-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}
.warta-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.warta-card-body {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.warta-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.warta-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
    margin-bottom: 12px;
}
.warta-card-desc {
    color: #475569;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}
.warta-card-footer {
    border-top: 1px solid #e2e8f0;
    padding-top: 15px;
    font-size: 14px;
    font-weight: 600;
    color: #16a34a;
    display: flex;
    align-items: center;
}
.warta-card-footer i {
    margin-left: 5px;
    transition: transform 0.3s;
}
.warta-card:hover .warta-card-footer i {
    transform: translateX(5px);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 20px;
    grid-column: 1 / -1;
}
.empty-state i {
    font-size: 50px;
    color: #cbd5e1;
    margin-bottom: 15px;
}
.empty-state h3 {
    color: #334155;
    font-weight: 700;
}
</style>

<section class="warta-section">
    <div class="container">
        
        <div class="warta-header">
            <h1>Warta Desa Terkini</h1>
            <p>Dapatkan informasi terbaru mengenai pembangunan, kegiatan sosial, dan pengumuman resmi dari kantor pemerintahan desa kami.</p>
        </div>

        <div class="filter-tabs">
            <button class="filter-btn active" data-filter="semua">Semua</button>
            <button class="filter-btn" data-filter="Pembangunan">Pembangunan</button>
            <button class="filter-btn" data-filter="Kegiatan">Kegiatan</button>
            <button class="filter-btn" data-filter="Pengumuman">Pengumuman</button>
            <button class="filter-btn" data-filter="Kesehatan">Kesehatan</button>
            <button class="filter-btn" data-filter="Inovasi">Inovasi</button>
        </div>

        @if($beritas->count() > 0)
        
            @php 
                $featured = $beritas->first(); 
                $sidebar = $beritas->slice(1, 3);
                $others = $beritas->slice(4);
            @endphp

            <div class="featured-grid warta-item" data-kategori="{{ $featured->kategori }}">
                <!-- Main Featured News -->
                <a href="{{ route('berita.showPublic', $featured->id) }}" class="main-featured-card" style="text-decoration: none;">
                    <img src="{{ $featured->gambar ? Storage::url($featured->gambar) : 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" class="main-featured-img" alt="{{ $featured->judul }}">
                    <div class="main-featured-body">
                        <span class="badge-category {{ $featured->kategori == 'Unggulan' ? 'badge-unggulan' : '' }}">{{ $featured->kategori }}</span>
                        <h2 class="main-featured-title">{{ $featured->judul }}</h2>
                        <div class="warta-meta">
                            <span><i class="fa-regular fa-calendar"></i> {{ \Carbon\Carbon::parse($featured->tanggal)->translatedFormat('d F Y') }}</span>
                            <span><i class="fa-regular fa-user"></i> {{ $featured->penulis }}</span>
                        </div>
                        <p class="main-featured-desc">
                            {{ Str::limit($featured->konten, 200) }}
                        </p>
                    </div>
                </a>

                <!-- Sidebar News -->
                <div class="sidebar-list">
                    @foreach($sidebar as $side)
                    <a href="{{ route('berita.showPublic', $side->id) }}" class="sidebar-item warta-item" data-kategori="{{ $side->kategori }}">
                        <img src="{{ $side->gambar ? Storage::url($side->gambar) : 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" class="sidebar-img" alt="{{ $side->judul }}">
                        <div class="sidebar-content">
                            <span class="sidebar-category">{{ $side->kategori }}</span>
                            <h4 class="sidebar-title">{{ Str::limit($side->judul, 40) }}</h4>
                            <span class="sidebar-date">{{ \Carbon\Carbon::parse($side->tanggal)->translatedFormat('d F Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Other News Grid -->
            <div class="warta-grid">
                @foreach($others as $item)
                <a href="{{ route('berita.showPublic', $item->id) }}" class="warta-card warta-item" data-kategori="{{ $item->kategori }}">
                    <img src="{{ $item->gambar ? Storage::url($item->gambar) : 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" class="warta-card-img" alt="{{ $item->judul }}">
                    <div class="warta-card-body">
                        <div class="warta-card-header">
                            <span class="badge-category m-0">{{ $item->kategori }}</span>
                            <span class="warta-meta m-0" style="font-size: 12px;">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="warta-card-title">{{ Str::limit($item->judul, 60) }}</h3>
                        <p class="warta-card-desc">
                            {{ Str::limit($item->konten, 100) }}
                        </p>
                        <div class="warta-card-footer">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $beritas->links() ?? '' }}
            </div>

        @else
            <div class="empty-state">
                <i class="fa-solid fa-newspaper"></i>
                <h3>Belum Ada Berita</h3>
                <p class="text-muted mt-2">Pusat informasi dan warta desa saat ini masih kosong.</p>
            </div>
        @endif
        
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const wartaItems = document.querySelectorAll('.warta-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            wartaItems.forEach(item => {
                if (filter === 'semua' || item.getAttribute('data-kategori') === filter) {
                    item.style.display = (item.classList.contains('featured-grid')) ? 'grid' : 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection