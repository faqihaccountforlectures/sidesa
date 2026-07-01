<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    public const STATUS_DIPROSES = 'Diproses';
    public const STATUS_SELESAI = 'Selesai';
    public const STATUS_DITOLAK = 'Ditolak';

    public const STATUSES = [
        self::STATUS_DIPROSES,
        self::STATUS_SELESAI,
        self::STATUS_DITOLAK,
    ];

    protected $fillable = [

        'user_id',
        'nama',
        'telp',
        'kategori',
        'pengaduan',
        'file',
        'status'

    ];

    public static function statusCounts(?Builder $query = null): array
    {
        $counts = array_fill_keys(self::STATUSES, 0);

        $query = ($query ?? static::query())
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status');

        foreach ($query->pluck('aggregate', 'status') as $status => $total) {
            if (array_key_exists($status, $counts)) {
                $counts[$status] = (int) $total;
            }
        }

        return $counts;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
