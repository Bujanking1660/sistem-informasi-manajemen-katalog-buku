<?php /* Partial form: butuh $book (array) dan $errors */ ?>
<div class="form-card">
  <?php if (!empty($errors)): ?>
    <div class="alert err">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <div>
        <ul class="alert-list">
          <?php foreach ($errors as $er): ?>
            <li><?= e($er) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php endif; ?>

  <form method="POST" action="">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

    <div class="form-grid">
      <div class="form-group">
        <label class="form-label"><?= e(t('isbn')) ?> <span class="req">*</span></label>
        <input type="text" name="isbn" value="<?= e($book['isbn']) ?>" maxlength="13" placeholder="Contoh: 9786020332956" required>
        <span class="form-hint"><?= e(t('form_hint_isbn')) ?></span>
      </div>

      <div class="form-group">
        <label class="form-label"><?= e(t('year')) ?> <span class="req">*</span></label>
        <input type="number" name="year" value="<?= e($book['year']) ?>" placeholder="YYYY" min="1900" max="<?= (int)date('Y') + 1 ?>" required>
      </div>

      <div class="form-group col-full">
        <label class="form-label"><?= e(t('title')) ?> <span class="req">*</span></label>
        <input type="text" name="title" value="<?= e($book['title']) ?>" placeholder="<?= e(t('title')) ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label"><?= e(t('author')) ?> <span class="req">*</span></label>
        <input type="text" name="author" value="<?= e($book['author']) ?>" placeholder="<?= e(t('author')) ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label"><?= e(t('publisher')) ?> <span class="req">*</span></label>
        <input type="text" name="publisher" value="<?= e($book['publisher']) ?>" placeholder="<?= e(t('publisher')) ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label"><?= e(t('stock')) ?> <span class="req">*</span></label>
        <input type="number" name="stock" value="<?= e($book['stock']) ?>" min="0" placeholder="0" required>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn-primary-dark" type="submit">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
          <polyline points="17 21 17 13 7 13 7 21"></polyline>
          <polyline points="7 3 7 8 15 8"></polyline>
        </svg>
        <?= e(t('save')) ?>
      </button>
      <a class="btn-secondary" href="index.php">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
        <?= e(t('cancel')) ?>
      </a>
    </div>
  </form>
</div>
