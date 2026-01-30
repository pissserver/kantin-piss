<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "db_kantin";

    $conn = mysqli_connect($server, $username, $password, $database) or die(mysqli_error());

    if (!function_exists('format_rupiah')) {
        function format_rupiah($angka){
            return 'Rp ' . number_format($angka, 0, ',', ',');
        }
    }
?>