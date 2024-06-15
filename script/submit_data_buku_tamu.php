<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    include('../database/connect_data_buku_tamu.php');

    // Ambil data dari form
    $noktp = $_POST['no_ktp'];
    $tempat = $_POST['tempat'];
    $layanan = $_POST['layanan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['message'];

    $judul = 'Diskominfo'; // Ganti dengan judul email
    $pesangmail = 'Terima kasih atas kunjungan Anda, Bapak/Ibu ' . $nama . ' ke ' . $tempat . ' melalui layanan kami yang ' . $layanan . ', Kami senang dapat membantu dengan keperluan Anda mengenai ' . $pesan; // Ganti dengan isi pesan email

    // Query untuk memasukkan data ke dalam tabel
    $sql = "INSERT INTO buku_tamu (nomor_ktp, tempat, layanan, nama, email, pesan)
            VALUES ('$noktp', '$tempat', '$layanan', '$nama', '$email', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        // Data berhasil disimpan, kirim email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ragiltr547@gmail.com'; // Ganti dengan alamat email Anda
            $mail->Password = 'pypflnbmrjsazxwb'; // Ganti dengan kata sandi email Anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('ragiltr547@gmail.com', 'ragilsyahnam');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = $judul;
            $mail->Body = $pesangmail;

            if ($mail->send()) {
                echo "<!DOCTYPE html>
                      <html lang='en'>
                      <body>
                          <h2>Email berhasil dikirim!</h2>
                        <script>
                          setTimeout(function() {
                            window.location.href = '../index.php';
                          }, 3000);
                        </script>
                      </body>
                      </html>";
            } else {
                echo "Pengiriman email gagal. Error: {$mail->ErrorInfo}";
            }
        } catch (Exception $e) {
            echo "Pengiriman email gagal. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Penyimpanan data gagal: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>