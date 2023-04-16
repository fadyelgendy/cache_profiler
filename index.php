<?php include __DIR__. "/vendor/autoload.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cache profile v0.1</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <main>
        <h1 class="title">cache profiler <small>V0.1</small></h1>
        <h3>Choose your caching system</h3>
        <div class="container">
            <?php foreach (\Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum::cases() as $driver) : ?>
                <div>
                    <a href="handler.php?driver=<?= $driver->value; ?>">
                        <img src="/public/assets/<?= $driver->value; ?>.png" alt="<?= $driver->value; ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>