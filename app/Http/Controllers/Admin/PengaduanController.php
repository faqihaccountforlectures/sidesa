<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $statusCounts = Pengaduan::statusCounts();

        $query = Pengaduan::query()
            ->with('user')
            ->latest();

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('nama', 'like', "%{$search}%")
                    ->orWhere('telp', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('pengaduan', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $pengaduans = $query->paginate(10)->withQueryString();

        return view('admin.pengaduan', [
            'pengaduans' => $pengaduans,
            'search' => $search,
            'stats' => array_merge([
                'total' => Pengaduan::count(),
                'hari_ini' => Pengaduan::whereDate('created_at', today())->count(),
            ], $statusCounts),
        ]);
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load('user');

        return view('admin.pengaduan-show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(Pengaduan::STATUSES)],
        ]);

        $pengaduan->update($data);

        return redirect()
            ->route('admin.pengaduan.show', $pengaduan)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
