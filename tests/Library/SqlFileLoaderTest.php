<?php

namespace App\Library;

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection;

/**
 * Test cases for class FlashGenerator.
 */
class SqlFileLoaderTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $conn = $this->createMock(Connection::class);
        $loader = new SqlFileLoader($conn);
        $this->assertInstanceOf("\App\Library\SqlFileLoader", $loader);
    }


    /**
     * Tests the load method
     */
    public function testLoad(): void
    {
        $conn = $this->createMock(Connection::class);
        $loader = new SqlFileLoader($conn);
        $sql = "This is some text";
        $conn->expects($this->once())
            ->method('executeStatement')
            ->with($this->equalTo("This is some text"));
        $loader->load($sql);
    }
}
