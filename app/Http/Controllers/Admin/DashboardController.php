<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Pengaduan;
use App\Models\PengajuanSurat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $suratCount = PengajuanSurat::count();
        $statusCounts = Pengaduan::statusCounts();

        return view('admin.dashboard', [
            'stats' => [
                'total_penduduk' => User::where('role', 'warga')->count(),
                'total_surat' => $suratCount,
                'total_pengaduan' => Pengaduan::count(),
                'pengaduan_diproses' => $statusCounts[Pengaduan::STATUS_DIPROSES],
                'pengaduan_selesai' => $statusCounts[Pengaduan::STATUS_SELESAI],
                'pengaduan_ditolak' => $statusCounts[Pengaduan::STATUS_DITOLAK],
                'total_agenda' => Agenda::count(),
            ],
            'pengaduanTerbaru' => Pengaduan::latest()->take(5)->get(),
        ]);
    }
}
