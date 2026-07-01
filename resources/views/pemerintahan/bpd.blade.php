@extends('layouts.utama')

@section('content')
<div class="container py-5">
    
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card text-white bg-dark shadow" style="border-radius: 20px; overflow: hidden; border: none;">
                <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952" class="card-img" alt="Background" style="height: 150px; object-fit: cover; opacity: 0.55;">
                <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="card-title fw-bold mb-0" style="font-size: 2.5rem;">BPD Desa Medangasem</h1>
                    <p class="card-text fs-5 mt-2">Badan Permusyawaratan Desa</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Profil BPD -->
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
                                Badan Permusyawaratan Desa (BPD) merupakan lembaga yang melaksanakan fungsi pemerintahan desa sebagai mitra Kepala Desa dalam menyelenggarakan pemerintahan, pembangunan, dan pemberdayaan masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-warning text-center rounded-3 mb-5">
        Belum ada data Ketua BPD yang ditambahkan.
    </div>
    @endif

    <!-- Fungsi BPD -->
    <div class="text-center mb-4">
        <h2 class="text-success fw-bold">Fungsi BPD</h2>
    </div>

    <div class="row g-4 mb-5 justify-content-center">
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-scale-balanced text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Membahas Perdes</h4>
                <p class="card-text text-muted mb-0 px-3">Menyusun dan membahas Peraturan Desa bersama Kepala Desa.</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-users text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Menampung Aspirasi</h4>
                <p class="card-text text-muted mb-0 px-3">Menerima dan menyampaikan aspirasi masyarakat desa.</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 text-center py-4" style="border-radius: 15px; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-magnifying-glass text-success mb-3" style="font-size: 2.5rem;"></i>
                <h4 class="card-title fw-bold">Pengawasan</h4>
                <p class="card-text text-muted mb-0 px-3">Mengawasi kinerja Pemerintah Desa secara transparan.</p>
            </div>
        </div>
    </div>

    <!-- Struktur Pengurus -->
    <div class="text-center mb-4">
        <h2 class="text-success fw-bold">Struktur Pengurus BPD</h2>
    </div>

    <div class="row mb-5">
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

    <!-- Aspirasi Masyarakat -->
    <div class="text-center mb-4">
        <h2 class="text-success fw-bold">Aspirasi Masyarakat</h2>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <p class="card-text text-muted mb-4" style="line-height: 1.8;">
                        BPD berfungsi sebagai wadah penyalur aspirasi masyarakat. Beberapa aspirasi yang menjadi prioritas pembangunan desa saat ini:
                    </p>
                    <ul class="list-group list-group-flush border-top">
                        <li class="list-group-item px-0 py-3 text-muted"><i class="fa-solid fa-check text-success me-3"></i> Peningkatan kualitas jalan lingkungan.</li>
                        <li class="list-group-item px-0 py-3 text-muted"><i class="fa-solid fa-check text-success me-3"></i> Perbaikan saluran drainase desa.</li>
                        <li class="list-group-item px-0 py-3 text-muted"><i class="fa-solid fa-check text-success me-3"></i> Pengembangan UMKM dan ekonomi kreatif.</li>
                        <li class="list-group-item px-0 py-3 text-muted"><i class="fa-solid fa-check text-success me-3"></i> Peningkatan pelayanan administrasi desa.</li>
                        <li class="list-group-item px-0 py-3 text-muted border-bottom-0"><i class="fa-solid fa-check text-success me-3"></i> Program pelatihan pemuda dan masyarakat.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection