@extends('layouts.utama')

@section('content')
<div class="container py-5">
    
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card text-white bg-dark shadow" style="border-radius: 20px; overflow: hidden; border: none;">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" class="card-img" alt="Background" style="height: 150px; object-fit: cover; opacity: 0.55;">
                <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-center">
                    <h1 class="card-title fw-bold mb-0" style="font-size: 2.5rem;">Ketua RT</h1>
                    <p class="card-text fs-5 mt-2">Data Ketua RT Desa Medangasem</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data RT -->
    @forelse($rt as $ketua)
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if($ketua->foto)
                            <img src="{{ Storage::url($ketua->foto) }}" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 300px;" alt="{{ $ketua->nama }}">
                        @else
                            <div class="h-100 d-flex justify-content-center align-items-center bg-success bg-opacity-10 text-success" style="min-height: 300px;">
                                <i class="fa-solid fa-user fa-5x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4 p-md-5">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3">{{ $ketua->jabatan }}</span>
                            <h2 class="card-title text-success fw-bold mb-4">{{ $ketua->nama }}</h2>
                            
                            <div class="row mb-4 text-muted">
                                <div class="col-md-6 mb-3">
                                    <i class="fa-solid fa-location-dot text-success me-2" style="width: 20px;"></i> {{ $ketua->alamat ?? 'Desa Medangasem' }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <i class="fa-solid fa-phone text-success me-2" style="width: 20px;"></i> {{ $ketua->telepon ?? '-' }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <i class="fa-solid fa-people-roof text-success me-2" style="width: 20px;"></i> {{ $ketua->jumlah_kk ?? '0' }} KK
                                </div>
                                <div class="col-md-6 mb-3">
                                    <i class="fa-solid fa-calendar text-success me-2" style="width: 20px;"></i> Aktif
                                </div>
                            </div>
                            
                            <p class="card-text text-muted" style="line-height: 1.8;">
                                Bertugas mengoordinasikan masyarakat di wilayah RT-nya serta menjadi penghubung antara masyarakat dan pemerintah desa (Ketua RW / Kepala Desa).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning text-center rounded-3 mb-5">
        Belum ada data Ketua RT yang ditambahkan.
    </div>
    @endforelse

</div>
@endsection