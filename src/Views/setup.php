<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <div class="content">
        <div class="section_heading">
            <h2>Adding <?= ucwords($driver); ?> driver: </h2>
            <a href="/">Home</a>
        </div>

        <?php if ($_SESSION['driver']) : ?>
            <div class="error"><?= $_SESSION['driver']; ?></div>
        <?php endif; ?>

        <form action="db_handler.php" method="POST">
            <div>
                <select name="driver" id="driver">
                    <option value="">select driver</option>
                    <option value="redis" <?php if ($driver === \Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::REDIS->value) : ?> selected <?php endif; ?>>Redis</option>
                    <option value="memcached" <?php if ($driver === \Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::MEMCACHED->value) : ?> selected <?php endif; ?>>Memcached</option>
                    <option value="varnish" <?php if ($driver === \Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::VARNISH->value) : ?> selected <?php endif; ?>>Varnish</option>
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
    </div>
</body>

</html>