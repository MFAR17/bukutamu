<?php
session_start();
require_once '../../database/connect_data_buku_tamu.php';

// Ambil data yang dikirimkan dari formulir login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa apakah username dan password sesuai di database
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        // Jika sesuai, set session untuk menandai bahwa admin sudah login
        $_SESSION['admin_logged_in'] = true;
        // Redirect ke halaman admin setelah login sukses
        header("Location: dashboard_admin.php");
        exit; // Pastikan untuk keluar setelah pengalihan halaman
    } else {
        echo '<script>';
        echo 'alert("Username atau Password salah.");';
        echo 'window.location.href = "form_login_admin.php";'; // Redirect kembali ke halaman login
        echo '</script>';
    }
} else {
    // Jika terjadi kesalahan saat menjalankan query
    echo "Error: " . $conn->error;
    exit;
}
?>
