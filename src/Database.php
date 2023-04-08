<?php

namespace Fadyandrawes\CacheProfiler;

use PDO;
use PDORow;
use Throwable;

class Database
{
    private $pdo;

    public function __construct(protected string $db_name)
    {
        try {
            $this->pdo = new PDO('sqlite:' . $db_name . '.db');
        } catch (Throwable $ex) {
            die('ERROR: ' . $ex->getMessage());
        }
    }

    public function get(string $driver): bool|PDORow
    {
        $this->createDriversTable();

        $sql  = "SELECT * FROM drivers WHERE driver = :driver";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam('driver', $driver);

        $statement->execute();

        $result = $statement->fetch(MYSQLI_ASSOC);

        return $result;
    }

    public function save(string $table_name, array $data): bool
    {
        $this->createDriversTable();

        $sql = "INSERT INTO $table_name(";

        $i = 1;
        foreach ($data as $key => $value) {
            if ($i < count($data)) {
                $sql .= "" . $key . ",";
            } else {
                $sql .= "" . $key;
            }
            ++$i;
        }

        $sql .= ") VALUES(";

        $i = 1;
        foreach ($data as $key => $value) {
            if ($i < count($data)) {
                $sql .= ":" . $key . ",";
            } else {
                $sql .= ":" . $key;
            }

            ++$i;
        }

        $sql .= ");";

        try {
            $statement = $this->pdo->prepare($sql);

            foreach ($data as $key => &$value) {
                $statement->bindParam(":" . $key, $value);
            }

            $statement->execute();

            return true;
        } catch (Throwable $ex) {
            return false;
        }
    }

    protected  function createDriversTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS drivers (
            'id' INTEGER PRIMARY KEY AUTOINCREMENT,
            'driver' VARCHAR(255) NOT NULL,
            'host' VARCHAR(255) NOT NULL,
            'port' VARCHAR(255) NOT NULL,
            'options' JSON NULLABLE
        )";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();
    }
}
