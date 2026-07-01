@extends('layouts.utama')
@section('title', 'Kegiatan Desa')

@section('content')
<style>
.kegiatan-section {
    padding: 60px 0;
    background-color: #f8fafc;
    min-height: 100vh;
}
.page-hero {
    background: linear-gradient(135deg, #16a34a, #166534);
    color: white;
    padding: 60px 40px;
    border-radius: 30px;
    margin-bottom: 40px;
    box-shadow: 0 20px 40px rgba(22, 163, 74, 0.2);
    position: relative;
    overflow: hidden;
}
.page-hero::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
}
.page-hero h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    z-index: 2;
}
.page-hero p {
    font-size: 18px;
    opacity: 0.9;
    max-width: 600px;
    position: relative;
    z-index: 2;
}
.filter-tabs {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}
.filter-btn {
    border: none;
    padding: 12px 25px;
    border-radius: 30px;
    background: white;
    color: #475569;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.filter-btn:hover, .filter-btn.active {
    background: #16a34a;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(22, 163, 74, 0.3);
}
.kegiatan-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.kegiatan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}
.kegiatan-img-wrapper {
    position: relative;
    height: 240px;
    overflow: hidden;
}
.kegiatan-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.kegiatan-card:hover .kegiatan-img {
    transform: scale(1.05);
}
.status-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    z-index: 2;
}
.status-upcoming { background: #166534; color: white; }
.status-active { background: #eab308; color: white; }
.status-finish { background: #64748b; color: white; }

.kegiatan-body {
    padding: 30px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.kegiatan-title {
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 20px;
    line-height: 1.4;
}
.kegiatan-meta {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 12px;
    color: #475569;
}
.meta-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #f0fdf4;
    color: #16a34a;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}
.meta-text strong {
    display: block;
    color: #1e293b;
    font-size: 14px;
}
.meta-text span {
    font-size: 13px;
}
.kegiatan-desc {
    color: #64748b;
    font-size: 15px;
    line-height: 1.6;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e2e8f0;
    flex-grow: 1;
}
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}
.empty-state i {
    font-size: 64px;
    color: #cbd5e1;
    margin-bottom: 20px;
}
.empty-state h3 {
    color: #334155;
    font-weight: 700;
}
</style>

<section class="kegiatan-section">
    <div class="container">
        
        <div class="page-hero">
            <h1>Kegiatan Desa</h1>
            <p>Ikuti perkembangan terbaru, program pembangunan, dan partisipasi warga dalam berbagai agenda komunitas di desa kita.</p>
        </div>

        <div class="filter-tabs">
            <button class="filter-btn active" data-filter="semua">Semua Agenda</button>
            <button class="filter-btn" data-filter="Akan Datang">Akan Datang</button>
            <button class="filter-btn" data-filter="Berlangsung">Berlangsung</button>
            <button class="filter-btn" data-filter="Selesai">Selesai</button>
        </div>

        <div class="row g-4">
            @forelse($agendas as $agenda)
            <div class="col-md-6 col-lg-4 kegiatan-item" data-status="{{ $agenda->status }}">
                <div class="kegiatan-card">
                    <div class="kegiatan-img-wrapper">
                        @php
                            $badgeClass = '';
                            if($agenda->status == 'Akan Datang') $badgeClass = 'status-upcoming';
                            elseif($agenda->status == 'Berlangsung') $badgeClass = 'status-active';
                            else $badgeClass = 'status-finish';
                        @endphp
                        <span class="status-badge {{ $badgeClass }}">
                            {{ $agenda->status }}
                        </span>
                        
                        @if($agenda->gambar)
                            <img src="{{ Storage::url($agenda->gambar) }}" class="kegiatan-img" alt="{{ $agenda->judul }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="kegiatan-img" alt="Default Kegiatan">
                        @endif
                    </div>

                    <div class="kegiatan-body">
                        <h3 class="kegiatan-title">{{ $agenda->judul }}</h3>
                        
                        <div class="kegiatan-meta">
                            <div class="meta-icon"><i class="fa-solid fa-calendar-days text-sm"></i></div>
                            <div class="meta-text">
                                <strong>{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }} • {{ $agenda->jam }}</strong>
                                <span>Oleh: {{ $agenda->penyelenggara ?? 'Pemerintah Desa' }}</span>
                            </div>
                        </div>

                        <div class="kegiatan-meta">
                            <div class="meta-icon"><i class="fa-solid fa-location-dot text-sm"></i></div>
                            <div class="meta-text">
                                <span class="mt-1 d-block">{{ $agenda->lokasi }}</span>
                            </div>
                        </div>

                        <p class="kegiatan-desc mb-4">
                            {{ Str::limit($agenda->deskripsi, 120) }}
                        </p>
                        
                        <div class="mt-auto">
                            <button type="button" class="btn btn-success w-100 rounded-pill py-2 fw-semibold" data-bs-toggle="modal" data-bs-target="#kegiatanModal{{ $agenda->id }}">
                                <i class="fa-solid fa-circle-info me-2"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Kegiatan -->
            <div class="modal fade" id="kegiatanModal{{ $agenda->id }}" tabindex="-1" aria-labelledby="kegiatanModalLabel{{ $agenda->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                        <div class="modal-header border-0 p-0" style="position: absolute; top: 15px; right: 15px; z-index: 10;">
                            <button type="button" class="btn-close bg-white p-2 rounded-circle shadow-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            @if($agenda->gambar)
                                <img src="{{ Storage::url($agenda->gambar) }}" class="w-100" style="height: 350px; object-fit: cover;" alt="{{ $agenda->judul }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-100" style="height: 350px; object-fit: cover;" alt="Default Kegiatan">
                            @endif
                            <div class="p-4 p-md-5">
                                <span class="status-badge position-static mb-3 d-inline-block {{ $badgeClass }}">
                                    {{ $agenda->status }}
                                </span>
                                <h2 class="fw-bold text-dark mb-4">{{ $agenda->judul }}</h2>
                                
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="meta-icon bg-light"><i class="fa-solid fa-calendar-days"></i></div>
                                            <div>
                                                <small class="text-muted d-block">Waktu Pelaksanaan</small>
                                                <strong>{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }} • {{ $agenda->jam }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="meta-icon bg-light"><i class="fa-solid fa-users"></i></div>
                                            <div>
                                                <small class="text-muted d-block">Penyelenggara</small>
                                                <strong>{{ $agenda->penyelenggara ?? 'Pemerintah Desa' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="meta-icon bg-light"><i class="fa-solid fa-location-dot"></i></div>
                                            <div>
                                                <small class="text-muted d-block">Lokasi</small>
                                                <strong>{{ $agenda->lokasi }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr class="my-4">
                                
                                <div class="kegiatan-detail-desc">
                                    <h5 class="fw-bold mb-3">Deskripsi Kegiatan</h5>
                                    <div class="text-secondary" style="line-height: 1.8; text-align: justify;">
                                        {!! nl2br(e($agenda->deskripsi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <h3>Belum Ada Kegiatan</h3>
                    <p class="text-muted mt-2">Jadwal kegiatan desa saat ini masih kosong. Silakan cek kembali nanti.</p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $agendas->links() ?? '' }}
        </div>
        
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const kegiatanItems = document.querySelectorAll('.kegiatan-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Hapus class active dari semua tombol
            filterBtns.forEach(b => b.classList.remove('active'));
            // Tambahkan class active ke tombol yang diklik
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            kegiatanItems.forEach(item => {
                if (filter === 'semua' || item.getAttribute('data-status') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection