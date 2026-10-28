<?php
require __DIR__ . '/config.php';
if (!empty($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    if ($u === '' || $p === '') {
        $error = t('login_failed');
    } else {
        $stmt = $db->prepare('SELECT id, username, password FROM users WHERE username = ?');
        $stmt->bind_param('s', $u);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        if ($row && hash_equals($row["password"], $p)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: index.php');
            exit;
        }
        $error = t('login_failed');
    }
}
include 'header.php';
?>
<div class="auth-card">
  <div class="auth-header">
    <div class="auth-logo-sq">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
      </svg>
    </div>
    <h1 class="auth-title"><?= e(t('login')) ?></h1>
    <p class="auth-subtitle"><?= e(t('login_subtitle')) ?></p>
  </div>

  <?php if ($error): ?>
    <div class="alert err">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <div><?= e($error) ?></div>
    </div>
  <?php endif; ?>

  <form method="POST">
    <div class="auth-input-group">
      <label class="form-label"><?= e(t('username')) ?></label>
      <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
      <input type="text" name="username" value="<?= e($_POST['username'] ?? '') ?>" placeholder="admin" required autofocus>
    </div>

    <div class="auth-input-group">
      <label class="form-label"><?= e(t('password')) ?></label>
      <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
      </svg>
      <input type="password" name="password" placeholder="••••••••" required>
    </div>

    <button class="btn-primary-dark" type="submit" style="width:100%; justify-content:center; margin-top:0.5rem; padding:0.75rem;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
        <polyline points="10 17 15 12 10 7"></polyline>
        <line x1="15" y1="12" x2="3" y2="12"></line>
      </svg>
      <?= e(t('login')) ?>
    </button>
  </form>

  <div class="auth-demo-badge">
    Akun demo: <code>admin</code> / <code>admin123</code>
  </div>
</div>
<?php include 'footer.php'; ?>
