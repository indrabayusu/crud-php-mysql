<?php

$server   = "localhost";
$user     = "root";
$password = "";
$dbname   = "crud_modal";

$koneksi = mysqli_connect($server, $user, $password, $dbname);

if (!$koneksi) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>