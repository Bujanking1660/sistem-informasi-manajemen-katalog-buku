<?php
require __DIR__ . '/config.php';
require_login();

$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $db->prepare('SELECT * FROM books WHERE title LIKE ? OR author LIKE ? ORDER BY id DESC');
    $stmt->bind_param('ss', $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $db->query('SELECT * FROM books ORDER BY id DESC');
}

$flash = '';
switch ($_GET['msg'] ?? '') {
    case 'created': $flash = t('ok_created'); break;
    case 'updated': $flash = t('ok_updated'); break;
    case 'deleted': $flash = t('ok_deleted'); break;
    case 'notfound': $flash = t('not_found'); break;
}
include 'header.php';
?>

<div class="dashboard-header">
  <h1 class="dashboard-title"><?= e(t('book_list')) ?></h1>
  <p class="dashboard-subtitle">Kelola dan pantau seluruh data buku dalam satu tempat — dari status inventaris hingga detail penerbit.</p>
</div>

<?php if ($flash): ?>
  <div class="alert ok">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
      <polyline points="22 4 12 14.01 9 11.01"></polyline>
    </svg>
    <div><?= e($flash) ?></div>
  </div>
<?php endif; ?>

<!-- Dashboard Toolbar -->
<div class="dashboard-toolbar">
  <div class="toolbar-left">
    <form method="GET" style="display:flex; gap:0.5rem; align-items:center; width:100%;">
      <div class="search-box">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" name="q" value="<?= e($q) ?>" placeholder="<?= e(t('search')) ?>">
      </div>
      <button class="toolbar-pill-btn" type="submit">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <?= e(t('search_btn')) ?>
      </button>
      <?php if ($q !== ''): ?>
        <a class="toolbar-pill-btn" href="index.php"><?= e(t('reset')) ?></a>
      <?php endif; ?>
    </form>
  </div>

  <div class="toolbar-right">
    <!-- Date picker style pill from screenshot -->
    <div class="toolbar-pill-btn">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
      </svg>
      <span><?= date('d M Y') ?></span>
    </div>

    <!-- Add Book Primary Dark Button -->
    <a class="btn-primary-dark" href="create.php">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="5" x2="12" y2="19"></line>
        <line x1="5" y1="12" x2="19" y2="12"></line>
      </svg>
      <span><?= e(t('add_book')) ?></span>
    </a>
  </div>
</div>

<!-- Table Card (like reference image) -->
<div class="table-card">
  <div class="table-responsive">
    <table class="modern-table">
      <thead>
        <tr>
          <th style="width: 40px; text-align: center;">
            <input type="checkbox" class="custom-checkbox">
          </th>
          <th style="width: 45px;">No</th>
          <th>ISBN</th>
          <th><?= e(t('title')) ?></th>
          <th><?= e(t('author')) ?></th>
          <th><?= e(t('publisher')) ?></th>
          <th><?= e(t('year')) ?></th>
          <th>Status Stok</th>
          <th style="text-align: right;"><?= e(t('action')) ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($r = $result->fetch_assoc()): ?>
        <tr>
          <td style="text-align: center;">
            <input type="checkbox" class="custom-checkbox">
          </td>
          <td style="color: var(--text-muted); font-size: 0.82rem;"><?= $no++ ?></td>
          <td><span class="badge-isbn"><?= e($r['isbn']) ?></span></td>
          <td class="book-title-cell"><?= e($r['title']) ?></td>
          <td class="book-author-cell"><?= e($r['author']) ?></td>
          <td><?= e($r['publisher']) ?></td>
          <td><span class="badge-year"><?= e($r['year']) ?></span></td>
          <td>
            <?php if ((int)$r['stock'] > 5): ?>
              <span class="status-pill status-green">Tersedia (<?= (int)$r['stock'] ?>)</span>
            <?php elseif ((int)$r['stock'] > 0): ?>
              <span class="status-pill status-amber">Stok Sedikit (<?= (int)$r['stock'] ?>)</span>
            <?php else: ?>
              <span class="status-pill status-red">Habis (0)</span>
            <?php endif; ?>
          </td>
          <td style="text-align: right;">
            <div class="action-cell">
              <!-- Quick mini buttons -->
              <a class="btn-mini" href="edit.php?id=<?= (int)$r['id'] ?>" title="<?= e(t('edit')) ?>">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                <?= e(t('edit')) ?>
              </a>

              <!-- 3-dots action dropdown from reference -->
              <div class="action-dropdown">
                <button class="action-dots-btn" type="button" title="Menu">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="12" cy="5" r="1"></circle>
                    <circle cx="12" cy="19" r="1"></circle>
                  </svg>
                </button>
                <div class="action-dropdown-menu">
                  <a class="dropdown-item" href="edit.php?id=<?= (int)$r['id'] ?>">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <?= e(t('edit')) ?>
                  </a>
                  <form method="POST" action="delete.php" onsubmit="return confirm('<?= e(t('confirm_delete')) ?>')">
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                    <button class="dropdown-item danger" type="submit">
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                      </svg>
                      <?= e(t('delete')) ?>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <?php endwhile; ?>
        <?php if ($no === 1): ?>
        <tr>
          <td colspan="9">
            <div class="empty-state">
              <div class="empty-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                  <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
              </div>
              <div class="empty-title"><?= e(t('no_data')) ?></div>
              <p class="empty-desc"><?= $q !== '' ? 'Tidak ada data buku yang sesuai kata kunci pencarian.' : 'Katalog buku masih kosong.' ?></p>
              <?php if ($q !== ''): ?>
                <a class="toolbar-pill-btn" href="index.php"><?= e(t('reset')) ?></a>
              <?php else: ?>
                <a class="btn-primary-dark" href="create.php">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                  <?= e(t('add_book')) ?>
                </a>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Bottom Pagination (matching reference image) -->
<div class="dashboard-pagination">
  <div class="show-data-pill">
    <span>Show Data</span>
    <span class="show-data-select"><?= max(1, $no - 1) ?></span>
  </div>

  <div class="pagination-controls">
    <button class="page-btn" type="button" title="First">&laquo;</button>
    <button class="page-btn" type="button" title="Previous">&lsaquo;</button>
    <button class="page-btn active" type="button">1</button>
    <button class="page-btn" type="button">2</button>
    <button class="page-btn" type="button">3</button>
    <span class="page-dots">...</span>
    <button class="page-btn" type="button">10</button>
    <button class="page-btn" type="button" title="Next">&rsaquo;</button>
    <button class="page-btn" type="button" title="Last">&raquo;</button>
  </div>
</div>

<?php include 'footer.php'; ?>
