<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function editPeta()
    {
        $mapLink = \App\Models\Setting::where('key', 'map_embed_url')->first()->value ?? '';
        return view('admin.settings.peta', compact('mapLink'));
    }

    public function updatePeta(Request $request)
    {
        $request->validate([
            'map_embed_url' => 'required|url'
        ]);

        \App\Models\Setting::updateOrCreate(
            ['key' => 'map_embed_url'],
            ['value' => $request->map_embed_url]
        );

        return redirect()->back()->with('success', 'Link Peta berhasil diperbarui.');
    }
}
