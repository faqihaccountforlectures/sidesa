<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // ADMIN ROUTES
    public function index()
    {
        $search = trim((string) request('search'));

        $berita = Berita::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('judul', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%")
                        ->orWhere('penulis', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.berita.index', compact('berita', 'search'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'penulis' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'penulis' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|max:5120'
        ]);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus');
    }

    // PUBLIC ROUTE
    public function warta()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('berita', compact('beritas'));
    }

    public function showPublic($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Dapatkan berita terkait dengan kategori yang sama (selain berita ini)
        $terkait = Berita::where('kategori', $berita->kategori)
                        ->where('id', '!=', $berita->id)
                        ->latest()
                        ->take(3)
                        ->get();

        return view('berita-detail', compact('berita', 'terkait'));
    }
}
