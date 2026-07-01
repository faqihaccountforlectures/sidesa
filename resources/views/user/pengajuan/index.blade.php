@extends('layouts.user')

@section('title', 'Riwayat Pengajuan Surat')

@section('header', 'Riwayat Pengajuan Surat')

@section('content')

<style>
.box {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,.05);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

table th {
    background: #f8fafc;
    color: #166534;
}

.status {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
    display: inline-block;
}

.proses { background: #fff3cd; color: #856404; }
.selesai { background: #d4edda; color: #155724; }
.ditolak { background: #fee2e2; color: #991b1b; }

.btn-download {
    background: #16a34a;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

.btn-download:hover {
    background: #166534;
}

.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.alert-success {
    background: #d4edda;
    color: #155724;
}
</style>

<div class="box">
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Daftar Pengajuan Saya</h3>
        <a href="{{ route('layanan.online') }}" class="btn-download" style="font-size: 14px;">+ Ajukan Surat</a>
    </div>

    <table>
        <tr>
            <th>Tanggal</th>
            <th>Jenis Surat</th>
            <th>Status</th>
            <th>Catatan Admin</th>
            <th>Aksi</th>
        </tr>
        @forelse($pengajuans as $item)
        <tr>
            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
            <td>{{ $item->jenis_surat }}</td>
            <td>
                <span class="status {{
                    $item->status === 'Selesai' ? 'selesai' :
                    ($item->status === 'Ditolak' ? 'ditolak' : 'proses')
                }}">
                    {{ $item->status }}
                </span>
            </td>
            <td>{{ $item->catatan_admin ?? '-' }}</td>
            <td>
                @if($item->status === 'Selesai' && $item->file_hasil)
                    <a href="{{ route('user.pengajuan.download', $item->id) }}" class="btn-download">
                        <i class="fa-solid fa-download"></i> Unduh
                    </a>
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">Belum ada riwayat pengajuan surat.</td>
        </tr>
        @endforelse
    </table>

</div>
@endsection
