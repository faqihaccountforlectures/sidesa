<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reset Password - SIDESA</title>

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
    width:450px;
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

h2{
    text-align:center;
    margin-bottom:25px;
    color:#166534;
}

.form-group{
    margin-bottom:18px;
}

input{
    width:100%;
    padding:14px;
    border:1px solid #ddd;
    border-radius:12px;
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
    font-weight:600;
    cursor:pointer;
}

button:hover{
    opacity:.9;
}

</style>
</head>
<body>

<div class="container">

    <h2>Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >

        <div class="form-group">
            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >
        </div>

        <div class="form-group">
            <input
                type="password"
                name="password"
                placeholder="Password Baru"
                required
            >
        </div>

        <div class="form-group">
            <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi Password"
                required
            >
        </div>

        <button type="submit">
            Simpan Password Baru
        </button>

    </form>

</div>

</body>
</html>