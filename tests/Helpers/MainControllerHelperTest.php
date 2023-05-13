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
     * Testa homeData method
     */
    public function testHomeData(): void
    {
        $helper = new MainControllerHelper();
        $filename = "markdown/home.md";
        $parser = $this->createMock(MdParser::class);

        $parser->expects($this->once())
        ->method('getParsedText')
        ->with($filename)
        ->willReturn("Test");

        $exp = [
            'home' => "Test",
            'page' => "home",
            'url' => "/",
        ];
        $res = $helper->homeData($parser);

        $this->assertEquals($exp, $res);
    }

    /**
     * Testa homeData method
     */
    public function testAboutData(): void
    {
        $helper = new MainControllerHelper();
        $filename = "markdown/about.md";
        $parser = $this->createMock(MdParser::class);

        $parser->expects($this->once())
        ->method('getParsedText')
        ->with($filename)
        ->willReturn("Test");

        $exp = [
            'home' => "Test",
            'page' => "about",
            'url' => "/about",
        ];
        $res = $helper->aboutData($parser);

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

    /**
     * Tests that luckyData method returns
     * expected Data
     */
    public function testLuckyData(): void
    {
        $handler = new MainControllerHelper();
        $monkey = <<<EOD
        <img class="monkey" id="monkey" src="img/monkey.png" style="margin-left: 4%; margin-top: 4%;" alt="apa">
        EOD;
        $exp = [
            'page' => "lucky",
            'monkey' => $monkey,
            'url' => "/lucky",
        ];
        $res = $handler->luckyData();
        $this->assertEquals($exp, $res);
    }
}
