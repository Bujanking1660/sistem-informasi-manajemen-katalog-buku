<?php
// Dual bahasa: pilihan disimpan di $_SESSION['lang']
$LANG = [
  'id' => [
   'app_title'=>'Katalog Buku','app_subtitle'=>'Kelola koleksi & data inventaris buku','login'=>'Masuk','logout'=>'Keluar','username'=>'Nama pengguna','password'=>'Kata sandi',
   'login_failed'=>'Nama pengguna atau kata sandi salah.','welcome'=>'Halo','login_subtitle'=>'Masuk untuk mengelola katalog buku.',
   'book_list'=>'Daftar Buku','add_book'=>'Tambah Buku','edit_book'=>'Ubah Buku','no_data'=>'Belum ada data buku.',
   'no'=>'No','isbn'=>'ISBN','title'=>'Judul','author'=>'Penulis','publisher'=>'Penerbit','year'=>'Tahun','stock'=>'Stok','action'=>'Aksi',
   'edit'=>'Ubah','delete'=>'Hapus','save'=>'Simpan','cancel'=>'Batal','confirm_delete'=>'Yakin ingin menghapus buku ini?',
   'search'=>'Cari judul/penulis...','search_btn'=>'Cari','reset'=>'Reset',
   'err_required'=>'wajib diisi.','err_isbn'=>'ISBN harus 10-13 digit angka.','err_year'=>'Tahun harus angka antara 1900 dan tahun depan.',
   'err_stock'=>'Stok harus bilangan bulat >= 0.','err_dup'=>'ISBN sudah terdaftar.','err_csrf'=>'Token keamanan tidak valid.',
   'ok_created'=>'Buku berhasil ditambahkan.','ok_updated'=>'Buku berhasil diubah.','ok_deleted'=>'Buku berhasil dihapus.','not_found'=>'Data tidak ditemukan.','language'=>'Bahasa',
   'form_hint_isbn'=>'Format 10-13 digit angka tanpa tanda hubung.','back'=>'Kembali',
  ],
  'en' => [
   'app_title'=>'Book Catalog','app_subtitle'=>'Manage book collection & inventory','login'=>'Login','logout'=>'Logout','username'=>'Username','password'=>'Password',
   'login_failed'=>'Invalid username or password.','welcome'=>'Hello','login_subtitle'=>'Sign in to manage the book catalog.',
   'book_list'=>'Book List','add_book'=>'Add Book','edit_book'=>'Edit Book','no_data'=>'No book data yet.',
   'no'=>'No','isbn'=>'ISBN','title'=>'Title','author'=>'Author','publisher'=>'Publisher','year'=>'Year','stock'=>'Stock','action'=>'Actions',
   'edit'=>'Edit','delete'=>'Delete','save'=>'Save','cancel'=>'Cancel','confirm_delete'=>'Are you sure you want to delete this book?',
   'search'=>'Search title/author...','search_btn'=>'Search','reset'=>'Reset',
   'err_required'=>'is required.','err_isbn'=>'ISBN must be 10-13 digits.','err_year'=>'Year must be a number between 1900 and next year.',
   'err_stock'=>'Stock must be an integer >= 0.','err_dup'=>'ISBN is already registered.','err_csrf'=>'Invalid security token.',
   'ok_created'=>'Book added successfully.','ok_updated'=>'Book updated successfully.','ok_deleted'=>'Book deleted successfully.','not_found'=>'Data not found.','language'=>'Language',
   'form_hint_isbn'=>'10 to 13 digits without dashes.','back'=>'Back',
  ],
];

if (empty($_SESSION['lang']) || !isset($LANG[$_SESSION['lang']])) {
    $_SESSION['lang'] = 'id';
}
function t($key) {
    global $LANG;
    $l = $_SESSION['lang'];
    return $LANG[$l][$key] ?? $key;
}
