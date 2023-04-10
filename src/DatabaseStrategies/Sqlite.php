<?php

namespace Fadyandrawes\CacheProfiler\DatabaseStrategies;

use Fadyandrawes\CacheProfiler\Enums\DatabaseDriverEnum;
use PDO;
use PDOException;

class Sqlite implements DatabaseInterface
{
    private PDO $pdo;

    public function setup(string $db_name): PDO
    {
        try {
            $sqlite = DatabaseDriverEnum::SQLITE->value;
            $this->pdo = new PDO($sqlite.':' . $db_name . '.' . $sqlite);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->pdo;
        } catch (PDOException $ex) {
            die('ERROR: ' . $ex->getMessage());
        }
    }
}
