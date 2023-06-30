<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;

/**
 * Loads sql file to database
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
