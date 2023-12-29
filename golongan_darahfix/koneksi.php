<?php
    //Variabel database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "golongan_darah";

    $conn = mysqli_connect("$servername", "$username", "$password","$dbname");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }