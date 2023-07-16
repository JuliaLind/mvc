<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;

/**
 * Loads sql file to database, used in routes related to resetting tables in database (Library and Project)
 */
class SqlFileLoader
{
    public function load(string $filename, Connection $connection): void
    {
        /**
         * @var string $sql
         */
        $sql = file_get_contents($filename);
        $connection->executeStatement($sql);
    }
}
