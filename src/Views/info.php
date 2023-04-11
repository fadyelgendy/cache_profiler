<?php require __DIR__ . "/inc/header.php"; ?>

<div class="info_container">
    <div class="col-8">
        <?php
        include __DIR__ . "/console.php";
        include __DIR__ . "/inc/actions.php";
        ?>
    </div>

    <div class="col-4 <?= strtolower($title); ?>">
        <?php include __DIR__ . "/server_info.php"; ?>
    </div>
</div>

<?php require __DIR__ . "/inc/footer.php"; ?>