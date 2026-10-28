# Katalog Buku (PHP + MySQL)

Aplikasi manajemen katalog buku dengan antarmuka dashboard modern, login berbasis session, dan dua bahasa (ID/EN).

## Screenshot

### Halaman Login
![Halaman Login](capture/Screenshot%202026-10-28%20094043.png)

### Dashboard Daftar Buku
![Dashboard Daftar Buku](capture/Screenshot%202026-10-28%20094052.png)

### Tambah Buku
![Form Tambah Buku](capture/Screenshot%202026-10-28%20094108.png)
![Tambah Buku Terisi](capture/Screenshot%202026-10-28%20094225.png)

### Ubah Buku
![Form Ubah Buku](capture/Screenshot%202026-10-28%20094321.png)

### Hapus Buku (Menu Aksi & Konfirmasi)
![Dropdown Menu Aksi](capture/Screenshot%202026-10-28%20094338.png)
![Konfirmasi Hapus](capture/Screenshot%202026-10-28%20094347.png)

### Notifikasi Flash (Berhasil)
![Berhasil Ditambahkan](capture/Screenshot%202026-10-28%20094234.png)
![Berhasil Dihapus](capture/Screenshot%202026-10-28%20094354.png)

### Penanganan Error & Validasi
![Login Gagal](capture/Screenshot%202026-10-28%20111037.png)
![Validasi Stok Min](capture/Screenshot%202026-10-28%20111058.png)
![Validasi Tahun Min](capture/Screenshot%202026-10-28%20111121.png)
![Validasi ISBN Server](capture/Screenshot%202026-10-28%20111139.png)

### Mode Bahasa Inggris (EN)
![Halaman EN](capture/Screenshot%202026-10-28%20094407.png)

## Fitur

- **Dashboard SaaS-style** — sidebar rail, topbar, status pill stok (hijau/amber/merah), menu aksi 3-titik, paginasi
- **CRUD Buku** — tambah, ubah, hapus, dan lihat daftar buku beserta pencarian judul/penulis
- **Login & Session** — proteksi halaman, `session_regenerate_id()` setelah login
- **Dual Bahasa** — Indonesia & Inggris (disimpan di `$_SESSION['lang']`)
- **Status Stok Otomatis** — badge warna berdasarkan jumlah stok (Tersedia / Stok Sedikit / Habis)
- **Validasi Berlapis** — validasi client-side (HTML5) dan server-side dengan pesan error yang jelas
- **UI Responsif** — layout mobile-friendly tanpa framework CSS eksternal (pure CSS)

## Persyaratan

- XAMPP / Laragon (PHP 8+, MySQL/MariaDB)
- Web browser modern

## Cara Menjalankan

1. Pasang XAMPP/Laragon.
2. Salin folder ini ke `htdocs/katalog-buku`.
3. Buka phpMyAdmin, impor `database.sql`.
4. Sesuaikan kredensial DB di `config.php` bila perlu.
5. Buka `http://localhost/katalog-buku/login.php`
6. Login: **admin / admin123**

## Struktur Proyek

| File | Fungsi |
|---|---|
| config.php | Koneksi DB, session, fungsi `e()`, CSRF, `require_login()` |
| lang.php / set_lang.php | Kamus bahasa & pengganti bahasa (disimpan di `$_SESSION['lang']`) |
| login.php / logout.php | Otentikasi |
| index.php | Read (tabel dashboard + pencarian + status stok) |
| create.php / edit.php / delete.php | Create, Update, Delete |
| validate.php | Validasi (if-else) & sanitasi input |
| form.php, header.php, footer.php | Partial tampilan (sidebar, topbar, footer) |
| style.css | Design system UI (CSS variables, komponen, responsif) |
| database.sql | Skema DB + data contoh |
| capture/ | Screenshot aplikasi (untuk dokumentasi README) |

## Keamanan

- **Prepared statement** (anti SQL injection)
- **`htmlspecialchars()`** pada semua output (anti XSS)
- **Token CSRF** pada semua form POST
- **`session_regenerate_id()`** setelah login (anti session fixation)
- **`strip_tags()`** pada input teks (sanitasi)

## Catatan Penting

> Password akun demo disimpan sebagai **teks biasa** di `database.sql` (`admin/admin123`).
> **Untuk produksi**, ganti dengan hash `password_hash()` dan verifikasi via `password_verify()`.

## Teknologi

- PHP 8 (native, tanpa framework)
- MySQL / MariaDB
- Vanilla CSS + inline SVG icons (tanpa dependensi eksternal)
