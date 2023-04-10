<?php

require __DIR__ ."/vendor/autoload.php";
require __DIR__ . "/helpers.php";

use Fadyandrawes\CacheProfiler\Database;

session_start();

$driver = $_POST['driver'];
$host = $_POST['host'];
$port = $_POST['port'];


// Validate input
if (empty($host) || !isset($host)) {
    $_SESSION['host'] = "Host is reqired";

    header("Location: handler.php?driver=" . $driver);
    exit;
} else {
    session_destroy();
}

if (empty($port) || !isset($port)) {
    $_SESSION['port'] = "port is reqired";

    header("Location: handler.php?driver=" . $driver);
    exit;
} else {
    session_destroy();
}

// store data
$db = new Database(env('db_driver'), env('db_name'));
$data = [
    'driver' => trim($driver),
    'host' => trim($host),
    'port' => trim($port),
];

$saved = $db->save('drivers', $data);

if (!$saved) {
    $_SESSION['driver'] = "Driver settings can not be saved. Please try again!";
}

header("Location: handler.php?driver=" . $driver);