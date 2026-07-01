@extends('layouts.admin')

@section('title','Berita Desa')
@section('header','Kelola Warta Desa')

@section('content')

<style>

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-title h2{
    color:#166534;
    margin-bottom:5px;
}

.page-title p{
    color:#777;
}

.btn-add{
    background:linear-gradient(135deg,#16a34a,#15803d);
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:12px;
    font-weight:600;
    transition:.3s;
}

.btn-add:hover{
    transform:translateY(-2px);
    color: white;
}

.stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-bottom:25px;
}

.stat-card{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
}

.stat-card h3{
    color:#666;
    font-size:14px;
}

.stat-card h1{
    color:#166534;
    margin-top:10px;
}

.search-box{
    margin-bottom:25px;
}

.search-box input{
    width:100%;
    padding:14px 18px;
    border:1px solid #ddd;
    border-radius:12px;
    outline:none;
}

.berita-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
    gap:25px;
}

.berita-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
    transition:.3s;
}

.berita-card:hover{
    transform:translateY(-5px);
}

.berita-card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.card-body{
    padding:20px;
}

.badge-kategori{
    display:inline-block;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    background:#dcfce7;
    color:#166534;
}

.card-body h3{
    margin:15px 0;
    color:#222;
    font-size: 18px;
    line-height: 1.4;
}

.info{
    color:#666;
    margin-bottom:8px;
    font-size:13px;
}

.info i{
    width:20px;
    color:#16a34a;
}

.action{
    display:flex;
    gap:10px;
    margin-top:20px;
}

.btn-edit{
    flex:1;
    background:#3b82f6;
    color:white;
    text-align:center;
    padding:10px;
    margin-right:10px;
    border-radius:10px;
    text-decoration:none;
}

.btn-delete{
    flex:1;
    background:#ef4444;
    color:white;
    border:none;
    border-radius:10px;
    padding: 10px;
    cursor:pointer;
}

</style>

<div class="page-header">
    <div class="page-title">
        <p>Kelola publikasi dan berita desa terkini</p>
    </div>
    <a href="{{ route('admin.berita.create') }}" class="btn-add">
        + Tulis Berita
    </a>
</div>

<div class="stats">
    <div class="stat-card">
        <h3>Total Berita</h3>
        <h1>{{ $berita->count() }}</h1>
    </div>
    <div class="stat-card">
        <h3>Berita Bulan Ini</h3>
        <h1>{{ $berita->where('tanggal', '>=', \Carbon\Carbon::now()->startOfMonth())->count() }}</h1>
    </div>
    <div class="stat-card">
        <h3>Pembangunan</h3>
        <h1>{{ $berita->where('kategori','Pembangunan')->count() }}</h1>
    </div>
</div>

<div class="search-box">
    <input type="text" placeholder="Cari warta desa...">
</div>

<div class="berita-grid">
    @foreach($berita as $item)
    <div class="berita-card">
        @if($item->gambar)
            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}">
        @else
            <img src="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Default Image">
        @endif
        
        <div class="card-body">
            <span class="badge-kategori">{{ $item->kategori }}</span>
            <h3>{{ Str::limit($item->judul, 50) }}</h3>
            <div class="info">
                <i class="fa-solid fa-calendar"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
            </div>
            <div class="info">
                <i class="fa-solid fa-user"></i> {{ $item->penulis }}
            </div>
            
            <div class="action">
                <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn-edit">Edit</a>
                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" style="flex:1" onsubmit="return confirm('Hapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete w-100">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="margin-top:30px;">
    {{ $berita->links() }}
</div>

@endsection
