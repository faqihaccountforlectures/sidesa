<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>IDM Desa</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f4f6fa;
}

.container{
width:95%;
max-width:1400px;
margin:30px auto;
}

/* HEADER */

.header{
background:white;
padding:25px;
border-radius:18px;
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.header h2{
color:#166534;
}

.header p{
color:#666;
}

/* TOP */

.top-grid{

display:grid;
grid-template-columns:350px 1fr;
gap:25px;
margin-bottom:25px;

}

/* SCORE */

.score-box{

display:grid;
grid-template-columns:1fr 1fr;
gap:15px;

}

.score{

padding:20px;
border-radius:15px;
color:white;

}

.score h1{

font-size:28px;

}

.score small{

opacity:.9;

}

.blue{
background:#0891b2;
}

.red{
background:#ef4444;
}

.yellow{
background:#f59e0b;
}

.green{
background:#16a34a;
}

/* CHART */

.chart-card{

background:white;
border-radius:18px;
padding:25px;
box-shadow:0 10px 20px rgba(0,0,0,.05);

}

.chart-card h3{

margin-bottom:15px;

}

/* INFO */

.info-card{

margin-top:20px;
background:white;
padding:20px;
border-radius:18px;
box-shadow:0 10px 20px rgba(0,0,0,.05);

}

.info-grid{

display:grid;
grid-template-columns:repeat(2,1fr);
gap:15px;

}

.info-item{

padding:10px;
border-bottom:1px solid #eee;

}

.info-item strong{

display:block;
color:#166534;

}

/* TABLE */

.table-card{

background:white;
padding:25px;
border-radius:18px;
box-shadow:0 10px 20px rgba(0,0,0,.05);

overflow:auto;

}

table{

width:100%;
border-collapse:collapse;

}

table th{

background:#166534;
color:white;
padding:14px;
font-size:14px;

}

table td{

padding:12px;
border-bottom:1px solid #eee;
font-size:14px;

}

table tr:hover{

background:#f9fafb;

}

.badge{

padding:5px 12px;
border-radius:20px;
font-size:12px;
color:white;

}

.terpenuhi{

background:#16a34a;

}

.belum{

background:#ef4444;

}

.status{

display:inline-block;
padding:8px 18px;
border-radius:30px;
background:#16a34a;
color:white;
font-weight:600;

margin-top:10px;

}

@media(max-width:900px){

.top-grid{

grid-template-columns:1fr;

}

.info-grid{

grid-template-columns:1fr;

}

.score-box{

grid-template-columns:1fr;

}

}

</style>

</head>

<body>
@extends('layouts.utama')
@section('content')
<div class="container">

<div class="header">

<div>

<h2>
<i class="fa-solid fa-chart-column"></i>
Indeks Desa Membangun (IDM)
</h2>

<p>Tahun 2025</p>

</div>

<div class="status">
MANDIRI
</div>

</div>

<div class="top-grid">

<div>

<div class="score-box">

<div class="score blue">

<h1>0.8619</h1>

<small>IKS</small>

</div>

<div class="score yellow">

<h1>MANDIRI</h1>

<small>Status IDM</small>

</div>

<div class="score red">

<h1>0.8156</h1>

<small>IKL</small>

</div>

<div class="score green">

<h1>0.8421</h1>

<small>IKE</small>

</div>

</div>

<div class="info-card">

<div class="info-grid">

<div class="info-item">

<strong>Provinsi</strong>

Jawa Barat

</div>

<div class="info-item">

<strong>Kabupaten</strong>

Majalengka

</div>

<div class="info-item">

<strong>Kecamatan</strong>

Jatitujuh

</div>

<div class="info-item">

<strong>Desa</strong>

Medangasem

</div>

</div>

</div>

</div>

<div class="chart-card">

<h3>Grafik Nilai IDM</h3>

<canvas id="chart"></canvas>

</div>

</div>

<div class="table-card">

<h3 style="margin-bottom:20px;">

Daftar Indikator IDM

</h3>

<table>

<tr>

<th>No</th>

<th>Indikator</th>

<th>Skor</th>

<th>Keterangan</th>

<th>Status</th>

</tr>

<tr>

<td>1</td>

<td>Akses Air Bersih</td>

<td>5</td>

<td>Seluruh warga memiliki akses air bersih</td>

<td>

<span class="badge terpenuhi">

Terpenuhi

</span>

</td>

</tr>

<tr>

<td>2</td>

<td>Posyandu</td>

<td>5</td>

<td>Posyandu aktif setiap bulan</td>

<td>

<span class="badge terpenuhi">

Terpenuhi

</span>

</td>

</tr>

<tr>

<td>3</td>

<td>PAUD</td>

<td>4</td>

<td>Masih perlu penambahan tenaga pendidik</td>

<td>

<span class="badge belum">

Belum

</span>

</td>

</tr>

<tr>

<td>4</td>

<td>Jalan Desa</td>

<td>5</td>

<td>Semua jalan sudah diaspal</td>

<td>

<span class="badge terpenuhi">

Terpenuhi

</span>

</td>

</tr>

<tr>

<td>5</td>

<td>Internet Desa</td>

<td>3</td>

<td>Jaringan belum merata</td>

<td>

<span class="badge belum">

Belum

</span>

</td>

</tr>

<tr>

<td>6</td>

<td>BUMDes</td>

<td>5</td>

<td>Berjalan aktif</td>

<td>

<span class="badge terpenuhi">

Terpenuhi

</span>

</td>

</tr>

<tr>

<td>7</td>

<td>Keamanan Desa</td>

<td>5</td>

<td>Siskamling aktif</td>

<td>

<span class="badge terpenuhi">

Terpenuhi

</span>

</td>

</tr>

<tr>

<td>8</td>

<td>Pelayanan Publik</td>

<td>4</td>

<td>Pelayanan online tersedia</td>

<td>

<span class="badge terpenuhi">

Terpenuhi

</span>

</td>

</tr>

</table>

</div>

</div>

<script>

new Chart(document.getElementById('chart'),{

type:'pie',

data:{

labels:['IKS','IKL','IKE'],

datasets:[{

data:[86.19,81.56,84.21]

}]

},

options:{

plugins:{

legend:{

position:'bottom'

}

}

}

});

</script>
    @endsection

</body>
</html>