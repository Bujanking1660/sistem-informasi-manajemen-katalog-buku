<?php
require __DIR__ . '/config.php';
require_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid()) {
    $id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);
    if ($id !== false && $id > 0) {
        $stmt = $db->prepare('DELETE FROM books WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        header('Location: index.php?msg=deleted');
        exit;
    }
}
header('Location: index.php');
exit;
