<?php

require __DIR__ . "/vendor/autoload.php";

use Fadyandrawes\CacheProfiler\CacheStrategies\CacheContext;
use Fadyandrawes\CacheProfiler\CacheStrategies\RedisCache;
use Fadyandrawes\CacheProfiler\Enums\CacheDriverEnum;

$driver = $_GET['driver'];

$context = new CacheContext();

if ($driver == CacheDriverEnum::REDIS->value) {
    $context->setStrategy(new RedisCache('127.0.0.1', 6379));
} else if ($driver == CacheDriverEnum::MEMCACHED->value) {
    echo 'MEMCACHED';
    exit;
} else if ($driver == CacheDriverEnum::VARNISH->value) {
    echo 'VARNISH';
    exit;
} else {
    echo 'ERROR: Driver Not Set!';
    exit;
}

echo $context->executeStrategy();
