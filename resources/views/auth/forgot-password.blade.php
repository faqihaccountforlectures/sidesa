<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Lupa Password - SIDESA</title>

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
    background:#f5f7fa;
}

.container{
    width:420px;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.icon{
    width:80px;
    height:80px;
    margin:auto;
    border-radius:50%;
    background:#dcfce7;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:35px;
    color:#16a34a;
}

h2{
    text-align:center;
    margin-top:20px;
    color:#166534;
}

.desc{
    text-align:center;
    color:#666;
    margin:10px 0 25px;
    font-size:14px;
    line-height:1.7;
}

.form-group{
    margin-bottom:20px;
}

input{
    width:100%;
    padding:14px;
    border:1px solid #ddd;
    border-radius:12px;
    font-size:14px;
    transition:.3s;
}

input:focus{
    outline:none;
    border-color:#16a34a;
    box-shadow:0 0 10px rgba(22,163,74,.2);
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:linear-gradient(
        135deg,
        #16a34a,
        #166534
    );
    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    transform:translateY(-2px);
}

.success{
    margin-top:15px;
    padding:12px;
    background:#dcfce7;
    color:#166534;
    border-radius:10px;
    text-align:center;
    font-size:14px;
}

.back{
    margin-top:20px;
    text-align:center;
}

.back a{
    text-decoration:none;
    color:#16a34a;
    font-weight:600;
}

</style>
</head>
<body>

<div class="container">

    <div class="icon">
        🔒
    </div>

    <h2>Lupa Password?</h2>

    <p class="desc">
        Masukkan alamat email yang terdaftar.
        Kami akan mengirimkan link untuk mengatur ulang password Anda.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <input
                type="email"
                name="email"
                placeholder="Masukkan Email"
                required
            >
        </div>

        <button type="submit">
            Kirim Link Reset
        </button>

        @if(session('status'))
            <div class="success">
                {{ session('status') }}
            </div>
        @endif

    </form>

    <div class="back">
        <a href="{{ route('auth.login') }}">
            ← Kembali ke Login
        </a>
    </div>

</div>

</body>
</html>