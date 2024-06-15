<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server Anda jika berbeda
$username = "root"; // Ganti dengan nama pengguna MySQL And
$password = ""; // Ganti dengan kata sandi MySQL Anda
$dbname = "buku_tamu_kominfo"; // Nama database yang sudah Anda buat

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
