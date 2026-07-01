@extends('layouts.utama')
@section('title', $berita->judul . ' - Warta Desa')

@section('content')
<style>
.berita-detail-section {
    padding: 60px 0;
    background-color: #f8fafc;
    min-height: 100vh;
}
.article-container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.05);
}
.article-header {
    padding: 40px 40px 0;
}
.badge-category {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    background: #dcfce7;
    color: #166534;
    margin-bottom: 20px;
}
.article-title {
    font-size: 36px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
    margin-bottom: 20px;
}
.article-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    padding-bottom: 30px;
    border-bottom: 1px solid #e2e8f0;
    margin-bottom: 30px;
    color: #64748b;
    font-size: 15px;
}
.article-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
}
.article-meta-item i {
    color: #16a34a;
}
.article-img-wrapper {
    width: 100%;
    margin-bottom: 40px;
}
.article-img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
}
.article-content {
    padding: 0 40px 40px;
    font-size: 17px;
    line-height: 1.8;
    color: #334155;
    text-align: justify;
}
.article-content p {
    margin-bottom: 20px;
}

/* Related News */
.related-section {
    max-width: 900px;
    margin: 60px auto 0;
}
.related-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.related-title i {
    color: #16a34a;
}
.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}
.warta-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
}
.warta-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.warta-card-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
.warta-card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
}
.warta-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.4;
    margin-bottom: 10px;
}
.warta-meta-small {
    font-size: 12px;
    color: #64748b;
}

@media (max-width: 768px) {
    .article-header { padding: 30px 20px 0; }
    .article-content { padding: 0 20px 30px; }
    .article-title { font-size: 28px; }
    .article-meta { flex-direction: column; align-items: flex-start; gap: 10px; }
}
</style>

<section class="berita-detail-section">
    <div class="container">
        
        <div class="mb-4">
            <a href="{{ route('berita.warta') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-semibold" style="color: #475569;">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Daftar Berita
            </a>
        </div>

        <div class="article-container">
            <div class="article-header">
                <span class="badge-category">{{ $berita->kategori }}</span>
                <h1 class="article-title">{{ $berita->judul }}</h1>
                
                <div class="article-meta">
                    <div class="article-meta-item">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y') }}</span>
                    </div>
                    <div class="article-meta-item">
                        <i class="fa-solid fa-pen-nib"></i>
                        <span>Oleh: <strong>{{ $berita->penulis }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="article-img-wrapper">
                @if($berita->gambar)
                    <img src="{{ Storage::url($berita->gambar) }}" class="article-img" alt="{{ $berita->judul }}">
                @else
                    <img src="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" class="article-img" alt="Default Image">
                @endif
            </div>

            <div class="article-content">
                {!! nl2br(e($berita->konten)) !!}
            </div>
        </div>

        @if($terkait->count() > 0)
        <div class="related-section">
            <h3 class="related-title"><i class="fa-solid fa-newspaper"></i> Berita Terkait Lainnya</h3>
            <div class="related-grid">
                @foreach($terkait as $item)
                <a href="{{ route('berita.showPublic', $item->id) }}" class="warta-card">
                    <img src="{{ $item->gambar ? Storage::url($item->gambar) : 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" class="warta-card-img" alt="{{ $item->judul }}">
                    <div class="warta-card-body">
                        <h4 class="warta-card-title">{{ Str::limit($item->judul, 50) }}</h4>
                        <span class="warta-meta-small">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>
@endsection
