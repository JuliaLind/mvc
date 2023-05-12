<?php

namespace App\Library;

use Doctrine\DBAL\Connection;

/**
 * Resets database from file
 */
class SqlFileLoader
{
    /**
     * Holds instance of the Doctrine connection for the resetter.
     *
     * @var Connection
     */
    protected $conn;

    public function __construct(Connection $connection)
    {
        $this->conn = $connection;
    }

    public function load(string $sql): void
    {
        $conn = $this->conn;
        $conn->executeStatement($sql);
    }
}
