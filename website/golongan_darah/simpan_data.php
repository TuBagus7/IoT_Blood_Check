<?php
    include_once("koneksi.php");

    $gol = $_GET["gol"];
    $rhesus = $_GET["rhesus"];

    if(isset($gol) && isset($rhesus)){
        echo $rhesus;
        $result = mysqli_query ($conn,"INSERT INTO rekam_gol_darah VALUES (now(), 1, '".$gol."', '".$rhesus."')");
        if (!$result) {
            die ('Invalid query: '.mysqli_error($conn));
        } 
    }else{
        die ('Invalid data');
    } 
?>