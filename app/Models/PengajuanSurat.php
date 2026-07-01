<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_surat',
        'nama',
        'nik',
        'no_hp',
        'alamat',
        'email',
        'keterangan',
        'berkas',
        'status',
        'catatan_admin',
        'file_hasil',
    ];

    protected $casts = [
        'berkas' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getServices()
    {
        return [
            'domisili' => [
                'name' => 'Surat Domisili',
                'icon' => 'fa-house-user',
                'desc' => 'Surat keterangan yang menerangkan tempat tinggal (domisili) seseorang di wilayah desa.',
                'syarat_umum' => [
                    'Fotokopi KTP',
                    'Fotokopi KK',
                    'Surat Pengantar RT/RW'
                ],
                'syarat_khusus' => [],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'usaha' => [
                'name' => 'Surat Keterangan Usaha (SKU)',
                'icon' => 'fa-store',
                'desc' => 'Surat keterangan yang menerangkan bahwa seseorang benar memiliki usaha di wilayah desa.',
                'syarat_umum' => [
                    'KTP',
                    'KK',
                    'Surat Pengantar RT/RW'
                ],
                'syarat_khusus' => [
                    'Foto tempat usaha',
                    'Jenis usaha',
                    'Alamat usaha',
                    'Lama usaha'
                ],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'sktm' => [
                'name' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'icon' => 'fa-file-circle-check',
                'desc' => 'Surat keterangan yang menerangkan bahwa warga berstatus kurang mampu.',
                'syarat_umum' => [
                    'KTP',
                    'KK',
                    'Surat Pengantar RT/RW'
                ],
                'syarat_khusus' => [
                    'Surat RT',
                    'KIP / PKH / KKS',
                    'Foto rumah'
                ],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'kematian' => [
                'name' => 'Surat Keterangan Kematian',
                'icon' => 'fa-bed',
                'desc' => 'Surat keterangan untuk pelaporan kematian warga.',
                'syarat_umum' => [
                    'KTP',
                    'KK',
                    'Surat RT'
                ],
                'syarat_khusus' => [
                    'Surat dokter / RS',
                    'KTP almarhum',
                    'KTP pelapor',
                    'KTP 2 saksi'
                ],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'kelahiran' => [
                'name' => 'Surat Keterangan Kelahiran',
                'icon' => 'fa-baby',
                'desc' => 'Surat keterangan untuk pelaporan kelahiran warga baru.',
                'syarat_umum' => [
                    'KTP',
                    'KK',
                    'Surat RT'
                ],
                'syarat_khusus' => [
                    'Surat lahir',
                    'Buku Nikah',
                    'KTP saksi'
                ],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'nikah' => [
                'name' => 'Surat Pengantar Nikah',
                'icon' => 'fa-users',
                'desc' => 'Surat pengantar untuk keperluan pendaftaran pernikahan ke KUA.',
                'syarat_umum' => [
                    'KTP',
                    'KK',
                    'Surat RT'
                ],
                'syarat_khusus' => [
                    'Akta lahir',
                    'KTP orang tua',
                    'KTP calon pasangan',
                    'Pas Foto',
                    'Akta Cerai / Akta Kematian bila diperlukan'
                ],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'pindah' => [
                'name' => 'Surat Keterangan Pindah',
                'icon' => 'fa-truck-fast',
                'desc' => 'Surat keterangan untuk warga yang akan pindah domisili atau datang ke desa.',
                'syarat_umum' => [
                    'KTP',
                    'KK',
                    'Surat RT'
                ],
                'syarat_khusus' => [
                    'Pindah: KK Asli',
                    'Pindah: Alamat tujuan',
                    'Datang: SKPWNI asli'
                ],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'mitra-rekomendasi' => [
                'name' => 'Surat Rekomendasi Kegiatan',
                'icon' => 'fa-handshake',
                'desc' => 'Surat rekomendasi untuk pelaksanaan kegiatan dari mitra/organisasi.',
                'syarat_umum' => [
                    'KTP',
                    'Proposal Kegiatan',
                    'Surat Permohonan'
                ],
                'syarat_khusus' => [],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'mitra-kerjasama' => [
                'name' => 'Surat Kerja Sama',
                'icon' => 'fa-file-signature',
                'desc' => 'Surat keterangan kerja sama antara desa dan instansi/mitra.',
                'syarat_umum' => [
                    'KTP',
                    'Profil Instansi/Lembaga',
                    'Surat Permohonan'
                ],
                'syarat_khusus' => [],
                'estimasi' => '1-3 Hari Kerja',
                'biaya' => 'Gratis'
            ],
            'mitra-penelitian' => [
                'name' => 'Surat Izin Penelitian',
                'icon' => 'fa-microscope',
                'desc' => 'Surat izin untuk melakukan penelitian / observasi di wilayah desa.',
                'syarat_umum' => [
                    'KTP',
                    'Surat Pengantar Kampus/Lembaga',
                    'Proposal Penelitian'
                ],
                'syarat_khusus' => [],
                'estimasi' => '1 Hari Kerja',
                'biaya' => 'Gratis'
            ]
        ];
    }
}
