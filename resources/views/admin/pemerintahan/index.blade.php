@extends('layouts.admin')

@section('title', 'Kelola Pemerintahan Desa')
@section('header', 'Pengurus Pemerintahan Desa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 text-success">Daftar Pengurus Desa</h4>
    <a href="{{ route('admin.pengurus.create') }}" class="btn btn-success rounded-pill px-4">
        <i class="fa-solid fa-plus me-2"></i> Tambah Pengurus
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-success text-success">
                    <tr>
                        <th class="py-3 px-4 rounded-top-start">Foto</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Jabatan</th>
                        <th class="py-3 px-4 rounded-top-end text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengurus as $item)
                    <tr>
                        <td class="py-3 px-4">
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" alt="Foto" class="rounded-circle object-fit-cover shadow-sm" style="width: 50px; height: 50px;">
                            @else
                                <div class="rounded-circle bg-secondary bg-opacity-25 d-flex justify-content-center align-items-center text-secondary shadow-sm" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-3">
                            <h6 class="mb-1 text-dark fw-bold">{{ $item->nama }}</h6>
                            <small class="text-muted"><i class="fa-solid fa-phone me-1"></i> {{ $item->telepon ?? '-' }}</small>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $item->kategori }}</span>
                        </td>
                        <td class="py-3 text-muted">{{ $item->jabatan }}</td>
                        <td class="py-3 px-4 text-end">
                            <a href="{{ route('admin.pengurus.edit', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.pengurus.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-folder-open fs-1 mb-3 text-success opacity-50"></i>
                            <p class="mb-0">Belum ada data pengurus desa.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambahkan CDN Bootstrap 5 (JS) di layout admin jika belum ada untuk alert dismissible -->
@endsection
