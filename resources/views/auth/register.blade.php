<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Akun Desa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f766e,#16a34a);
    padding:30px;
}

.container{
    width:1000px;
    max-width:100%;
    display:flex;
    overflow:hidden;
    border-radius:25px;
    backdrop-filter:blur(15px);
    background:rgba(255,255,255,0.15);
    box-shadow:0 15px 40px rgba(0,0,0,.2);
}

.left{
    flex:1;
    color:white;
    padding:60px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    background:rgba(255,255,255,.08);
}

.left img{
    width:110px;
    margin-bottom:20px;
}

.left h1{
    font-size:34px;
    margin-bottom:15px;
}

.left p{
    line-height:1.8;
    opacity:.9;
}

.right{
    flex:1.2;
    background:white;
    padding:45px;
}

.header{
    text-align:center;
    margin-bottom:30px;
}

.header h2{
    color:#166534;
    font-size:28px;
}

.header p{
    color:#777;
    margin-top:5px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:#444;
    font-weight:500;
}

.form-group input{
    width:100%;
    padding:14px 16px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:14px;
    transition:.3s;
}

.form-group input:focus{
    outline:none;
    border-color:#16a34a;
    box-shadow:0 0 10px rgba(22,163,74,.15);
}

.row{
    display:flex;
    gap:15px;
}

.row .form-group{
    flex:1;
}

.btn-register{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#16a34a,#0f766e);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
    transition:.3s;
}

.btn-register:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(22,163,74,.25);
}

.login-link{
    text-align:center;
    margin-top:20px;
    color:#666;
}

.login-link a{
    color:#16a34a;
    text-decoration:none;
    font-weight:600;
}

.login-link a:hover{
    text-decoration:underline;
}

@media(max-width:900px){

    .container{
        flex-direction:column;
    }

    .left{
        text-align:center;
        padding:40px;
    }

    .right{
        padding:30px;
    }

    .row{
        flex-direction:column;
        gap:0;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="left">

        <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png">

        <h1>Portal Desa Digital</h1>

        <p>
            Daftarkan akun Anda untuk mengakses berbagai layanan
            administrasi desa secara online, cepat, mudah, dan aman.
        </p>

    </div>

    <div class="right">

        <div class="header">
            <h2>Buat Akun Baru</h2>
            <p>Lengkapi data di bawah ini</p>
        </div>
@if ($errors->any())
    <div style="
        background:#ef4444;
        color:white;
        padding:12px;
        border-radius:10px;
        margin-bottom:20px;
    ">
        <ul style="margin:0;padding-left:20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{ route('auth.store') }}" method="POST">
        @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
            </div>

            <div class="row">

                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" placeholder="16 digit NIK">
                </div>

                <div class="form-group">
                    <label>No. HP</label>
                    <input type="tel" name="telp" value="{{ old('telp') }}" placeholder="08xxxxxxxxxx">
                </div>

            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat lengkap">
            </div>

            <div class="row">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Buat username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Buat password">
                </div>

            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" id="confirmPassword"
               name="password_confirmation" placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn-register">
                DAFTAR SEKARANG
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('auth.login') }}">Login di sini</a>
        </div>

    </div>

</div>

</body>
</html>
