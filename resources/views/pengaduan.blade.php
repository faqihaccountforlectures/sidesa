@extends('layouts.utama')

@push('styles')
<style>
       
.pengaduan-page{
    padding:40px;
}

.header-pengaduan{
    text-align:center;
    margin-bottom:30px;
}

.header-pengaduan h1{
    color:#166534;
    font-size:35px;
}

.header-pengaduan p{
    color:#666;
    margin-top:10px;
}

.pengaduan-stats{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.stat-box{
    background:white;
    padding:25px;
    border-radius:18px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.stat-box i{
    font-size:40px;
    color:#16a34a;
    margin-bottom:10px;
}

.stat-box h2{
    color:#166534;
}

.pengaduan-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
}

.pengaduan-form,
.tracking{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.pengaduan-form h3,
.tracking h3{
    margin-bottom:20px;
    color:#166534;
}

.input-box{
    margin-bottom:18px;
}

.input-box label{
    display:block;
    margin-bottom:6px;
    font-weight:500;
}

.input-box input,
.input-box select,
.input-box textarea{
    width:100%;
    border:1px solid #ddd;
    border-radius:12px;
    padding:14px;
    outline:none;
}

.input-box textarea{
    height:130px;
    resize:none;
}

.input-box input:focus,
.input-box select:focus,
.input-box textarea:focus{
    border-color:#16a34a;
}

.btn-kirim{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:linear-gradient(
    135deg,
    #16a34a,
    #166534);
    color:white;
    font-weight:600;
    cursor:pointer;
}

.tracking-card{
    border-left:5px solid #16a34a;
    padding:15px;
    background:#f8fafc;
    border-radius:12px;
    margin-bottom:15px;
}

.status{
    display:inline-block;
    padding:5px 12px;
    border-radius:30px;
    font-size:12px;
    margin-bottom:10px;
}

.status.proses{
    background:#fff3cd;
    color:#856404;
}

.status.selesai{
    background:#dcfce7;
    color:#166534;
}

.status.ditolak{
    background:#fee2e2;
    color:#991b1b;
}

.tracking-card h4{
    margin-bottom:5px;
}

.tracking-card p{
    color:#666;
    margin-bottom:5px;
}
/* Tombol Lampiran */

.file-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:12px;
    padding:10px 18px;
    background:linear-gradient(135deg,#16a34a,#166534);
    color:#fff;
    text-decoration:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    transition:.3s ease;
    box-shadow:0 4px 12px rgba(22,163,74,.25);
}

.file-btn i{
    font-size:15px;
}

.file-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(22,163,74,.35);
    background:linear-gradient(135deg,#15803d,#14532d);
}

.file-btn:active{
    transform:scale(.98);
}

@media(max-width:991px){

    .pengaduan-grid{
        grid-template-columns:1fr;
    }

    .pengaduan-stats{
        grid-template-columns:1fr;
    }

}
    </style>
@endpush

@section('content')
    <section class="pengaduan-page">

    <div class="header-pengaduan">

        <h1>
            <i class="fa-solid fa-comments"></i>
            Layanan Pengaduan Masyarakat
        </h1>

        <p>
            Sampaikan keluhan, masukan, atau aspirasi Anda kepada Pemerintah Desa.
        </p>

    </div>

    <!-- STATISTIK -->

    <div class="pengaduan-stats">

        <div class="stat-box">
            <i class="fa-solid fa-envelope-open-text"></i>
            <h2>{{ $total }}</h2>
            <p>Total Pengaduan</p>
        </div>

        <div class="stat-box">
            <i class="fa-solid fa-spinner"></i>
            <h2>{{ $stats['Diproses'] }}</h2>
            <p>Pengaduan Diproses</p>
        </div>

        <div class="stat-box">
            <i class="fa-solid fa-circle-check"></i>
            <h2>{{ $stats['Selesai'] }}</h2>
            <p>Pengaduan Selesai</p>
        </div>

        <div class="stat-box">
            <i class="fa-solid fa-circle-xmark"></i>
            <h2>{{ $stats['Ditolak'] }}</h2>
            <p>Pengaduan Ditolak</p>
        </div>

    </div>

    <div class="pengaduan-grid">

        <!-- FORM -->

        <div class="pengaduan-form">

            <h3>Buat Pengaduan Baru</h3>
            @guest
                <p>Silakan login terlebih dahulu untuk mengirim pengaduan.</p>
            @endguest

            <form action="{{ route('pengaduan.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
                <div class="input-box">
                    <label>Nama Lengkap</label>
                    <input name="nama" type="text" value="{{ old('nama', auth()->user()->name ?? '') }}">
                </div>

                <div class="input-box">
                    <label>No WhatsApp</label>
                    <input name="telp" type="text" value="{{ old('telp', auth()->user()->telp ?? '') }}">
                </div>

                <div class="input-box">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="umum">Umum</option>
                        <option value="infrastruktur">Infrastruktur</option>
                        <option value="kebersihan">Kebersihan</option>
                        <option value="keamanan">Keamanan</option>
                        <option value="sosial">Sosial</option>
                    </select>
                </div>


                <div class="input-box">
                    <label>Isi Pengaduan</label>
                    <textarea name="pengaduan">{{ old('pengaduan') }}</textarea>
                </div>

                <div class="input-box">
                    <label>Upload File(opsional)</label>
                    <input name="file" type="file">
                </div>

                <button type="submit" class="btn-kirim">
                    <i class="fa-solid fa-paper-plane"></i>
                    Kirim Pengaduan
                </button>

            </form>

        </div>

        <!-- STATUS -->

        <div class="tracking">

            <h3>Status Pengaduan</h3>
            @forelse($pengaduans as $item)

            <div class="tracking-card">

                <div class="status {{
                    $item->status === 'Selesai'
                        ? 'selesai'
                        : ($item->status === 'Ditolak' ? 'ditolak' : 'proses')
                }}">

                    {{ $item->status }}

                </div>

                <h4>{{ ucfirst($item->kategori) }}</h4>

                <p>{{ $item->pengaduan }}</p>

                <small>

                    {{ $item->created_at->format('d M Y') }}

                </small><br>
                @if($item->file)
                    <a href="{{ Storage::url($item->file) }}"
                    target="_blank"
                    class="file-btn">

                        <i class="fa-solid fa-file-arrow-down"></i>
                        Lihat Lampiran

                    </a>
                @endif
            </div>

            @empty
                <p>Belum ada pengaduan yang tercatat untuk akun ini.</p>
            @endforelse

            

        </div>

    </div>

</section>
@endsection
