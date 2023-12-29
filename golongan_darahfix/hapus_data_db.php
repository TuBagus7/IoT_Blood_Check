<?php
    include_once("koneksi.php");

    $id = $_GET['id'];
    
    $result = mysqli_query($conn,"DELETE FROM rekam_gol_darah WHERE id_pendonor = $id");

    if (!$result) {
        die ('Invalid query: '.mysqli_error($conn));
    }

    header("Location: tambah_data.php");
    die();
?>