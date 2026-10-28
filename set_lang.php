<?php
require __DIR__ . '/config.php';
// Validasi pilihan bahasa dengan switch
switch ($_GET['lang'] ?? '') {
    case 'en': $_SESSION['lang'] = 'en'; break;
    case 'id': $_SESSION['lang'] = 'id'; break;
    default: break;
}
$allowed = ['index.php','login.php','create.php','edit.php'];
$back = $_GET['back'] ?? 'index.php';
if (!in_array($back, $allowed, true)) { $back = 'index.php'; }
$qs = ($back === 'edit.php' && isset($_GET['id'])) ? '?id=' . (int)$_GET['id'] : '';
header('Location: ' . $back . $qs);
exit;
