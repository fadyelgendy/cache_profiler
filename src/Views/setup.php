<?php require __DIR__ . "/inc/header.php"; ?>

<form action="db_handler.php" method="POST">
    <div class="form-group">
        <label for="driver">driver</label>

        <div>
            <?php if ($_SESSION['driver']) : ?>
                <div class="error"><?= $_SESSION['driver']; ?></div>
            <?php endif; ?>

            <select name="driver" id="driver">
                <option value="">select driver</option>
                <?php foreach (\Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::cases() as $driver) : ?>
                    <option value="<?= $driver->value; ?>" <?php if ($title === $driver->value) : ?> selected <?php endif; ?>>
                        <?= ucwords($driver->value); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="host">Host</label>
        <div>
            <input type="text" name="host" id="host" placeholder="127.0.01">
            <?php if ($_SESSION['host']) : ?>
                <div class="error"><?= $_SESSION['host']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="port">port</label>
        <div>
            <input type="text" name="port" id="port" placeholder="6379">
            <?php if ($_SESSION['port']) : ?>
                <div class="error"><?= $_SESSION['port']; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="has_auth">authenitcate?</label>
        <div>
            <input type="checkbox" name="has_auth" id="has_auth">
        </div>
    </div>

    <div id="auth">
        <div class="form-group">
            <label for="username">Username</label>
            <div>
                <input type="text" name="username" id="username" placeholder="Username">
                <?php if ($_SESSION['username']) : ?>
                    <div class="error"><?= $_SESSION['username']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div>
                <input type="password" name="password" id="password" placeholder="password">
                <?php if ($_SESSION['password']) : ?>
                    <div class="error"><?= $_SESSION['password']; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-group form-footer">
        <div></div>
        <button type="submit">Save</button>
    </div>

</form>

<script>
    var hasAuth = document.getElementById('has_auth');
    var authContainer = document.getElementById('auth');

    hasAuth.addEventListener('change', function (event) {
        var checked = this.checked;

        if (checked === true) {
            authContainer.style.display = 'block';
        } else {
            authContainer.style.display = 'none';
        }
    });
</script>

<?php require __DIR__ . "/inc/footer.php"; ?>