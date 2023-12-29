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
    <title>Sistem Deteksi Golongan Darah</title>

    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
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
        <div style="margin-top: 50px">
            <?php
                if($value_darah['golongan_darah'] == "AB"){
                    $image_a = "gol_a_true.jpg"; 
                    $image_b = "gol_b_true.jpg";  
                }else if($value_darah['golongan_darah'] == "A"){
                    $image_a = "gol_a_true.jpg"; 
                    $image_b = "gol_b_false.jpg";  
                }else if($value_darah['golongan_darah'] == "B"){
                    $image_a = "gol_a_false.jpg"; 
                    $image_b = "gol_b_true.jpg";  
                }else{
                    $image_a = "gol_a_false.jpg"; 
                    $image_b = "gol_b_false.jpg";  
                }
                
                if($value_darah['rhesus'] == "+"){
                    $image_rhesus = "rhesus_true.jpg"; 
                }else{
                    $image_rhesus = "rhesus_false.jpg"; 
                }
            ?>
            <center>
                <h5>Keterangan :</h5>
                <p>Reaksi <strong>golongan darah <?=$value_darah['golongan_darah']?><?=$value_darah['rhesus']?> </strong>dengan reagen dapat dilihat di bawah ini</p>
                
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column">
                        <h5>A</h5>
                        <img src="asset/images/<?=$image_a?>">
                    </div>
                    <div class="d-flex flex-column">
                        <h5>B</h5>
                        <img src="asset/images/<?=$image_b?>">
                    </div>
                    <div class="d-flex flex-column">
                        <h5>Rhesus</h5>
                        <img src="asset/images/<?=$image_rhesus?>">
                    </div>
                </div>
            </center>
        </div>
    </div>
</body>

</html>