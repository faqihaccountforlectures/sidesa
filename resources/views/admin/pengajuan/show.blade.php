@extends('layouts.admin')

@section('title', 'Detail Pengajuan Surat')

@section('header', 'Detail Pengajuan Surat')

@section('content')

<style>
.detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

.box {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
}

.box-title {
    color: #166534;
    border-bottom: 2px solid #f0fdf4;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.info-item {
    margin-bottom: 15px;
}

.info-item label {
    display: block;
    color: #666;
    font-size: 13px;
    margin-bottom: 3px;
}

.info-item div {
    font-size: 15px;
    color: #333;
    font-weight: 500;
}

.berkas-list {
    list-style: none;
    padding: 0;
}

.berkas-list li {
    margin-bottom: 10px;
}

.btn-download-berkas {
    display: inline-block;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    color: #166534;
    font-size: 14px;
    transition: .3s;
}

.btn-download-berkas:hover {
    background: #166534;
    color: white;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-family: inherit;
}

.btn-submit {
    background: #16a34a;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    width: 100%;
}

.btn-submit:hover {
    background: #166534;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}
</style>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

<div class="detail-grid">
    
    <div class="left-col">
        <div class="box" style="margin-bottom: 20px;">
            <h3 class="box-title">Informasi Pemohon</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="info-item">
                    <label>Nama Lengkap</label>
                    <div>{{ $pengajuan->nama }}</div>
                </div>
                <div class="info-item">
                    <label>NIK</label>
                    <div>{{ $pengajuan->nik }}</div>
                </div>
                <div class="info-item">
                    <label>No HP</label>
                    <div>{{ $pengajuan->no_hp }}</div>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <div>{{ $pengajuan->email }}</div>
                </div>
                <div class="info-item" style="grid-column: 1 / -1;">
                    <label>Alamat Lengkap</label>
                    <div>{{ $pengajuan->alamat }}</div>
                </div>
            </div>
        </div>

        <div class="box">
            <h3 class="box-title">Detail Pengajuan & Berkas</h3>
            
            <div class="info-item">
                <label>Jenis Surat</label>
                <div>{{ $pengajuan->jenis_surat }}</div>
            </div>

            <div class="info-item">
                <label>Keterangan Tambahan</label>
                <div>{{ $pengajuan->keterangan ?? '-' }}</div>
            </div>

            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

            <label style="color: #666; font-size: 13px; margin-bottom: 10px; display: block;">Berkas Persyaratan:</label>
            <ul class="berkas-list">
                @foreach($pengajuan->berkas as $name => $path)
                <li>
                    <a href="{{ Storage::url($path) }}" target="_blank" class="btn-download-berkas">
                        <i class="fa-solid fa-file"></i> {{ $name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="right-col">
        <div class="box">
            <h3 class="box-title">Proses Pengajuan</h3>
            
            <form action="{{ route('admin.pengajuan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Menunggu Verifikasi" {{ $pengajuan->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="Diproses" {{ $pengajuan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ $pengajuan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak" {{ $pengajuan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Catatan Admin</label>
                    <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Tambahkan catatan jika ada...">{{ $pengajuan->catatan_admin }}</textarea>
                </div>

                <div class="form-group">
                    <label>Upload Hasil Surat (PDF/Gambar) - Hanya jika Selesai</label>
                    @if($pengajuan->file_hasil)
                    <div style="margin-bottom: 10px;">
                        <a href="{{ Storage::url($pengajuan->file_hasil) }}" target="_blank" style="font-size: 13px; color: #166534;">
                            <i class="fa-solid fa-file-pdf"></i> Lihat File Saat Ini
                        </a>
                    </div>
                    @endif
                    <input type="file" name="file_hasil" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </form>

        </div>
    </div>

</div>

@endsection
