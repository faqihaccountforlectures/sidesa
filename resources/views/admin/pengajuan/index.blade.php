@extends('layouts.admin')

@section('title', 'Manajemen Pengajuan Surat')

@section('header', 'Pengajuan Surat')

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

.btn-detail {
    background: #16a34a;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
}

.btn-detail:hover {
    background: #166534;
}
</style>

<div class="box">
    
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Daftar Pengajuan Masuk</h3>
    </div>

    <div class="table-responsive">
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pemohon</th>
                <th>Jenis Surat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @forelse($pengajuans as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenis_surat }}</td>
                <td>
                    <span class="status {{
                        $item->status === 'Selesai' ? 'selesai' :
                        ($item->status === 'Ditolak' ? 'ditolak' : 'proses')
                    }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.pengajuan.show', $item->id) }}" class="btn-detail">
                        <i class="fa-solid fa-eye"></i> Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada pengajuan surat yang masuk.</td>
            </tr>
            @endforelse
        </table>
    </div>

</div>

@endsection
