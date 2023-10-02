<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "crud_basic";
    
    $koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$koneksi) {
        die ("Koneksi dengan MySQL gagal: ".mysqli_connect_errno()." - ".mysqli_connect_error());
    }
?>
