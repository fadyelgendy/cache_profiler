<?php

namespace Fadyandrawes\CacheProfiler\DatabaseStrategies;

use PDO;

interface DatabaseInterface
{
    public function setUp(string $db_name): PDO;
}