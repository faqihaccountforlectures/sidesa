<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengurusDesa extends Model
{
    protected $fillable = [
        'nama', 'kategori', 'jabatan', 'foto', 'telepon', 'alamat', 'jumlah_kk'
    ];
}
