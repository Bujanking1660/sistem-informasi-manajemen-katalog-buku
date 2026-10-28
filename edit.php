<?php
require __DIR__ . '/config.php';
require_login();
require __DIR__ . '/validate.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT);
if ($id === false || $id < 1) { header('Location: index.php?msg=notfound'); exit; }

$stmt = $db->prepare('SELECT * FROM books WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();
if (!$book) { header('Location: index.php?msg=notfound'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors[] = t('err_csrf');
    } else {
        list($book, $errors) = validate_book($_POST);
        if (empty($errors)) {
            $chk = $db->prepare('SELECT id FROM books WHERE isbn = ? AND id <> ?');
            $chk->bind_param('si', $book['isbn'], $id);
            $chk->execute();
            if ($chk->get_result()->num_rows > 0) {
                $errors[] = t('err_dup');
            } else {
                $up = $db->prepare('UPDATE books SET isbn=?, title=?, author=?, publisher=?, year=?, stock=? WHERE id=?');
                $up->bind_param('ssssiii', $book['isbn'], $book['title'], $book['author'], $book['publisher'], $book['year'], $book['stock'], $id);
                $up->execute();
                header('Location: index.php?msg=updated');
                exit;
            }
        }
    }
}
include 'header.php';
?>
<a class="back-link" href="index.php">
  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <line x1="19" y1="12" x2="5" y2="12"></line>
    <polyline points="12 19 5 12 12 5"></polyline>
  </svg>
  <?= e(t('back')) ?>
</a>

<div class="dashboard-header" style="text-align: center; margin-bottom: 2rem;">
  <h1 class="dashboard-title"><?= e(t('edit_book')) ?></h1>
  <p class="dashboard-subtitle"><?= e(t('app_subtitle')) ?></p>
</div>

<?php include 'form.php'; ?>
<?php include 'footer.php'; ?>
