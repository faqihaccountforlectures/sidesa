@extends('layouts.admin')

@section('title', 'Edit Pengurus Desa')
@section('header', 'Edit Data Pengurus')

@push('styles')
<style>
.form-shell{max-width:1080px;margin:0 auto;}
.form-hero{background:linear-gradient(135deg,#14532d,#16a34a);border-radius:28px;padding:28px;color:#fff;box-shadow:0 24px 55px rgba(22,101,52,.22);}
.form-card{border:0;border-radius:28px;box-shadow:0 22px 55px rgba(15,23,42,.08);overflow:hidden;}
.form-section-title{font-size:14px;font-weight:700;color:#166534;text-transform:uppercase;letter-spacing:.08em;margin-bottom:18px;}
.form-label{font-weight:600;color:#334155;margin-bottom:8px;}
.form-control,.form-select{border-radius:16px;border:1px solid #dbe3ef;padding:13px 16px;}
.form-control:focus,.form-select:focus{border-color:#22c55e;box-shadow:0 0 0 .22rem rgba(34,197,94,.15);}
.input-icon{position:relative;}
.input-icon i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;z-index:2;}
.input-icon .form-control,.input-icon .form-select{padding-left:44px;}
.upload-box{border:1px dashed #cbd5e1;border-radius:22px;padding:22px;background:#f8fafc;}
.current-photo{max-height:150px;border-radius:18px;box-shadow:0 12px 30px rgba(15,23,42,.12);}
</style>
@endpush

@section('content')
<div class="form-shell">
    <div class="form-hero mb-4 d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center">
        <div>
            <span class="badge text-bg-warning rounded-pill mb-3">Data Pemerintahan</span>
            <h3 class="fw-bold mb-2">Edit Pengurus Desa</h3>
            <p class="mb-0 opacity-75">Perbarui identitas, jabatan, kontak, dan foto pengurus desa.</p>
        </div>
        <a href="{{ route('admin.pengurus.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold align-self-start align-self-md-center">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card form-card">
        <div class="card-body p-4 p-md-5">
            @if($errors->any())
            <div class="alert alert-danger rounded-4 border-0 mb-4">
                <strong>Periksa kembali input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-section-title">Informasi Utama</div>
                <div class="row g-4 mb-4">
                    <div class="col-md-7">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $pengurus->nama) }}" required>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Kategori Organisasi <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fa-solid fa-sitemap"></i>
                            <select name="kategori" class="form-select" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="Desa" {{ (old('kategori', $pengurus->kategori) == 'Desa') ? 'selected' : '' }}>Perangkat Desa (Kades, Sekdes, dll)</option>
                                <option value="RW" {{ (old('kategori', $pengurus->kategori) == 'RW') ? 'selected' : '' }}>Rukun Warga (RW)</option>
                                <option value="RT" {{ (old('kategori', $pengurus->kategori) == 'RT') ? 'selected' : '' }}>Rukun Tetangga (RT)</option>
                                <option value="PKK" {{ (old('kategori', $pengurus->kategori) == 'PKK') ? 'selected' : '' }}>PKK</option>
                                <option value="LPM" {{ (old('kategori', $pengurus->kategori) == 'LPM') ? 'selected' : '' }}>LPM</option>
                                <option value="BPD" {{ (old('kategori', $pengurus->kategori) == 'BPD') ? 'selected' : '' }}>BPD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jabatan Spesifik <span class="text-danger">*</span></label>
                        <div class="input-icon">
                            <i class="fa-solid fa-id-badge"></i>
                            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pengurus->jabatan) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat / Wilayah Tugas</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $pengurus->alamat) }}">
                        </div>
                    </div>
                </div>

                <div class="form-section-title">Kontak & Data Pendukung</div>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $pengurus->telepon) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah KK <small class="fw-normal text-muted">(Khusus RW / RT)</small></label>
                        <div class="input-icon">
                            <i class="fa-solid fa-people-roof"></i>
                            <input type="number" name="jumlah_kk" class="form-control" value="{{ old('jumlah_kk', $pengurus->jumlah_kk) }}">
                        </div>
                    </div>
                </div>

                <div class="upload-box mb-4">
                    <label class="form-label">Foto Profil Saat Ini</label>
                    @if($pengurus->foto)
                        <div class="mb-3">
                            <img src="{{ Storage::url($pengurus->foto) }}" alt="Foto" class="current-photo">
                        </div>
                    @else
                        <p class="text-muted fst-italic mb-3">Belum ada foto.</p>
                    @endif
                    <label class="form-label">Ganti Foto <small class="fw-normal text-muted">(Opsional)</small></label>
                    <input type="file" name="foto" class="form-control bg-white" accept="image/*">
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Maks. 2MB.</div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3 justify-content-end">
                    <a href="{{ route('admin.pengurus.index') }}" class="btn btn-light border rounded-pill px-4">Batal</a>
                    <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold">
                        <i class="fa-solid fa-save me-2"></i> Perbarui Data Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
