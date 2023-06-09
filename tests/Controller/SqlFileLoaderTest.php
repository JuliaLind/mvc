<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection;

// /**
//  * To mock the builtin function file_get_contents.
//  * Even though the params are not used
//  * they are needed to resemble the "mocked" function
//  * @scrutinizer ignore-unused
//  * @SuppressWarnings(PHPMD)
//  */
// function file_get_contents(string $filename): string
// {
//     return "This is some text";
// }

/**
 * Test cases for class FlashGenerator.
 */
class SqlFileLoaderTest extends TestCase
{
    /**
     * Tests the load method
     */
    public function testLoad(): void
    {
        $conn = $this->createMock(Connection::class);
        $loader = new SqlFileLoader();
        $conn->expects($this->once())
            ->method('executeStatement')
            ->with($this->equalTo("This is some text"));
        $loader->load("sql/reset-book.sql", $conn);
    }
}
