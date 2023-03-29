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
            <div>
                <a href="handler.php?driver=redis">
                    <img src="/public/assets/redis.png" alt="redis">
                </a>
            </div>

            <div>
                <a href="handler.php?driver=memcached">
                    <img src="/public/assets/memcached.png" alt="memcached">
                </a>
            </div>

            <div>
                <a href="handler.php?driver=varnish">
                    <img src="/public/assets/varnish.png" alt="varnish">
                </a>
            </div>
        </div>
    </main>
</body>

</html>