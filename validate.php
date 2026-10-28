<?php
// Validasi + sanitasi input buku. Mengembalikan [data_bersih, daftar_error]
function validate_book(array $in) {
    $errors = [];
    $d = [
        'isbn'      => trim((string)($in['isbn'] ?? '')),
        'title'     => trim((string)($in['title'] ?? '')),
        'author'    => trim((string)($in['author'] ?? '')),
        'publisher' => trim((string)($in['publisher'] ?? '')),
        'year'      => trim((string)($in['year'] ?? '')),
        'stock'     => trim((string)($in['stock'] ?? '')),
    ];
    // Sanitasi teks: buang tag HTML
    foreach (['title','author','publisher'] as $f) {
        $d[$f] = htmlspecialchars(strip_tags($d[$f]), ENT_QUOTES, 'UTF-8');
    }

    // Validasi kelengkapan (if-else)
    foreach (['isbn'=>'isbn','title'=>'title','author'=>'author','publisher'=>'publisher','year'=>'year','stock'=>'stock'] as $f => $k) {
        if ($d[$f] === '') { $errors[] = t($k) . ' ' . t('err_required'); }
    }
    if ($d['isbn'] !== '' && !preg_match('/^\d{10,13}$/', $d['isbn'])) {
        $errors[] = t('err_isbn');
    }
    if ($d['year'] !== '') {
        $y = filter_var($d['year'], FILTER_VALIDATE_INT, ['options'=>['min_range'=>1900,'max_range'=>(int)date('Y')+1]]);
        if ($y === false) { $errors[] = t('err_year'); } else { $d['year'] = $y; }
    }
    if ($d['stock'] !== '') {
        $s = filter_var($d['stock'], FILTER_VALIDATE_INT, ['options'=>['min_range'=>0]]);
        if ($s === false) { $errors[] = t('err_stock'); } else { $d['stock'] = $s; }
    }
    return [$d, $errors];
}
