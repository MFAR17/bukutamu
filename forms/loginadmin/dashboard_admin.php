<?php
session_start();

// Periksa apakah admin belum login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect ke halaman login jika belum login
    header("Location: form_login_admin.php");
    exit; // Penting untuk menghentikan eksekusi skrip setelah melakukan redirect
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Buku Tamu Kabupaten Gresik</title>
    <link rel="icon" href="../../assets/img/logo2.png">
    <link href="../../assets/css/admin.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <h2>Admin Dashboard</h2>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="content">
        <!-- Konten Dashboard Admin -->
        <h3>Welcome, Admin!</h3>
        <p>This is the admin dashboard. You can manage your site from here.</p>
        <form id="search-form" method="GET" action="../../script/generate_excel.php">
            <input type="text" id="search-input" name="search" placeholder="Cari nama...">
            <select name="bulan" id="bulan">
                <option value="">Semua data</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <button type="submit" class="btn btn-primary">Download data pengunjung</button>
        </form>

        <script>
    document.getElementById("bulan").addEventListener("change", function() {
        var selectedMonth = this.value;
        // Menyesuaikan action URL formulir dengan parameter bulan yang dipilih
        var actionURL = "../../script/generate_excel.php?bulan=" + selectedMonth;
        document.getElementById("search-form").action = actionURL;
    });
</script>

        <?php
        // Buat koneksi ke database
        include('../../database/connect_data_buku_tamu.php');

        // Lakukan query untuk mengambil semua data buku tamu
        $sql = "SELECT * FROM buku_tamu";
        $result = $conn->query($sql);

        // Tampilkan data dalam bentuk tabel
        if ($result->num_rows > 0) {
            // Mulai tabel
            echo "<table id='data-table' class='table table-bordered'>
                    <tr>
                        <th>No KTP</th>
                        <th>Tempat</th>
                        <th>Layanan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Keperluan</th>
                        <th>Waktu Berkunjung</th>
                    </tr>";

            // Loop untuk menampilkan setiap baris data
            while ($row = $result->fetch_assoc()) {
                // Tampilkan baris data buku tamu
                echo "<tr>
                        <td>" . htmlspecialchars($row["nomor_ktp"]) . "</td>
                        <td>" . htmlspecialchars($row["tempat"]) . "</td>
                        <td>" . htmlspecialchars($row["layanan"]) . "</td>
                        <td class='nama'>" . htmlspecialchars($row["nama"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                        <td>" . htmlspecialchars($row["pesan"]) . "</td>
                        <td>". htmlspecialchars($row["waktu_submit"]) ."</td>
                    </tr>";
            }

            // Selesai tabel
            echo "</table>";
        } else {
            echo "<p>Tidak ada data buku tamu.</p>";
        }
        // Tutup koneksi
        $conn->close();
        ?>
    </div>

    <script>
        // Fungsi untuk mencari nama
        document.getElementById("search-input").addEventListener("input", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search-input");
            filter = input.value.toLowerCase();
            table = document.getElementById("data-table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("nama")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    </script>
</body>

</html>
