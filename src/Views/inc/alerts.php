<?php if ($_SESSION['success']) : ?>
    <div class="alert alert-success">
        <?= $_SESSION['success']; ?>
    </div>
<?php endif; ?>

<?php if ($_SESSION['failed']) : ?>
    <div class="alert alert-error">
        <?= $_SESSION['failed']; ?>
    </div>
<?php endif; ?>