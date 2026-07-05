<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Akun Desa</title>
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
            <h1 class="text-2xl font-bold mb-4">Portal Desa Digital</h1>
            <p class="text-sm opacity-90 leading-relaxed px-2">
                Daftarkan akun Anda untuk mengakses berbagai layanan administrasi secara online.
            </p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="md:w-[55%] p-8 md:px-8 md:py-6 flex flex-col justify-center">
        <div class="text-center mb-4">
            <h2 class="text-[#166534] text-xl font-bold">Buat Akun Baru</h2>
            <p class="text-gray-500 text-sm mt-1">Lengkapi data di bawah ini</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm font-medium">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">No. HP</label>
                    <input type="tel" name="telp" value="{{ old('telp') }}" placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Buat username" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" placeholder="Buat password" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password" class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:outline-none focus:border-[#16a34a] focus:ring-2 focus:ring-[#16a34a]/20 transition-all text-sm">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#008f4c] hover:bg-[#00783f] text-white font-bold py-2.5 rounded-lg transition duration-300 mt-1 text-sm shadow-[0_4px_10px_rgba(0,143,76,0.3)] mb-3">
                DAFTAR SEKARANG
            </button>

            <div class="flex items-center text-gray-400 text-sm mb-3">
                <hr class="flex-1 border-gray-200">
                <span class="px-3">atau</span>
                <hr class="flex-1 border-gray-200">
            </div>

            <a href="{{ route('auth.redirect') }}" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 font-medium py-2 rounded-lg transition duration-200 text-sm">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5">
                Daftar dengan Google
            </a>
        </form>

        <div class="text-center mt-5 text-gray-500 text-sm">
            Sudah punya akun? 
            <a href="{{ route('auth.login') }}" class="text-[#16a34a] font-bold hover:underline">Login di sini</a>
        </div>
    </div>
</div>

</body>
</html>
