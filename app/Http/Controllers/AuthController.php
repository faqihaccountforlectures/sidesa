<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Auth;

use NoCaptcha;




class AuthController extends Controller
{
    
    //register form
    public function register()
    {
        return view('auth.register');
    }
    // store register
    public function store(Request $request, User $user, Auth $auth)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required',
            'password' => 'required|confirmed',
        ],[
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);
        // dd($request);   

        $user->create([
            'name'  => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password'  => Hash::make($request->password),
        ]);

         $credential = $request->only('email', 'password');
        $auth::attempt($credential);
        $request->session()->regenerate();


        return redirect()->route('dashboard')->with('alert', [
            'icon' => 'success',
            'title' => 'Sukses',
            'text' => 'User berhasil ditambahkan!',
        ]);
    }

    //login form
    public function login()
   {
        return view('auth.login');
   }
   // authentication
   public function auth(Request $request, Auth $auth)
   {
        // validasi form input
        $request->validate([
            'email'  => 'required|email', 
            'password' => 'required',
            // 'g-recaptcha-response' => 'required'
        ]);

        // proses authentikasi
        $credential = $request->only('email', 'password');
        if ($auth::attempt($credential))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        // jika proses authentikasi gagal maka akan di redirect ke halaman login
        return back()->withErrors([
            'email' => 'Email atau password tidak ditemukan',
        ])->onlyInput('email');

   }

   // dashboard
   public function dashboard()
{
    // if (Auth::user()->email == 'admin@gmail.com') {
        
        

    //     return view('auth.dashboard_admin', compact(

    //     ));
    // }


    return view('auth.dashboard', compact());
}
   // logout
   public function logout(Request $request, Auth $auth)
   {
    $auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('auth.login');
   }

    // public function destroyUser(User $user)
    // {

    //     // Setelah email terkirim, baru hapus pengguna
    //     // dd($user);
    //     $user->delete();

    //     // Setel SweetAlert dan redirect
    //     return redirect()->back()->with('alert', [
    //         'icon' => 'success',
    //         'title' => 'Sukses',
    //         'text' => 'User berhasil di Hapus!',
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     // $request->validate([
    //     //     'email' => 'required|unique:users,email',
    //     // ]);

    //     $user = User::find($id);
    //     if ($request->email !== $user->email) {
    //         $request->validate([
    //             'email' => 'required|unique:users,email',
    //         ]);
    //     }
    //     if ($request->password == null) {
    //         $user->name = $request->input('name');
    //         $user->email = $request->input('email');
    //         $user->alamat = $request->input('alamat');
    //         $user->telepon = $request->input('telepon');
    //         $user->save();
    //     } else {
    //         $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->alamat = $request->input('alamat');
    //     $user->telepon = $request->input('telepon');
    //     $user->password = $request->input('password');
    //     // update fields as necessary
    //     $user->save();
    //     }
    
    //         // Redirect dengan pesan sukses
    //         // Alert::success('Sukses', 'User berhasil diperbarui!')->autoClose(3000);
    //         return redirect()->back()->with('alert', [
    //             'icon' => 'success',
    //             'title' => 'Sukses',
    //             'text' => 'User berhasil diperbarui!',
    //         ]);
         
    // }
}
