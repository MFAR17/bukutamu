-- Skema untuk tabel pengguna (users)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

-- Contoh data pengguna
INSERT INTO users (username, password) VALUES
('user1', 'password1'),
('user2', 'password2');
