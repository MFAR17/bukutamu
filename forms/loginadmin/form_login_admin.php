<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Buku Tamu Kabupaten Gresik Login</title>
    <link rel="icon" href="../../assets/img/logo2.png">
    <link href="../../assets/css/admin.css" rel="stylesheet">
</head>
<style>
    a{
    padding: 10px 20px;
    color: #fff;
    background: #343a40;
    font-size: 12px;
    background-color: red;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s, color 0.3s;
    }
</style>
<body>
    <h2>Admin Login</h2>
    <form action="process_login_admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
        <a href="../../index.php" >Kembali ke Halaman Utama</a>
    </form>
    <!-- Tombol Kembali ke index.php -->
    
</body>

</html>
