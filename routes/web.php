<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\PengurusDesaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\User\PengajuanSuratController as UserPengajuanSuratController;
use App\Http\Controllers\Admin\PengajuanSuratController as AdminPengajuanSuratController;
use App\Models\PengurusDesa;

// --- Auth Routes ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.authentication');
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.store');

    Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.redirect'); 
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.callback'); 

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
    Route::get('/reset-password', function () { return redirect()->route('password.request'); });
});

Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');


// --- Admin Routes ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengurus', PengurusDesaController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('agenda', AgendaController::class);
    Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan');
    Route::get('/pengaduan/{pengaduan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.update-status');
    
    // Pengajuan Surat (Admin)
    Route::get('/pengajuan', [AdminPengajuanSuratController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{id}', [AdminPengajuanSuratController::class, 'show'])->name('pengajuan.show');
    Route::put('/pengajuan/{id}', [AdminPengajuanSuratController::class, 'update'])->name('pengajuan.update');

    // Settings
    Route::get('/settings/peta', [AdminSettingController::class, 'editPeta'])->name('settings.peta');
    Route::put('/settings/peta', [AdminSettingController::class, 'updatePeta'])->name('settings.peta.update');
});


// --- User / Warga Routes ---
Route::middleware(['auth', 'role:warga'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Pengajuan Surat
    Route::get('/pengajuan/riwayat', [UserPengajuanSuratController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/buat/{slug}', [UserPengajuanSuratController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/buat/{slug}', [UserPengajuanSuratController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/download/{id}', [UserPengajuanSuratController::class, 'download'])->name('pengajuan.download');
});

// --- Profile Route (Shared auth) ---
Route::middleware('auth')->group(function() {
    Route::get('/profil', [ProfileController::class, 'showProfile'])->name('profile');
    Route::post('/profil/update', [ProfileController::class, 'updateProfile'])->name('profil.update');
    Route::post('/profil/avatar', [ProfileController::class, 'updateAvatar'])->name('profil.updateAvatar');
    Route::post('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.updatePassword');
});


// --- Public Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// Berita
Route::get('/berita', [BeritaController::class, 'warta'])->name('berita.warta');
Route::get('/berita/{id}', [BeritaController::class, 'showPublic'])->name('berita.showPublic');

// Agenda / Kegiatan
Route::get('/kegiatan', [AgendaController::class, 'kegiatan'])->name('kegiatan');

// Profil Desa
Route::get('/sejarah', function () { return view('profil_desa.sejarah'); });
Route::get('/visi_misi', function () { return view('profil_desa.visi_misi'); });
Route::get('/struktur-organisasi', function () { 
    $kades = App\Models\PengurusDesa::where('kategori', 'Desa')->where('jabatan', 'like', '%Kepala Desa%')->first();
    $sekdes = App\Models\PengurusDesa::where('kategori', 'Desa')->where('jabatan', 'like', '%Sekretaris%')->first();
    $perangkat = App\Models\PengurusDesa::where('kategori', 'Desa')
                    ->where(function($q) {
                        $q->where('jabatan', 'not like', '%Kepala Desa%')
                          ->where('jabatan', 'not like', '%Sekretaris%');
                    })->get();
    return view('profil_desa.struktur_organisasi', compact('kades', 'sekdes', 'perangkat')); 
});

// Pemerintahan
Route::get('/ketuaRW', function () {
    $rw = App\Models\PengurusDesa::where('kategori', 'RW')->get();
    return view('pemerintahan.ketua_rw', compact('rw'));
});
Route::get('/ketuaRT', function () {
    $rt = App\Models\PengurusDesa::where('kategori', 'RT')->get();
    return view('pemerintahan.ketua_rt', compact('rt'));
});
Route::get('/pkk', function () {
    $ketua = PengurusDesa::where('kategori', 'PKK')->where('jabatan', 'like', '%Ketua%')->first();
    $anggota = PengurusDesa::where('kategori', 'PKK')->where('id', '!=', $ketua->id ?? 0)->get();
    return view('pemerintahan.pkk', compact('ketua', 'anggota'));
});
Route::get('/lpm', function () {
    $ketua = PengurusDesa::where('kategori', 'LPM')->where('jabatan', 'like', '%Ketua%')->first();
    $anggota = PengurusDesa::where('kategori', 'LPM')->where('id', '!=', $ketua->id ?? 0)->get();
    return view('pemerintahan.lpm', compact('ketua', 'anggota'));
});
Route::get('/bpd', function () {
    $ketua = PengurusDesa::where('kategori', 'BPD')->where('jabatan', 'like', '%Ketua%')->first();
    $anggota = PengurusDesa::where('kategori', 'BPD')->where('id', '!=', $ketua->id ?? 0)->get();
    return view('pemerintahan.bpd', compact('ketua', 'anggota'));
});

// Layanan
Route::get('/layanan-manual', [LayananController::class, 'manual'])->name('layanan.manual');
Route::get('/layanan-manual/{slug}', [LayananController::class, 'manualDetail'])->name('layanan.manual.detail');
Route::get('/layanan-online', [LayananController::class, 'online'])->name('layanan.online');
Route::get('/statusIDM26', function () { return view('statusIDM26'); });
Route::get('/statusIDM25', function () { return view('statusIDM25'); });
Route::get('/peta', function () { 
    $mapLink = \App\Models\Setting::where('key', 'map_embed_url')->first()->value ?? '';
    return view('peta', compact('mapLink')); 
})->name('peta');

// Pengaduan
Route::get('/pengaduan', [PengaduanController::class, 'landing'])->name('pengaduan.landing');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('auth');
Route::get('/pengaduan/list', [PengaduanController::class, 'index'])->name('pengaduan.index')->middleware('auth');

