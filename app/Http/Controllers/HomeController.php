<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'agendas' => Agenda::latest()->take(6)->get(),
            'beritas' => Berita::latest()->take(4)->get(),
        ]);
    }
}
