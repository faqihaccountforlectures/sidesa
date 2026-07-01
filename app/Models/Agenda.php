<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'judul',
        'tanggal',
        'jam',
        'penyelenggara',
        'lokasi',
        'deskripsi',
        'gambar',
        'status'
    ];
}