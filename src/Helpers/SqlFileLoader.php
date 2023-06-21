<?php

namespace App\Helpers;

use Doctrine\DBAL\Connection;

/**
 * Resets database from file
 */
class SqlFileLoader
{
    // /**
    //  * Holds instance of the Doctrine connection for the resetter.
    //  *
    //  * @var Connection
    //  */
    // protected $conn;

    // public function __construct(Connection $connection)
    // {
    //     $this->conn = $connection;
    // }

    // public function load(string $filename): void
    // {
    //     /**
    //      * @var string $sql
    //      */
    //     $sql = file_get_contents($filename);
    //     $conn = $this->conn;
    //     $conn->executeStatement($sql);
    // }


    public function load(string $filename, Connection $connection): void
    {
        /**
         * @var string $sql
         */
        $sql = file_get_contents($filename);
        $connection->executeStatement($sql);
    }
}
