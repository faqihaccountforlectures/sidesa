<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function landing()
    {
        $pengaduans = Auth::check()
            ? Pengaduan::where('user_id', Auth::id())->latest()->get()
            : collect();
        $statusCounts = Pengaduan::statusCounts();

        return view('pengaduan', [
            'pengaduans' => $pengaduans,
            'total' => Pengaduan::count(),
            'stats' => $statusCounts,
        ]);
    }

    public function index()
    {
        $pengaduans = Pengaduan::where('user_id',Auth::id())
                        ->latest()
                        ->get();
        $statusCounts = Pengaduan::statusCounts();

        return view('pengaduan',[
            'pengaduans'=>$pengaduans,

            'total'=>Pengaduan::count(),
            'stats'=>$statusCounts

        ]);

    }

    public function store(Request $request)
    {

        $request->validate([

            'nama'=>'required',

            'telp'=>'required',

            'kategori'=>'required',

            'pengaduan'=>'required',

            'file' => 'nullable|file|max:5120'

        ]);

        $file=null;

        if($request->hasFile('file')){

            $file=$request->file('file')
                    ->store('pengaduan','public');

        }

        Pengaduan::create([

            'user_id'=>Auth::id(),

            'nama'=>$request->nama,

            'telp'=>$request->telp,

            'kategori'=>$request->kategori,

            'pengaduan'=>$request->pengaduan,

            'file'=>$file,

            'status'=>Pengaduan::STATUS_DIPROSES

        ]);

        return back()->with('success','Pengaduan berhasil dikirim');

    }
}
