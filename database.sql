-- Database: katalog_buku
CREATE DATABASE IF NOT EXISTS katalog_buku CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE katalog_buku;

DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  isbn VARCHAR(13) NOT NULL UNIQUE,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(120) NOT NULL,
  publisher VARCHAR(120) NOT NULL,
  year SMALLINT NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Akun login: admin / admin123 (password disimpan sebagai teks biasa)
INSERT INTO users (username, password) VALUES ('admin', 'admin123');

INSERT INTO books (isbn, title, author, publisher, year, stock) VALUES
('9786020332956','Bumi Manusia','Pramoedya Ananta Toer','Lentera Dipantara',2005,10),
('9789792248616','Laskar Pelangi','Andrea Hirata','Bentang Pustaka',2008,7),
('9780132350884','Clean Code','Robert C. Martin','Prentice Hall',2008,3);
