<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $suratCount = Schema::hasTable('surat_pengajuans')
            ? \DB::table('surat_pengajuans')->where('user_id', $user->id)->count()
            : 0;

        return view('user.dashboard', [
            'stats' => [
                'surat' => $suratCount,
                'pengaduan' => Pengaduan::where('user_id', $user->id)->count(),
                'agenda' => Agenda::count(),
                'berita' => Berita::count(),
            ],
            'pengaduanTerbaru' => Pengaduan::where('user_id', $user->id)->latest()->take(5)->get(),
            'agendaTerbaru' => Agenda::latest()->take(5)->get(),
        ]);
    }
}
