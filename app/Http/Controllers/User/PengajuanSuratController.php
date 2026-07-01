<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Storage;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanSurat::where('user_id', auth()->id())->latest()->get();
        return view('user.pengajuan.index', compact('pengajuans'));
    }

    public function create($slug)
    {
        $services = PengajuanSurat::getServices();
        if (!isset($services[$slug])) {
            abort(404);
        }

        $service = $services[$slug];
        return view('user.pengajuan.create', compact('service', 'slug'));
    }

    public function store(Request $request, $slug)
    {
        $services = PengajuanSurat::getServices();
        if (!isset($services[$slug])) {
            abort(404);
        }

        $service = $services[$slug];

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
        ]);

        $berkas = [];
        
        // Loop through required files based on service requirements
        $allRequirements = array_merge($service['syarat_umum'], $service['syarat_khusus']);
        
        foreach ($allRequirements as $req) {
            $inputName = 'berkas_' . str_replace([' ', '/', '(', ')', ':'], '_', strtolower($req));
            if ($request->hasFile($inputName)) {
                $path = $request->file($inputName)->store('pengajuan_berkas', 'public');
                $berkas[$req] = $path;
            }
        }

        PengajuanSurat::create([
            'user_id' => auth()->id(),
            'jenis_surat' => $service['name'],
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'keterangan' => $request->keterangan,
            'berkas' => $berkas,
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect()->route('user.pengajuan.index')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    public function download($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', auth()->id())->findOrFail($id);

        if ($pengajuan->status !== 'Selesai' || !$pengajuan->file_hasil) {
            return back()->with('error', 'Surat belum tersedia.');
        }

        return Storage::disk('public')->download($pengajuan->file_hasil);
    }
}
