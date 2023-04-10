<?php

namespace Fadyandrawes\CacheProfiler\DatabaseStrategies;

use Fadyandrawes\CacheProfiler\DatabaseStrategies\DatabaseInterface;
use PDO;

class DatabaseContext
{
    private DatabaseInterface $databaseInterface;
    private PDO $pdo;

    public function setStrategy(DatabaseInterface $databaseInterface):self
    {
        $this->databaseInterface = $databaseInterface;

        return $this;
    }

    public function executeStratgy(string $db_name): PDO
    {
        return $this->databaseInterface->setUp($db_name);
    }
}