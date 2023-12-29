<?php
    include_once("koneksi.php");
    
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $alamat = $_POST["alamat"];
    $hp = $_POST["hp"];
    $gol = $_POST["gol"];
    $rhesus = $_POST["rhesus"];
    
    $result = mysqli_query($conn,"SELECT id_pendonor from pendonor ORDER BY id_pendonor DESC LIMIT 1");
    
    if($result->num_rows){
        $tes = mysqli_fetch_array($result);
        $last_id = $tes['id_pendonor'];
    }else{
        $last_id = 0;
    }

    $id = $last_id + 1;

    $result = mysqli_query ($conn,"INSERT INTO pendonor VALUES ($id, '".$nama."','".$jenis_kelamin."', '".$alamat."','".$hp."')");
    if (!$result) {
        die ('Invalid query: '.mysqli_error($conn));
    }

    header("Location: index.php");
    die();
?>