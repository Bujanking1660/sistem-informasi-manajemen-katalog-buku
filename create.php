<?php
require __DIR__ . '/config.php';
require_login();
require __DIR__ . '/validate.php';

$book = ['isbn'=>'','title'=>'','author'=>'','publisher'=>'','year'=>'','stock'=>''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valid()) {
        $errors[] = t('err_csrf');
    } else {
        list($book, $errors) = validate_book($_POST);
        if (empty($errors)) {
            $stmt = $db->prepare('SELECT id FROM books WHERE isbn = ?');
            $stmt->bind_param('s', $book['isbn']);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                $errors[] = t('err_dup');
            } else {
                $ins = $db->prepare('INSERT INTO books (isbn,title,author,publisher,year,stock) VALUES (?,?,?,?,?,?)');
                $ins->bind_param('ssssii', $book['isbn'], $book['title'], $book['author'], $book['publisher'], $book['year'], $book['stock']);
                $ins->execute();
                header('Location: index.php?msg=created');
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
  <h1 class="dashboard-title"><?= e(t('add_book')) ?></h1>
  <p class="dashboard-subtitle"><?= e(t('app_subtitle')) ?></p>
</div>

<?php include 'form.php'; ?>
<?php include 'footer.php'; ?>
