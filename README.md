# Katalog Buku (PHP + MySQL)

Aplikasi manajemen katalog buku dengan antarmuka dashboard modern, login berbasis session, dan dua bahasa (ID/EN).

## Fitur

- **Dashboard SaaS-style** — sidebar rail, topbar, status pill stok (hijau/amber/merah), menu aksi 3-titik, paginasi
- **CRUD Buku** — tambah, ubah, hapus, dan lihat daftar buku beserta pencarian judul/penulis
- **Login & Session** — proteksi halaman, `session_regenerate_id()` setelah login
- **Dual Bahasa** — Indonesia & Inggris (disimpan di `$_SESSION['lang']`)
- **Status Stok Otomatis** — badge warna berdasarkan jumlah stok (Tersedia / Stok Sedikit / Habis)
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
"# sistem-informasi-manajemen-katalog-buku" 
