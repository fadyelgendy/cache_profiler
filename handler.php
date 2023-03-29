<?php

define('REDIS', 'redis');
define('MEMCACHED', 'memcached');
define('VARNISH', 'varnish');

$driver = $_GET['driver'];

if ($driver == REDIS) {
    echo REDIS;
    exit;
} else if ($driver == MEMCACHED) {
    echo MEMCACHED;
    exit;
} else if ($driver == VARNISH) {
    echo VARNISH;
    exit;
} else {
    echo 'ERROR: Driver Not Set!';
    exit;
}