@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.user')

@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')

@if(session('alert'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-lg mb-6 shadow-sm flex items-start gap-3">
        <i class="fa-solid fa-circle-check mt-1"></i>
        <div>
            <strong class="font-bold">Berhasil!</strong>
            <p class="m-0">{{ session('alert') }}</p>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-sm flex items-start gap-3">
        <i class="fa-solid fa-circle-exclamation mt-1"></i>
        <div>
            <strong class="font-bold">Gagal!</strong>
            <p class="m-0">{{ session('error') }}</p>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Kolom Foto Profil -->
    <div class="lg:col-span-1">
        <div class="content-card text-center sticky top-28">
            <h3 class="text-lg font-bold text-slate-800 mb-6 m-0 border-b pb-4">Foto Profil</h3>
            
            <form action="{{ route('profil.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="relative w-40 h-40 mx-auto mb-6 group">
                    <img id="avatar_preview" src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://i.pravatar.cc/150' }}" 
                         alt="Foto Profil" 
                         class="w-40 h-40 rounded-full object-cover shadow-lg border-4 border-white">
                         
                    <label for="avatar_upload" class="absolute inset-0 bg-slate-900/60 text-white flex flex-col items-center justify-center rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-all duration-300">
                        <i class="fa-solid fa-camera text-2xl mb-1"></i>
                        <span class="text-xs font-semibold">Ubah Foto</span>
                    </label>
                    <input type="file" name="avatar" id="avatar_upload" class="hidden" accept="image/*" onchange="previewAvatar(event)">
                </div>
                
                <p class="text-xs text-slate-500 mb-4">Maksimal 2MB, format JPG/PNG</p>
                <button type="submit" id="btn_simpan_avatar" class="hidden bg-sidesa-600 text-white text-sm font-semibold px-5 py-2 rounded-full hover:bg-sidesa-700 transition-colors mx-auto shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Upload Foto
                </button>
            </form>
        </div>
    </div>

    <!-- Kolom Data Diri -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Form Data Profil -->
        <div class="content-card">
            <h3 class="text-lg font-bold text-slate-800 mb-6 m-0 border-b pb-4">Informasi Akun</h3>
            
            <form action="{{ route('profil.update') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Induk Kependudukan (NIK)</label>
                    <div class="relative">
                        <i class="fa-solid fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-500 rounded-xl block !pl-11 !p-3 cursor-not-allowed" value="{{ $user->nik }}" readonly disabled>
                    </div>
                    <p class="text-xs text-slate-500 mt-2"><i class="fa-solid fa-circle-info mr-1 text-blue-500"></i> NIK tidak dapat diubah setelah terdaftar.</p>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="name" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}" required>
                    </div>
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <div class="relative">
                        <i class="fa-solid fa-at absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="username" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('username') border-red-500 @enderror" value="{{ old('username', $user->username) }}">
                    </div>
                    @error('username')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="email" name="email" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}" required>
                    </div>
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon</label>
                    <div class="relative">
                        <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" name="telp" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('telp') border-red-500 @enderror" value="{{ old('telp', $user->telp) }}">
                    </div>
                    @error('telp')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                    <div class="relative">
                        <i class="fa-solid fa-map-location-dot absolute left-4 top-4 text-slate-400"></i>
                        <textarea name="alamat" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('alamat') border-red-500 @enderror" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
                    @error('alamat')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-sidesa-600 text-white font-semibold hover:bg-sidesa-700 shadow-sm transition-colors">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Ubah Password -->
        <div class="content-card">
            <h3 class="text-lg font-bold text-slate-800 mb-6 m-0 border-b pb-4">Keamanan Sandi</h3>
            
            <form action="{{ route('profil.updatePassword') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password Saat Ini</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="password" name="current_password" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('current_password') border-red-500 @enderror" placeholder="Masukkan password lama" required>
                    </div>
                    @error('current_password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
                    <div class="relative">
                        <i class="fa-solid fa-key absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="password" name="password" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors @error('password') border-red-500 @enderror" placeholder="Minimal 8 karakter" required>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <i class="fa-solid fa-check-double absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="password" name="password_confirmation" class="w-full border border-slate-300 text-slate-800 rounded-xl focus:ring-sidesa-500 focus:border-sidesa-500 block !pl-11 !p-3 transition-colors" placeholder="Ketik ulang password baru" required>
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-slate-800 text-white font-semibold hover:bg-slate-900 shadow-sm transition-colors">
                        <i class="fa-solid fa-shield-halved"></i> Perbarui Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function previewAvatar(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar_preview').src = e.target.result;
                document.getElementById('btn_simpan_avatar').classList.remove('hidden');
                document.getElementById('btn_simpan_avatar').classList.add('inline-flex');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection
