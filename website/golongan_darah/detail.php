<!DOCTYPE html>
<?php
    include_once("koneksi.php");

    $tanggal = $_GET['id'];
    
    $result = mysqli_query($conn, 'SELECT * FROM rekam_gol_darah, pendonor WHERE rekam_gol_darah.id_pendonor = pendonor.id_pendonor AND date = "'.mysqli_real_escape_string($conn,$tanggal).'" ');
    
    if (!$result) {
        trigger_error(mysqli_error($conn), E_USER_ERROR);
    }

    $value_darah = mysqli_fetch_array($result);

    $bulan=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

    $tanggal = date('d M Y H:i',strtotime($tanggal));
?>
<html lang="en">
<head>
    <title>Document</title>

    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="maps/leaflet.css" />
    <script src="maps/leaflet.js"></script>

    <style type="text/css">
    #mapid{
        margin: 0 auto 0 auto;
        height: 500px;
        width: 800px;
    }
    </style> -->
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Detail Informasi Golongan Darah</h2>
        
        <table class="table table-fixed">
            <thead>
                <tr class="table-dark">
                    <th scope="col" colspan="2" class="text-center"><?=$value_darah['nama']?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="col-1 text-end">Tanggal Cek</th>
                    <td><?=$tanggal?> WIB</td>
                </tr>
                <tr class="table-light">
                    <th class="col-1 text-end">Golongan Darah</th>
                    <td class="col-1"><?=$value_darah['golongan_darah']?><?=$value_darah['rhesus']?></td>
                </tr>
                <tr>
                    <th class="col-1 text-end">Jenis Kelamin</th>
                    <td><?=$value_darah['jenis_kelamin']?></td>
                </tr>
                <tr class="table-light">
                    <th class="col-1 text-end">Alamat</th>
                    <td><?=$value_darah['alamat']?></td>
                </tr>
                <tr>
                    <th class="col-1 text-end">Nomor Telepon</th>
                    <td><?=$value_darah['hp']?></td>
                </tr>
            </tbody>
        </table>
        <!-- <div id="mapid" class="mb-3"></div> -->
    </div>
</body>

<!-- <script type="text/javascript">
    var mapOptions = {
        center: [0.4441000,101.4547503],
        zoom: 15
    }

    var map = new L.map('mapid', mapOptions);
    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);

    var marker = L.marker([0.4441000,101.4547503]).addTo(map);
    marker.bindPopup('<b>Lapangan "Pancasila" Simpang Lima</b><br>Jl. Simpang Lima, Pleburan, Semarang Sel., Kota Semarang, Jawa Tengah 50241.');

</script> -->
</html>