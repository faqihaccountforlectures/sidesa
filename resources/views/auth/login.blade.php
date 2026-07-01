<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Sistem Informasi Desa</title>

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
    overflow:hidden;
}

body::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(255,255,255,0.1);
    border-radius:50%;
    top:-150px;
    left:-150px;
}

body::after{
    content:'';
    position:absolute;
    width:450px;
    height:450px;
    background:rgba(255,255,255,0.1);
    border-radius:50%;
    bottom:-150px;
    right:-150px;
}

.login-container{
    position:relative;
    z-index:1;
    width:900px;
    max-width:95%;
    display:flex;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,0.2);
}

.left-side{
    flex:1;
    background:rgba(255,255,255,0.08);
    color:white;
    padding:50px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
}

.left-side img{
    width:120px;
    margin-bottom:20px;
}

.left-side h1{
    font-size:30px;
    margin-bottom:10px;
}

.left-side p{
    opacity:0.9;
    line-height:1.7;
}

.right-side{
    flex:1;
    background:white;
    padding:50px;
}

.form-title{
    text-align:center;
    margin-bottom:35px;
}

.form-title h2{
    color:#166534;
    margin-bottom:5px;
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    color:#444;
    font-weight:500;
}

.form-group input{
    width:100%;
    padding:14px 18px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:15px;
    transition:0.3s;
}

.form-group input:focus{
    outline:none;
    border-color:#16a34a;
    box-shadow:0 0 10px rgba(22,163,74,.2);
}

.login-btn{
    width:100%;
    padding:15px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#16a34a,#0f766e);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.login-btn:hover{
    transform:translateY(-2px);
}

.register-link{
    text-align:center;
    margin-top:20px;
    color:#666;
    font-size:14px;
}

.register-link a{
    color:#16a34a;
    font-weight:600;
    text-decoration:none;
    margin-left:4px;
    transition:.3s;
}

.register-link a:hover{
    color:#0f766e;
    text-decoration:underline;
}

.extra-links{
    margin-top:15px;
    text-align:center;
}

.extra-links a{
    text-decoration:none;
    color:#16a34a;
    font-size:14px;
}

.footer-text{
    margin-top:30px;
    text-align:center;
    color:#888;
    font-size:13px;
}
.alert-error{
      background:#fee2e2;
      color:#dc2626;
      padding:12px;
      border-radius:10px;
      margin-bottom:20px;
      text-align:center;
      font-weight:bold;
      border:1px solid #fca5a5;
    }
    .divider{
    display:flex;
    align-items:center;
    margin:20px 0;
    color:#999;
    font-size:14px;
}

.divider::before,
.divider::after{
    content:"";
    flex:1;
    height:1px;
    background:#ddd;
}

.divider span{
    margin:0 15px;
}

.google-btn{
    width:100%;
    padding:13px;
    border:1px solid #ddd;
    border-radius:12px;
    background:#fff;
    color:#444;
    font-size:15px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:12px;
    cursor:pointer;
    text-decoration:none;
    transition:.3s;
}

.google-btn:hover{
    background:#f8f9fa;
    border-color:#ccc;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.google-btn img{
    width:22px;
    height:22px;
}

@media(max-width:768px){

    .login-container{
        flex-direction:column;
    }

    .left-side{
        padding:30px;
    }

    .right-side{
        padding:30px;
    }

}
</style>

</head>
<body>

<div class="login-container">

    <div class="left-side">

        <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Logo Desa">

        <h1>Sistem Informasi Desa</h1>

        <p>
            Portal Administrasi dan Pelayanan Masyarakat Desa.
            Kelola data penduduk, surat menyurat, dan informasi desa
            secara cepat dan terintegrasi.
        </p>

    </div>

    <div class="right-side">

        <div class="form-title">
            <h2>Selamat Datang</h2>
            <p>Silakan Login Terlebih Dahulu</p>
        </div>

        @if(session('alert'))
            <div class="alert-error" style="background:#fefce8; color:#a16207; border-color:#fef08a;">
                {{ session('alert') }}
            </div>
        @endif

       @if ($errors->any())
    <div class="alert-error">
        {{ $errors->first() }}
    </div>
@endif
    <form action="{{ route('auth.authentication') }}" method="POST">
    {{ csrf_field() }}

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password">
            </div>

            <button type="submit" class="login-btn">
                LOGIN
            </button>

            <div class="divider">
                <span>atau</span>
            </div>

            <a href="{{ route('auth.redirect') }}" class="google-btn">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google">
                Login dengan Google
            </a>

        </form>

        <div class="extra-links">
            <a href="{{ route('password.request') }}">
    Lupa Password?
</a>
        </div>
        <div class="register-link">
        Belum punya akun?
        <a href="{{ route('auth.register') }}">Daftar Sekarang</a>
    </div>

        <div class="footer-text">
            © 2026 Pemerintah Desa
        </div>

    </div>

</div>

</body>
</html>
