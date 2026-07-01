@extends('layouts.utama')

@section('title','Peta Desa')

<style>

.map-header{
    background:linear-gradient(135deg,#16a34a,#166534);
    color:white;
    padding:30px;
    border-radius:20px;
    margin-bottom:25px;
}

.map-header h2{
    margin-bottom:10px;
}

.map-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
}

.map-card,
.info-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,.05);
}

.map-card iframe{
    width:100%;
    height:600px;
    border:none;
}

.info-body{
    padding:25px;
}

.info-title{
    color:#166534;
    margin-bottom:20px;
}

.info-item{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:20px;
    padding-bottom:15px;
    border-bottom:1px solid #eee;
}

.info-item:last-child{
    border:none;
    margin-bottom:0;
}

.info-item i{
    width:50px;
    height:50px;
    background:#dcfce7;
    color:#166534;
    border-radius:12px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:20px;
}

.info-item h4{
    margin-bottom:3px;
    color:#111827;
}

.info-item p{
    color:#6b7280;
    font-size:14px;
}

.facility{
    margin-top:25px;
}

.facility h3{
    margin-bottom:15px;
    color:#166534;
}

.facility-list{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.facility-item{
    background:#f8fafc;
    padding:15px;
    border-radius:12px;
}

.facility-item i{
    color:#16a34a;
    margin-right:8px;
}

@media(max-width:991px){

    .map-grid{
        grid-template-columns:1fr;
    }

    .map-card iframe{
        height:450px;
    }

}

</style>

@section('content')

<div class="map-header">

    <h2>
        <i class="fa-solid fa-map-location-dot"></i>
        Peta Wilayah Desa Medangasem
    </h2>

    <p>
        Informasi lokasi, batas wilayah dan fasilitas umum Desa Medangasem.
    </p>

</div>

<div class="map-grid">

    <div class="map-card">
        @if(!empty($mapLink))
            <iframe src="{{ $mapLink }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @else
            <div style="height:100%; display:flex; justify-content:center; align-items:center; background:#f1f5f9; color:#64748b; font-size: 18px;">
                Peta belum dikonfigurasi.
            </div>
        @endif
    </div>

    <!-- INFORMASI -->
    <div class="info-card">

        <div class="info-body">

            <h3 class="info-title">
                Informasi Desa
            </h3>

            <div class="info-item">

                <i class="fa-solid fa-location-dot"></i>

                <div>
                    <h4>Lokasi Desa</h4>
                    <p>Kecamatan Medangasem</p>
                </div>

            </div>

            <div class="info-item">

                <i class="fa-solid fa-users"></i>

                <div>
                    <h4>Jumlah Penduduk</h4>
                    <p>1.250 Jiwa</p>
                </div>

            </div>

            <div class="info-item">

                <i class="fa-solid fa-map"></i>

                <div>
                    <h4>Luas Wilayah</h4>
                    <p>5,2 Km²</p>
                </div>

            </div>

            <div class="info-item">

                <i class="fa-solid fa-road"></i>

                <div>
                    <h4>Batas Wilayah</h4>
                    <p>Utara, Selatan, Timur, Barat</p>
                </div>

            </div>

            <div class="facility">

                <h3>Fasilitas Umum</h3>

                <div class="facility-list">

                    <div class="facility-item">
                        <i class="fa-solid fa-building"></i>
                        Kantor Desa
                    </div>

                    <div class="facility-item">
                        <i class="fa-solid fa-school"></i>
                        SD Negeri Medangasem
                    </div>

                    <div class="facility-item">
                        <i class="fa-solid fa-mosque"></i>
                        Masjid Jami'
                    </div>

                    <div class="facility-item">
                        <i class="fa-solid fa-heart-pulse"></i>
                        Posyandu Desa
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection