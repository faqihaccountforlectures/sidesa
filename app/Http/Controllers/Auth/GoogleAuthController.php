<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $driver = Socialite::driver('google');
            $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));
            $socialUser = $driver->user();

            $user = User::where('email', $socialUser->email)->first();

            if ($user && $user->role === 'admin') {
                return redirect()->route('auth.login')->with('alert', 'Akses Ditolak: Akun Admin tidak diizinkan menggunakan Google Login. Silakan gunakan form login standar.');
            }

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->name ?? explode('@', $socialUser->email)[0],
                    'email' => $socialUser->email,
                    'nik' => '',
                    'telp' => '',
                    'alamat' => '',
                    'username' => explode('@', $socialUser->email)[0] . '_' . Str::random(5),
                    'google_id' => $socialUser->id,
                    'google_token' => $socialUser->token,
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'warga',
                ]);
            } else {
                $user->update([
                    'google_id' => $socialUser->id,
                    'google_token' => $socialUser->token,
                ]);
            }

            Auth::login($user);
            session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.dashboard');

        } catch (\Exception $e) {
            return redirect()->route('auth.login')->with('alert', 'Gagal login: ' . $e->getMessage());
        }
    }
}
