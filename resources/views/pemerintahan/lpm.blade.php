@extends('layouts.utama')

@section('content')
<div class="container py-5">
    
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card text-white bg-dark shadow" style="border-radius: 20px; overflow: hidden; border: none;">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" class="card-img" alt="Background" style="height: 150px; object-fit: cover; opacity: 0.55;">
                <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="card-title fw-bold mb-0" style="font-size: 2.5rem;">LPM Desa Medangasem</h1>
                    <p class="card-text fs-5 mt-2">Lembaga Pemberdayaan Masyarakat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profil LPM -->
    @if($ketua)
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="row g-0">
                    <div class="col-md-4 text-center p-4">
                        @if($ketua->foto)
                            <img src="{{ Storage::url($ketua->foto) }}" class="img-fluid rounded shadow" alt="{{ $ketua->nama }}" style="max-height: 250px; object-fit: cover;">
                        @else
                            <div class="w-100 rounded shadow d-flex justify-content-center align-items-center bg-success bg-opacity-10 text-success" style="height: 250px;">
                                <i class="fa-solid fa-user fa-5x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="card-title text-success fw-bold mb-1">{{ $ketua->jabatan }}</h2>
                            <h4 class="mb-4 text-dark">{{ $ketua->nama }}</h4>
                            
                            <p class="card-text text-muted" style="line-height: 1.8;">
                                Lembaga Pemberdayaan Masyarakat (LPM) merupakan lembaga kemasyarakatan desa yang membantu pemerintah desa dalam perencanaan, pelaksanaan, dan pengawasan pembangunan yang melibatkan partisipasi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-warning text-center rounded-3 mb-5">
        Belum ada data Ketua LPM yang ditambahkan.
    </div>
    @endif

    <!-- Tugas & Fungsi LPM -->
    <div class="text-center mb-4">
        <h2 class="text-success fw-bold">Tugas & Fungsi LPM</h2>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-map-location-dot text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Perencanaan</h4>
                <p class="card-text text-muted mb-0 px-2">Menyusun rencana pembangunan desa.</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-people-group text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Pemberdayaan</h4>
                <p class="card-text text-muted mb-0 px-2">Meningkatkan partisipasi masyarakat.</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-chart-column text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Pengawasan</h4>
                <p class="card-text text-muted mb-0 px-2">Mengawasi program pembangunan desa.</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-handshake text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Koordinasi</h4>
                <p class="card-text text-muted mb-0 px-2">Menjadi penghubung pemerintah dan warga.</p>
            </div>
        </div>
    </div>

    <!-- Program Kerja Tahun 2026 -->
    <div class="text-center mb-4">
        <h2 class="text-success fw-bold">Program Kerja Tahun 2026</h2>
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col" class="py-3 px-4 rounded-top-start text-success" style="width: 10%;">No</th>
                                    <th scope="col" class="py-3 px-4 text-success" style="width: 60%;">Program</th>
                                    <th scope="col" class="py-3 px-4 rounded-top-end text-success" style="width: 30%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-muted">1</td>
                                    <td class="py-3 px-4 fw-medium">Pembangunan Jalan Lingkungan</td>
                                    <td class="py-3 px-4"><span class="badge bg-primary rounded-pill px-3 py-2">Berjalan</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-muted">2</td>
                                    <td class="py-3 px-4 fw-medium">Pelatihan UMKM Desa</td>
                                    <td class="py-3 px-4"><span class="badge bg-primary rounded-pill px-3 py-2">Berjalan</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-muted">3</td>
                                    <td class="py-3 px-4 fw-medium">Pengelolaan Bank Sampah</td>
                                    <td class="py-3 px-4"><span class="badge bg-secondary rounded-pill px-3 py-2">Perencanaan</span></td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-muted border-bottom-0">4</td>
                                    <td class="py-3 px-4 fw-medium border-bottom-0">Pelatihan Digital Marketing</td>
                                    <td class="py-3 px-4 border-bottom-0"><span class="badge bg-secondary rounded-pill px-3 py-2">Perencanaan</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Struktur Pengurus -->
    <div class="text-center mb-4">
        <h2 class="text-success fw-bold">Struktur Pengurus LPM</h2>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col" class="py-3 px-4 rounded-top-start text-success">Jabatan</th>
                                    <th scope="col" class="py-3 px-4 rounded-top-end text-success">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($ketua)
                                <tr>
                                    <td class="py-3 px-4">{{ $ketua->jabatan }}</td>
                                    <td class="py-3 px-4 fw-medium">{{ $ketua->nama }}</td>
                                </tr>
                                @endif
                                
                                @forelse($anggota as $item)
                                <tr>
                                    <td class="py-3 px-4">{{ $item->jabatan }}</td>
                                    <td class="py-3 px-4 fw-medium">{{ $item->nama }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="py-4 text-center text-muted">Belum ada data struktur pengurus yang ditambahkan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection