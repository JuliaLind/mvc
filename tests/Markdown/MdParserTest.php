<?php

namespace App\Markdown;

use PHPUnit\Framework\TestCase;
// use App\Markdown\MdParser;
use Anax\TextFilter\TextFilter;

/**
 * To mock the builtin function file_get_contents.
 * Even though the params are not used
 * they are needed to resemble the "mocked" function
 * @scrutinizer ignore-unused
 * @SuppressWarnings(PHPMD)
 */
function file_get_contents(string $filename): string
{
    return "This is some text";
}

/**
 * Test cases for class FlashGenerator.
 */
class MdParserTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $parser= new MdParser();
        $this->assertInstanceOf("\App\Markdown\MdParser", $parser);
    }


    // /**
    //  * Tests the getParsedText method
    //  */
    // public function testGetParsedText(): void
    // {
    //     $filter = $this->createMock("Anax\TextFilter\TextFilter");
    //     $filter->expects($this->once())->method('parse')
    //     ->with($this->equalTo("This is some text"), $this->equalTo(["markdown"]));
    //     $parser = new MdParser();
    //     $parser->getParsedText("filnamn", $filter);
    // }
}
