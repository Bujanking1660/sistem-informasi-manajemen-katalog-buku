<?php 
$page = basename($_SERVER['PHP_SELF']); 
$idq = isset($_GET['id']) ? '&id=' . (int)$_GET['id'] : '';
$css_ver = file_exists(__DIR__ . '/style.css') ? filemtime(__DIR__ . '/style.css') : '1';
?>
<!DOCTYPE html>
<html lang="<?= e($_SESSION['lang'] ?? 'id') ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(t('app_title')) ?></title>
<link rel="stylesheet" href="style.css?v=<?= $css_ver ?>">
</head>
<body>
<?php if (!empty($_SESSION['user_id'])): ?>
<div class="app-layout">
  <!-- Sidebar Rail -->
  <aside class="app-sidebar">
    <a href="index.php" class="sidebar-brand" title="<?= e(t('app_title')) ?>">
      <div class="sidebar-logo-sq">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
          <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
        </svg>
      </div>
    </a>

    <nav class="sidebar-nav">
      <!-- Books / Catalog item -->
      <a href="index.php" class="sidebar-nav-item <?= in_array($page, ['index.php', 'edit.php'], true) ? 'active' : '' ?>" title="<?= e(t('book_list')) ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"></rect>
          <rect x="14" y="3" width="7" height="7"></rect>
          <rect x="14" y="14" width="7" height="7"></rect>
          <rect x="3" y="14" width="7" height="7"></rect>
        </svg>
      </a>

      <!-- Add Book item -->
      <a href="create.php" class="sidebar-nav-item <?= $page === 'create.php' ? 'active' : '' ?>" title="<?= e(t('add_book')) ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
      </a>
    </nav>

    <div class="sidebar-bottom">
      <!-- Red circle action button at bottom left (matching screenshot) -->
      <a href="logout.php" class="sidebar-back-circle" title="<?= e(t('logout')) ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
      </a>
    </div>
  </aside>

  <!-- Main App Area -->
  <div class="app-main">
    <!-- Topbar -->
    <header class="app-topbar">
      <!-- Notification bell -->
      <div class="topbar-bell" title="Notifikasi">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
        </svg>
      </div>

      <!-- Language Toggle Pill -->
      <div class="lang-toggle">
        <a class="lang-pill <?= ($_SESSION['lang'] ?? 'id') === 'id' ? 'active' : '' ?>" href="set_lang.php?lang=id&back=<?= e($page . $idq) ?>">ID</a>
        <a class="lang-pill <?= ($_SESSION['lang'] ?? 'id') === 'en' ? 'active' : '' ?>" href="set_lang.php?lang=en&back=<?= e($page . $idq) ?>">EN</a>
      </div>

      <!-- User Profile Badge -->
      <div class="user-profile-badge">
        <div class="user-avatar-img">
          <?= strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)) ?>
        </div>
        <div class="user-info">
          <span class="user-name"><?= e($_SESSION['username'] ?? 'Admin') ?></span>
          <span class="user-email">admin@katalog.local</span>
        </div>
      </div>
    </header>

    <main class="app-content">
<?php else: ?>
<main class="auth-page-container">
<?php endif; ?>
