<?php
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "db_fawncoffee"; 

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Validasi koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
} 
?>
