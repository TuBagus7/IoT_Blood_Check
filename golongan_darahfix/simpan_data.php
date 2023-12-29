<?php
    include_once("koneksi.php");

    $result = mysqli_query($conn,"SELECT id_pendonor from pendonor ORDER BY id_pendonor DESC LIMIT 1");
    $tes = mysqli_fetch_array($result);
    $last_id = $tes['id_pendonor'];

    $id = $last_id + 1;

    $gol = $_GET["gol"];
    $rhesus = $_GET["rhesus"];

    if(isset($gol) && isset($rhesus)){
        $result = mysqli_query ($conn,"INSERT INTO rekam_gol_darah VALUES (now(), $id, '".$gol."', '".$rhesus."')");

        if (!$result) {
            die ('Invalid query: '.mysqli_error($conn));
        }
    }else{
        die ('Invalid data');
    }
?>