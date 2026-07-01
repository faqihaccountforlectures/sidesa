@extends('layouts.admin')

@section('title', 'Tambah Agenda Desa')
@section('header', 'Tambah Agenda Baru')

@push('styles')
<style>
.form-shell{max-width:1200px;margin:0 auto;}
.form-hero{background:linear-gradient(135deg,#166534,#22c55e);border-radius:28px;padding:28px;color:#fff;box-shadow:0 24px 55px rgba(22,101,52,.22);}
.form-card{border:0;border-radius:28px;box-shadow:0 22px 55px rgba(15,23,42,.08);overflow:hidden;}
.form-section-title{font-size:14px;font-weight:700;color:#166534;text-transform:uppercase;letter-spacing:.08em;margin-bottom:18px;}
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
.preview-badge {
    position: absolute;
    bottom: 15px;
    left: 15px;
    background: #166534;
    color: white;
    font-size: 12px;
    font-weight: bold;
    padding: 5px 12px;
    border-radius: 6px;
    text-transform: uppercase;
}
.preview-title {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 40px 15px 15px;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: white;
    font-size: 20px;
    font-weight: 700;
    margin: 0;
}
.preview-body {
    padding: 20px;
    flex-grow: 1;
}
.preview-item {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    color: #475569;
}
.preview-item i {
    font-size: 18px;
    color: #64748b;
    margin-top: 2px;
}
.preview-item-text strong {
    display: block;
    color: #1e293b;
    font-size: 14px;
}
.preview-item-text span {
    font-size: 13px;
}
.preview-desc {
    font-size: 14px;
    color: #64748b;
    font-style: italic;
    border-top: 1px solid #e2e8f0;
    padding-top: 15px;
    margin-top: 5px;
}
</style>
@endpush

@section('content')
<div class="form-shell">
    <div class="form-hero mb-4 d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center">
        <div>
            <span class="badge text-bg-warning rounded-pill mb-3">Agenda & Kegiatan</span>
            <h3 class="fw-bold mb-2">Ajukan Kegiatan Desa</h3>
            <p class="mb-0 opacity-75">Lengkapi detail di bawah untuk mendaftarkan kegiatan komunitas Anda ke dalam kalender desa kami.</p>
        </div>
        <a href="{{ route('admin.agenda.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold align-self-start align-self-md-center">
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
                    <form action="{{ route('admin.agenda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label">Nama Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="inputJudul" class="form-control" value="{{ old('judul') }}" required placeholder="Contoh: Kerja Bakti Dusun Mawar">
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <div class="input-icon">
                                    <i class="fa-solid fa-calendar"></i>
                                    <input type="date" name="tanggal" id="inputTanggal" class="form-control" value="{{ old('tanggal') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Waktu <span class="text-danger">*</span></label>
                                <div class="input-icon">
                                    <i class="fa-solid fa-clock"></i>
                                    <input type="time" name="jam" id="inputJam" class="form-control" value="{{ old('jam') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Penyelenggara <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fa-solid fa-users"></i>
                                <input type="text" name="penyelenggara" id="inputPenyelenggara" class="form-control" value="{{ old('penyelenggara') }}" required placeholder="Contoh: Karang Taruna">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Lokasi Kegiatan <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" name="lokasi" id="inputLokasi" class="form-control" value="{{ old('lokasi') }}" required placeholder="Masukkan alamat atau nama tempat">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" id="inputDeskripsi" class="form-control" rows="4" required placeholder="Jelaskan detail kegiatan, tujuan, dan apa yang perlu dibawa peserta...">{{ old('deskripsi') }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Status Kegiatan <span class="text-danger">*</span></label>
                            <div class="input-icon">
                                <i class="fa-solid fa-tags"></i>
                                <select name="status" id="inputStatus" class="form-select" required>
                                    <option value="Akan Datang" {{ old('status') == 'Akan Datang' ? 'selected' : '' }}>Akan Datang</option>
                                    <option value="Berlangsung" {{ old('status') == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Poster Kegiatan (Opsional)</label>
                            <label class="upload-box d-block">
                                <i class="fa-solid fa-file-arrow-up"></i>
                                <h5>Klik untuk unggah atau seret file di sini</h5>
                                <p class="text-muted mb-0 small">PNG, JPG atau PDF (Maks. 5MB)</p>
                                <input type="file" name="gambar" id="inputGambar" class="d-none" accept="image/png, image/jpeg, application/pdf">
                            </label>
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-3 justify-content-start">
                            <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold">
                                <i class="fa-solid fa-paper-plane me-2"></i> Simpan Kegiatan
                            </button>
                            <a href="{{ route('admin.agenda.index') }}" class="btn btn-light border rounded-pill px-4 text-danger fw-semibold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- LIVE PREVIEW COLUMN -->
        <div class="col-lg-5">
            <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                Live Preview 
                <span id="previewStatusBadge" class="badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-2">MENDATANG</span>
            </h5>
            
            <div class="preview-card">
                <div class="preview-img" id="previewImg" style="background-image: url('https://images.unsplash.com/photo-1596422846543-75c6fc197f0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <span class="preview-badge" id="previewStatus">Akan Datang</span>
                    <h3 class="preview-title" id="previewJudul">Nama Kegiatan Anda</h3>
                </div>
                
                <div class="preview-body">
                    <div class="preview-item">
                        <i class="fa-regular fa-calendar-days"></i>
                        <div class="preview-item-text">
                            <strong id="previewWaktu">Waktu belum ditentukan</strong>
                            <span id="previewPenyelenggara">Oleh: Penyelenggara</span>
                        </div>
                    </div>
                    
                    <div class="preview-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div class="preview-item-text">
                            <span id="previewLokasi" class="mt-1 d-block">Lokasi belum diatur</span>
                        </div>
                    </div>
                    
                    <div class="preview-desc" id="previewDeskripsi">
                        Tuliskan deskripsi kegiatan untuk melihat pratinjau di sini...
                    </div>
                    
                    <div class="mt-4">
                        <button class="btn btn-light w-100 py-2 rounded-3 text-muted" disabled>Detail Lengkap</button>
                    </div>
                </div>
            </div>

            <div class="card bg-dark text-white rounded-4 mt-4 border-0 shadow">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="fa-solid fa-circle-info me-2 text-info"></i> Tips Pengajuan</h6>
                    <ul class="mb-0 small text-light opacity-75 ps-3" style="line-height: 1.8;">
                        <li>Gunakan nama kegiatan yang singkat dan menarik.</li>
                        <li>Pastikan lokasi sudah jelas (seperti Balai Desa atau Lapangan).</li>
                        <li>Unggah poster dengan orientasi lanskap atau potret dengan kualitas baik.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputJudul = document.getElementById('inputJudul');
    const inputTanggal = document.getElementById('inputTanggal');
    const inputJam = document.getElementById('inputJam');
    const inputPenyelenggara = document.getElementById('inputPenyelenggara');
    const inputLokasi = document.getElementById('inputLokasi');
    const inputDeskripsi = document.getElementById('inputDeskripsi');
    const inputStatus = document.getElementById('inputStatus');
    const inputGambar = document.getElementById('inputGambar');
    
    const previewJudul = document.getElementById('previewJudul');
    const previewWaktu = document.getElementById('previewWaktu');
    const previewPenyelenggara = document.getElementById('previewPenyelenggara');
    const previewLokasi = document.getElementById('previewLokasi');
    const previewDeskripsi = document.getElementById('previewDeskripsi');
    const previewStatus = document.getElementById('previewStatus');
    const previewStatusBadge = document.getElementById('previewStatusBadge');
    const previewImg = document.getElementById('previewImg');

    function updatePreview() {
        previewJudul.textContent = inputJudul.value || 'Nama Kegiatan Anda';
        
        let waktuText = 'Waktu belum ditentukan';
        if(inputTanggal.value) {
            const dateObj = new Date(inputTanggal.value);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            let dateStr = dateObj.toLocaleDateString('id-ID', options);
            if(inputJam.value) {
                dateStr += ' • ' + inputJam.value;
            }
            waktuText = dateStr;
        }
        previewWaktu.textContent = waktuText;
        
        previewPenyelenggara.textContent = 'Oleh: ' + (inputPenyelenggara.value || 'Penyelenggara');
        previewLokasi.textContent = inputLokasi.value || 'Lokasi belum diatur';
        previewDeskripsi.textContent = inputDeskripsi.value || 'Tuliskan deskripsi kegiatan untuk melihat pratinjau di sini...';
        
        const statusVal = inputStatus.value;
        previewStatus.textContent = statusVal;
        previewStatusBadge.textContent = statusVal.toUpperCase();
        
        if(statusVal === 'Selesai') {
            previewStatusBadge.className = 'badge bg-secondary bg-opacity-25 text-secondary rounded-pill px-3 py-2';
            previewStatus.style.background = '#64748b';
        } else if (statusVal === 'Berlangsung') {
            previewStatusBadge.className = 'badge bg-warning bg-opacity-25 text-warning rounded-pill px-3 py-2';
            previewStatus.style.background = '#eab308';
        } else {
            previewStatusBadge.className = 'badge bg-success bg-opacity-25 text-success rounded-pill px-3 py-2';
            previewStatus.style.background = '#166534';
        }
    }

    inputJudul.addEventListener('input', updatePreview);
    inputTanggal.addEventListener('input', updatePreview);
    inputJam.addEventListener('input', updatePreview);
    inputPenyelenggara.addEventListener('input', updatePreview);
    inputLokasi.addEventListener('input', updatePreview);
    inputDeskripsi.addEventListener('input', updatePreview);
    inputStatus.addEventListener('change', updatePreview);
    
    inputGambar.addEventListener('change', function(e) {
        if(this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.style.backgroundImage = `url('${e.target.result}')`;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Initialize
    updatePreview();
});
</script>
@endsection
