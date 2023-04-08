<?php require __DIR__ . "/inc/header.php"; ?>

<?php if ($_SESSION['driver']) : ?>
    <div class="error"><?= $_SESSION['driver']; ?></div>
<?php endif; ?>

<form action="db_handler.php" method="POST">
    <div>
        <select name="driver" id="driver">
            <option value="">select driver</option>
            <option value="redis" <?php if ($title === \Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::REDIS->value) : ?> selected <?php endif; ?>>Redis</option>
            <option value="memcached" <?php if ($title === \Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::MEMCACHED->value) : ?> selected <?php endif; ?>>Memcached</option>
            <option value="varnish" <?php if ($title === \Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::VARNISH->value) : ?> selected <?php endif; ?>>Varnish</option>
        </select>
    </div>

    <div>
        <input type="text" name="host" id="host" placeholder="127.0.01">
        <?php if ($_SESSION['host']) : ?>
            <div class="error"><?= $_SESSION['host']; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <input type="text" name="port" id="port" placeholder="6379">
        <?php if ($_SESSION['port']) : ?>
            <div class="error"><?= $_SESSION['port']; ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Save</button>
</form>

<?php require __DIR__ . "/inc/footer.php"; ?>