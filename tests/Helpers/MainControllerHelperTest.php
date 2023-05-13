<?php

namespace App\Helpers;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

/**
 * Test cases for class MainControllerHelper class.
 */
class MainControllerHelperTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $helper = new MainControllerHelper();
        $this->assertInstanceOf("\App\Helpers\MainControllerHelper", $helper);
    }

    /**
     * Testa standardData method
     */
    public function testStandardData(): void
    {
        $helper = new MainControllerHelper();
        $page = "home";
        $parser = $this->createMock(MdParser::class);
        $filename = "markdown/{$page}.md";

        $parser->expects($this->once())
        ->method('getParsedText')
        ->with($filename)
        ->willReturn("Test");

        $exp = [
            'title' => 'Home',
            'text' => "Test",
            'page' => "home",
            'url' => "/",
        ];
        $res = $helper->standardData($page, $parser);

        $this->assertEquals($exp, $res);
    }

    /**
     * Testa homeData method
     */
    public function testReportData(): void
    {
        $helper = new MainControllerHelper();
        // $filename = "markdown/home.md";
        $parser = $this->createMock(MdParser::class);

        $filenames = [];
        $data = [];
        $returnVals = [];
        for ($i = 1; $i <= 7; $i++) {
            array_push($filenames, ["markdown/kmom0{$i}.md"]);
            $data["kmom0{$i}"] = "Test {$i}";
            array_push($returnVals, "Test {$i}");
        }
        $parser->expects($this->exactly(7))
        ->method('getParsedText')
        ->will($this->onConsecutiveCalls(...$returnVals));

        $exp = [
            'page' => "report",
            'url' => "/report",
            ...$data
        ];
        $res = $helper->reportData($parser);

        $this->assertEquals($exp, $res);
    }
}
