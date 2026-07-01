@extends('layouts.user')

@section('title', 'Form Pengajuan Surat')

@section('header', 'Form Pengajuan - ' . $service['name'])

@section('content')

<style>
.box {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
    max-width: 800px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group textarea,
.form-group input[type="file"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    font-family: inherit;
}

.form-group input[type="file"] {
    padding: 8px;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #16a34a;
}

.btn-submit {
    background: #16a34a;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    width: 100%;
    margin-top: 10px;
}

.btn-submit:hover {
    background: #166534;
}

.form-section-title {
    margin: 25px 0 15px 0;
    color: #166534;
    border-bottom: 2px solid #f0fdf4;
    padding-bottom: 10px;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 13px;
    margin-top: 5px;
}
</style>

<div class="box">
    
    <form action="{{ route('user.pengajuan.store', $slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <h3 class="form-section-title">Identitas Pemohon</h3>
        
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama', Auth::user()->name) }}" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ old('nik') }}" required>
            @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required>
            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        
        <div class="form-group">
            <label>Keterangan Tambahan (Opsional)</label>
            <textarea name="keterangan" rows="2">{{ old('keterangan') }}</textarea>
        </div>

        <h3 class="form-section-title">Upload Persyaratan</h3>
        <p style="font-size: 14px; color: #666; margin-bottom: 15px;">Silakan unggah dokumen berikut dalam format Gambar (JPG/PNG) atau PDF.</p>

        @php
            $allRequirements = array_merge($service['syarat_umum'], $service['syarat_khusus']);
        @endphp

        @foreach($allRequirements as $req)
            @php
                $inputName = 'berkas_' . str_replace([' ', '/', '(', ')', ':'], '_', strtolower($req));
            @endphp
            <div class="form-group">
                <label>{{ $req }} <span style="color: red;">*</span></label>
                <input type="file" name="{{ $inputName }}" accept=".jpg,.jpeg,.png,.pdf" required>
            </div>
        @endforeach

        <button type="submit" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Kirim Pengajuan
        </button>

    </form>
</div>

@endsection
