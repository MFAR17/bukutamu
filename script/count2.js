function startCountdown() {
    var countdown = 10; // Jumlah detik untuk mundur
    var countdownInterval = setInterval(function() {
        countdown--;
        if (countdown <= 0) {
            clearInterval(countdownInterval); // Hentikan penghitungan mundur jika sudah mencapai 0
            captureAndScan(); // Jalankan fungsi captureAndScan setelah jeda
        }
        document.getElementById('countdown-display').innerText = countdown; // Tampilkan waktu mundur
    }, 1000); // Interval 1 detik
}