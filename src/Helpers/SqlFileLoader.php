<?php

namespace App\Helpers;

use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Doctrine\DBAL\Connection;

/**
 * Resets database from file
 */
#[CodeCoverageIgnore]
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

    public function load(string $filename): void
    {
        $conn = $this->conn;
        $sql = file_get_contents($filename);
        if ($sql == null) {
            $sql = "";
        }
        $conn->exec($sql);
    }
}
