<?php
include_once("koneksi.php");
$result = mysqli_query($conn, "SELECT * FROM rekam_gol_darah, pendonor WHERE rekam_gol_darah.id_pendonor = pendonor.id_pendonor ORDER BY date DESC");
?>
 
<html>
<head>    
    <title>Sistem Deteksi Golongan Darah</title>
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table{
            transition: 1s  ;
        }
    </style>
</head>
 
<body>
    <div class="container">
        <h2 class="text-center mt-4 mb-4">Data Golongan Darah</h2>
        <?php if($result->num_rows){?>
            <a href="tambah_data.php">
                <button type="button" class="btn btn-success">+ Tambah Data</button>
            </a>
            <br>
            <br>
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Cek</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Golongan Darah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php  
                    $no = 1;
                    while($valuue = mysqli_fetch_array($result)) {  
                        $tanggal = date('d M Y H:i',strtotime($valuue['date']));

                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$tanggal." WIB</td>";
                        echo "<td>".$valuue['nama']."</td>";
                        echo "<td>".$valuue['golongan_darah'].$valuue['rhesus']."</td>";
                        echo "<td><a href='detail.php?id=$valuue[date]'><button type='button' class='btn btn-link'>Detail</button></a>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        <?php }else{?>

            <a href="tambah_data.php">
                <button type="button" class="btn btn-success">+ Tambah Data</button>
            </a>
            <table class="table">
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <th class="text-center">Tidak data golongan darah</th>
                </tr>
            </tbody>
        </table>
        
        <?php }?>
    </div>
</body>
</html>