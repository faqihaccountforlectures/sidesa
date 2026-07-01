<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;

class LayananController extends Controller
{
    public function manual()
    {
        $services = PengajuanSurat::getServices();
        return view('layanan_manual', compact('services'));
    }

    public function manualDetail($slug)
    {
        $services = PengajuanSurat::getServices();
        if (!isset($services[$slug])) {
            abort(404);
        }

        $service = $services[$slug];
        return view('layanan_manual_detail', compact('service'));
    }

    public function online()
    {
        $services = PengajuanSurat::getServices();
        return view('layanan_online', compact('services'));
    }
}
