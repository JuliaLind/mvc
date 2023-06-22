<?php

namespace App\Helpers;

use Doctrine\DBAL\Connection;

/**
 * Resets database from file
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
