<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Sistem Informasi Desa</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body { font-family: 'Poppins', sans-serif; }
</style>
</head>
<body class="min-h-screen flex justify-center items-center bg-[#0ca26e] p-4 relative overflow-hidden">

<!-- Decorative Background Circles -->
<div class="absolute -top-[150px] -left-[150px] w-[500px] h-[500px] bg-white/10 rounded-full"></div>
<div class="absolute -bottom-[150px] -right-[150px] w-[450px] h-[450px] bg-white/10 rounded-full"></div>

<div class="w-full max-w-[800px] flex flex-col md:flex-row bg-white rounded-[24px] overflow-hidden shadow-2xl relative z-10">
    
    <!-- Left Side -->
    <div class="md:w-[45%] bg-[#4fa57e] p-10 flex flex-col justify-center items-center text-center text-white relative">
        <div class="absolute inset-0 bg-gradient-to-b from-[#38b27e] to-[#209460] opacity-90"></div>
        <div class="relative z-10 flex flex-col items-center">
            <i class="fa-solid fa-location-dot text-[60px] text-[#ff2a2a] mb-6 drop-shadow-md"></i>
            <h1 class="text-2xl font-bold mb-4">Sistem Informasi Desa</h1>
            <p class="text-sm opacity-90 leading-relaxed px-2">
                Portal Administrasi dan Pelayanan Masyarakat Desa. Kelola data penduduk, surat menyurat, dan informasi desa secara cepat dan terintegrasi.
            </p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="md:w-[55%] p-8 md:p-10 flex flex-col justify-center">
        <div class="text-center mb-6">
            <h2 class="text-[#166534] text-2xl font-bold">Selamat Datang</h2>
            <p class="text-gray-500 text-sm mt-1">Silakan Login Terlebih Dahulu</p>
        </div>

        @if(session('alert'))
            <div class="bg-yellow-50 text-yellow-700 border border-yellow-200 p-3 rounded-lg mb-4 text-sm font-medium text-center">
                {{ session('alert') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm font-medium text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('auth.authentication') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
            </div>

            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-medium mb-1.5">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
            </div>

            <button type="submit" class="w-full bg-[#008f4c] hover:bg-[#00783f] text-white font-bold py-3 rounded-xl transition duration-300 text-sm shadow-[0_4px_10px_rgba(0,143,76,0.3)] mb-4">
                LOGIN
            </button>

            <div class="flex items-center text-gray-400 text-sm mb-4">
                <hr class="flex-1 border-gray-200">
                <span class="px-3">atau</span>
                <hr class="flex-1 border-gray-200">
            </div>

            <a href="{{ route('auth.redirect') }}" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium py-2.5 rounded-xl transition duration-200 text-sm">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5">
                Login dengan Google
            </a>

        </form>

        <div class="text-center mt-5 text-sm">
            <a href="{{ route('password.request') }}" class="text-[#16a34a] hover:underline mb-2 inline-block">Lupa Password?</a>
            <div class="text-gray-500">
                Belum punya akun? 
                <a href="{{ route('auth.register') }}" class="text-[#16a34a] font-bold hover:underline">Daftar Sekarang</a>
            </div>
            <div class="text-gray-400 text-xs mt-6">
                © 2026 Pemerintah Desa
            </div>
        </div>
    </div>
</div>

</body>
</html>
