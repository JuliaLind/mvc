<?php

namespace App\Library;

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection;

/**
 * To mock the builtin function file_get_contents
 * @SuppressWarnings(PHPMD)
 */
function file_get_contents(string $filename): string
{
    return "This is some text";
}

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
        // $sql = "This is some text";
        $conn->expects($this->once())
            ->method('executeStatement')
            ->with($this->equalTo("This is some text"));
        $loader->load("sql/reset-book.sql");
    }
}
