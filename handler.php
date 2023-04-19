<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/helpers.php";

session_start();

use Fadyandrawes\CacheProfiler\CacheStrategies\CacheContext;
use Fadyandrawes\CacheProfiler\Database;

define('CACHE_DRIVER_PATH', "Fadyandrawes\\CacheProfiler\\CacheStrategies\\");

// check for database first
$db = Database::getInstance(env('db_driver'), env('db_name'));

$title = $_GET['driver'];

$driver_settings = $db->get($title);

if (!$driver_settings) {
    ob_start();
    include __DIR__ . "/src/Views/setup.php";
    echo ob_get_clean();
    exit;
} else {
    $target_class = CACHE_DRIVER_PATH .  ucwords($driver_settings->driver) . 'Cache';

    if (class_exists($target_class)) {
        $context = new CacheContext();
        $context->setStrategy(new $target_class($driver_settings->host, $driver_settings->port));

        echo $context->executeStrategy($_POST);
    } else {
        ob_start();
        include __DIR__ . "/src/Views/comming.php";
        echo ob_get_clean();
        exit;
    }
}

session_destroy();
