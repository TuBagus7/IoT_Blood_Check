<?php
include_once("koneksi.php");

$date = $_POST["date"];
$result = mysqli_query($conn,"SELECT date from rekam_gol_darah WHERE date > '$date' ORDER BY date DESC LIMIT 1");

if($result->num_rows){
    $tes = mysqli_fetch_array($result);

    // echo $tes['date'];

    $result = mysqli_query($conn,"SELECT id_pendonor,golongan_darah, rhesus from rekam_gol_darah WHERE date = '".$tes['date']."'");

    $data = mysqli_fetch_array($result);
    echo json_encode($data);
}else{
    echo json_encode(false);
}