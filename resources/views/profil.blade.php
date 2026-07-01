@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.user')

@section('title', 'Profil Saya')

@section('content')
<style>
/* Container */
.profile-container{
    max-width:900px;
    margin:35px auto;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.12);
}

/* Header */
.profile-header{
    background:linear-gradient(135deg,#1f6df2,#66a7ff);
    color:#fff;
    text-align:center;
    padding:35px 20px;
}

/* Avatar */
.avatar{
    width:90px;
    height:90px;
    margin:auto;
    border-radius:50%;
    background:#fff;
    color:#1f6df2;
    font-size:38px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:15px;
}

.profile-header h2{
    font-size:32px;
    margin-bottom:5px;
}

.profile-header p{
    font-size:16px;
}

/* Body */
.profile-body{
    padding:25px;
}

.profile-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
}

.form-group label{
    display:block;
    font-size:16px;
    font-weight:600;
    margin-bottom:8px;
}

/* Box */
.info-box{
    display:flex;
    align-items:center;
    gap:12px;
    padding:14px 16px;
    border:1px solid #ddd;
    border-radius:12px;
    background:#fafafa;
}

.info-box i{
    font-size:18px;
    color:#1f6df2;
}

.info-box span{
    font-size:17px;
}

/* Footer */
.profile-footer{
    border-top:1px solid #ddd;
    margin-top:25px;
    padding-top:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* Tombol */
.btn{
    text-decoration:none;
    padding:10px 18px;
    border-radius:10px;
    font-size:16px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.3s;
}

.action-buttons{
    display:flex;
    gap:10px;
}

.btn-back{
    border:1px solid #bbb;
    color:#555;
    background:#fff;
}

.btn-edit{
    background:#1f6df2;
    color:#fff;
}

.btn-logout{
    display:flex;
    align-items:center;
    gap:8px;
    padding:10px 18px;
    border:none;
    border-radius:10px;
    background:#e53935;
    color:#fff;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}

.btn-logout:hover{
    background:#c62828;
}

.btn-logout i{
    font-size:15px;
}

</style>
<!-- Bootstrap CSS -->
<div class="profile-container">

    <div class="profile-header">
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        <h2>{{ Auth::user()->name }}</h2>
        <p>Pengguna Website Desa</p>
    </div>

    <div class="profile-body">

        <div class="profile-grid">

            <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="info-box">
                    <i class="fa-solid fa-user"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <div class="info-box">
                    <i class="fa-solid fa-envelope"></i>
                    <span>{{ Auth::user()->email }}</span>
                </div>
            </div>

            <div class="form-group">
                <label>Bergabung Sejak</label>
                <div class="info-box">
                    <i class="fa-solid fa-calendar"></i>
                    <span>{{ Auth::user()->created_at?->translatedFormat('d F Y') ?? '-' }}</span>
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="info-box">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ ucfirst(Auth::user()->role) }}</span>
                </div>
            </div>

        </div>

        <div class="profile-footer">
            <a href="javascript:history.back()" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

            <div class="action-buttons">
                <a href="{{ route('profile') }}" class="btn btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Profil
                </a>

                 <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection
