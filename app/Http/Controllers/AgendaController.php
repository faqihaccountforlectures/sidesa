<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $search = trim((string) request('search'));

        $agenda = Agenda::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('judul', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhere('penyelenggara', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.agenda.index', compact('agenda', 'search'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'=>'required',
            'tanggal'=>'required',
            'jam'=>'required',
            'penyelenggara'=>'required',
            'lokasi'=>'required',
            'deskripsi'=>'required',
            'status'=>'required',
            'gambar'=>'nullable|image|max:5120'
        ]);

        if($request->hasFile('gambar')){
            $data['gambar'] =
            $request->file('gambar')
            ->store('agenda','public');
        }

        Agenda::create($data);

        return redirect()
        ->route('admin.agenda.index')
        ->with('success','Agenda berhasil ditambahkan');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $request->validate([
            'judul'=>'required',
            'tanggal'=>'required',
            'jam'=>'required',
            'penyelenggara'=>'required',
            'lokasi'=>'required',
            'deskripsi'=>'required',
            'status'=>'required',
            'gambar'=>'nullable|image|max:5120'
        ]);

        if($request->hasFile('gambar')){
            if ($agenda->gambar) {
                \Storage::disk('public')->delete($agenda->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('agenda','public');
        }

        $agenda->update($data);

        return redirect()
        ->route('admin.agenda.index')
        ->with('success','Agenda berhasil diperbarui');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->gambar) {
            \Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return back()
        ->with('success','Agenda berhasil dihapus');
    }
    public function kegiatan()
    {
        $agendas = Agenda::latest()->paginate(10);

        return view('kegiatan', compact('agendas'));
    }
}
