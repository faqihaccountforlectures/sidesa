<?php

namespace Tests\Feature;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengaduanStatusFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengaduan_status_ditolak_flow_updates_database_and_views(): void
    {
        $warga = User::factory()->create([
            'name' => 'Warga Uji',
            'nik' => '3171000101010001',
            'telp' => '081234567890',
            'alamat' => 'Jl. Mawar 1',
            'username' => 'wargauji',
            'role' => 'warga',
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin Uji',
            'nik' => '3171000101010002',
            'telp' => '081234567891',
            'alamat' => 'Jl. Melati 2',
            'username' => 'adminuji',
            'role' => 'admin',
        ]);

        $this->actingAs($warga)->post(route('pengaduan.store'), [
            'nama' => 'Warga Uji',
            'telp' => '081234567890',
            'kategori' => 'umum',
            'pengaduan' => 'Lampu jalan mati di RT 01.',
        ])->assertRedirect();

        $pengaduan = Pengaduan::firstOrFail();

        $this->assertSame(Pengaduan::STATUS_DIPROSES, $pengaduan->status);

        $this->actingAs($admin)->get(route('admin.pengaduan'))
            ->assertOk()
            ->assertSee('Ditolak')
            ->assertSee('0');

        $this->actingAs($admin)->get(route('admin.pengaduan.show', $pengaduan))
            ->assertOk()
            ->assertSee('option value="Ditolak"', false);

        $this->actingAs($admin)->patch(route('admin.pengaduan.update-status', $pengaduan), [
            'status' => Pengaduan::STATUS_DITOLAK,
        ])->assertRedirect(route('admin.pengaduan.show', $pengaduan));

        $this->assertDatabaseHas('pengaduans', [
            'id' => $pengaduan->id,
            'status' => Pengaduan::STATUS_DITOLAK,
        ]);

        $this->actingAs($admin)->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Statistik Pengaduan')
            ->assertSee('Ditolak');

        $this->actingAs($admin)->get(route('admin.pengaduan'))
            ->assertOk()
            ->assertSee(Pengaduan::STATUS_DITOLAK)
            ->assertSee('1');

        $this->actingAs($warga)->get(route('user.dashboard'))
            ->assertOk()
            ->assertSee(Pengaduan::STATUS_DITOLAK);

        $this->actingAs($warga)->get(route('pengaduan.landing'))
            ->assertOk()
            ->assertSee(Pengaduan::STATUS_DITOLAK)
            ->assertSee('Pengaduan Ditolak');
    }
}
