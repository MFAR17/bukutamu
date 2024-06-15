CREATE TABLE buku_tamu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_ktp VARCHAR(255) NOT NULL,
    tempat VARCHAR(255) NOT NULL,
    layanan VARCHAR(255) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL,
    waktu_submit TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
