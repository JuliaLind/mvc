<?php

namespace App\Helpers;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class LuckyRouteDataTest class.
 */
class LuckyRouteDataTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $helper = new LuckyRouteData();
        $this->assertInstanceOf("\App\Helpers\LuckyRouteData", $helper);
    }

    /**
     * Tests that luckyData method returns
     * expected Data
     */
    public function testLuckyData(): void
    {
        $helper = new LuckyRouteData();
        $monkey = <<<EOD
        <img class="monkey" id="monkey" src="img/monkey.png" style="margin-left: 4%; margin-top: 4%;" alt="apa">
        EOD;
        $exp = [
            'page' => "lucky",
            'monkey' => $monkey,
            'url' => "/lucky",
        ];
        $res = $helper->luckyData();
        $this->assertEquals($exp, $res);
    }
}
