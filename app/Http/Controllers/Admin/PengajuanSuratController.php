<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Storage;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanSurat::latest()->get();
        return view('admin.pengajuan.index', compact('pengajuans'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        return view('admin.pengajuan.show', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Diproses,Selesai,Ditolak',
            'file_hasil' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($request->hasFile('file_hasil')) {
            if ($pengajuan->file_hasil) {
                Storage::disk('public')->delete($pengajuan->file_hasil);
            }
            $pengajuan->file_hasil = $request->file('file_hasil')->store('pengajuan_hasil', 'public');
        }

        $pengajuan->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin
        ]);

        return redirect()->route('admin.pengajuan.show', $id)->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
