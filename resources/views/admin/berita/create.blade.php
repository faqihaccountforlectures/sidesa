@extends('layouts.admin')

@section('title', 'Tulis Berita Desa')
@section('header', 'Tulis Warta Baru')

@push('styles')
<style>
.form-shell{max-width:1200px;margin:0 auto;}
.form-hero{background:linear-gradient(135deg,#166534,#22c55e);border-radius:28px;padding:28px;color:#fff;box-shadow:0 24px 55px rgba(22,101,52,.22);}
.form-card{border:0;border-radius:28px;box-shadow:0 22px 55px rgba(15,23,42,.08);overflow:hidden;}
.form-label{font-weight:600;color:#334155;margin-bottom:8px;}
.form-control,.form-select{border-radius:16px;border:1px solid #dbe3ef;padding:13px 16px;}
.form-control:focus,.form-select:focus{border-color:#22c55e;box-shadow:0 0 0 .22rem rgba(34,197,94,.15);}
.input-icon{position:relative;}
.input-icon i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#94a3b8;z-index:2;}
.input-icon .form-control,.input-icon .form-select{padding-left:44px;}
.upload-box{border:2px dashed #cbd5e1;border-radius:22px;padding:30px;background:#f8fafc;text-align:center;cursor:pointer;transition:all 0.3s;}
.upload-box:hover{border-color:#22c55e;background:#f0fdf4;}
.upload-box i{font-size:40px;color:#22c55e;margin-bottom:15px;}

/* Live Preview Styles */
.preview-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    background: #fff;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.preview-img {
    height: 200px;
    background-color: #e2e8f0;
    background-size: cover;
    background-position: center;
    position: relative;
}
.preview-body {
    padding: 20px;
    flex-grow: 1;
}
.preview-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    background: #166534;
    color: white;
    margin-bottom: 12px;
}
.preview-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #1e293b;
    line-height: 1.4;
}
.preview-meta {
    font-size: 13px;
    color: #64748b;
    margin-bottom: 15px;
    display: flex;
    gap: 15px;
}
.preview-desc {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
}
</style>
@endpush

@section('content')
<div class="form-shell">
    <div class="form-hero mb-4 d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center">
        <div>
            <span class="badge text-bg-warning rounded-pill mb-3">Warta Desa</span>
            <h3 class="fw-bold mb-2">Tulis Berita Desa</h3>
            <p class="mb-0 opacity-75">Sampaikan informasi terbaru, pengumuman, dan pencapaian desa kepada masyarakat.</p>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold align-self-start align-self-md-center">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

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

    <div class="row g-4">
        <!-- FORM COLUMN -->
        <div class="col-lg-7">
            <div class="card form-card h-100">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="inputJudul" class="form-control" value="{{ old('judul') }}" required placeholder="Contoh: Peresmian Pasar Desa Digital">
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <div class="input-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <select name="kategori" id="inputKategori" class="form-select" required>
                                        <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                        <option value="Pembangunan" {{ old('kategori') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                                        <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                        <option value="Inovasi" {{ old('kategori') == 'Inovasi' ? 'selected' : '' }}>Inovasi</option>
                                        <option value="Unggulan" {{ old('kategori') == 'Unggulan' ? 'selected' : '' }}>Unggulan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                                <div class="input-icon">
                                    <i class="fa-solid fa-calendar-day"></i>
                                    <input type="date" name="tanggal" id="inputTanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Penulis <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fa-solid fa-pen-nib"></i>
                                <input type="text" name="penulis" id="inputPenulis" class="form-control" value="{{ old('penulis', 'Admin Desa') }}" required placeholder="Nama penulis berita">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
                            <textarea name="konten" id="inputKonten" class="form-control" rows="6" required placeholder="Tuliskan detail berita atau pengumuman di sini...">{{ old('konten') }}</textarea>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Gambar Thumbnail</label>
                            <label class="upload-box d-block">
                                <i class="fa-solid fa-image"></i>
                                <h5>Unggah Gambar Berita</h5>
                                <p class="text-muted mb-0 small">Maks. 5MB (Disarankan Landscape)</p>
                                <input type="file" name="gambar" id="inputGambar" class="d-none" accept="image/png, image/jpeg">
                            </label>
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-start">
                            <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold">
                                <i class="fa-solid fa-paper-plane me-2"></i> Terbitkan Berita
                            </button>
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-light border rounded-pill px-4 text-danger fw-semibold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- LIVE PREVIEW COLUMN -->
        <div class="col-lg-5">
            <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                Live Preview
            </h5>
            
            <div class="preview-card">
                <div class="preview-img" id="previewImg" style="background-image: url('https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                </div>
                
                <div class="preview-body">
                    <span class="preview-badge" id="previewKategori">PENGUMUMAN</span>
                    <h3 class="preview-title" id="previewJudul">Judul Berita Anda</h3>
                    
                    <div class="preview-meta">
                        <span><i class="fa-regular fa-calendar me-1"></i> <span id="previewTanggal">Tanggal Terbit</span></span>
                        <span><i class="fa-regular fa-user me-1"></i> <span id="previewPenulis">Admin Desa</span></span>
                    </div>
                    
                    <div class="preview-desc" id="previewKonten">
                        Isi dari berita akan muncul di sini sebagai pratinjau cuplikan. Tuliskan deskripsi untuk melihat hasilnya...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputJudul = document.getElementById('inputJudul');
    const inputKategori = document.getElementById('inputKategori');
    const inputTanggal = document.getElementById('inputTanggal');
    const inputPenulis = document.getElementById('inputPenulis');
    const inputKonten = document.getElementById('inputKonten');
    const inputGambar = document.getElementById('inputGambar');
    
    const previewJudul = document.getElementById('previewJudul');
    const previewKategori = document.getElementById('previewKategori');
    const previewTanggal = document.getElementById('previewTanggal');
    const previewPenulis = document.getElementById('previewPenulis');
    const previewKonten = document.getElementById('previewKonten');
    const previewImg = document.getElementById('previewImg');

    function updatePreview() {
        previewJudul.textContent = inputJudul.value || 'Judul Berita Anda';
        previewKategori.textContent = (inputKategori.value || 'Pengumuman').toUpperCase();
        
        if(inputTanggal.value) {
            const dateObj = new Date(inputTanggal.value);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            previewTanggal.textContent = dateObj.toLocaleDateString('id-ID', options);
        } else {
            previewTanggal.textContent = 'Tanggal Terbit';
        }
        
        previewPenulis.textContent = inputPenulis.value || 'Admin Desa';
        
        let txt = inputKonten.value || 'Isi dari berita akan muncul di sini sebagai pratinjau cuplikan. Tuliskan deskripsi untuk melihat hasilnya...';
        if (txt.length > 150) {
            txt = txt.substring(0, 150) + '...';
        }
        previewKonten.textContent = txt;
    }

    inputJudul.addEventListener('input', updatePreview);
    inputKategori.addEventListener('change', updatePreview);
    inputTanggal.addEventListener('input', updatePreview);
    inputPenulis.addEventListener('input', updatePreview);
    inputKonten.addEventListener('input', updatePreview);
    
    inputGambar.addEventListener('change', function(e) {
        if(this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.style.backgroundImage = `url('${e.target.result}')`;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    updatePreview();
});
</script>
@endpush
@endsection
