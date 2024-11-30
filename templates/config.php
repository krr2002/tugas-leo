<?php
$host = "localhost"; // Nama host, biasanya localhost
$username = "root";  // Nama pengguna untuk MySQL
$password = "";      // Password untuk MySQL (kosong untuk XAMPP default)
$dbname = "titik_temu"; // Nama database

// Koneksi ke MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
