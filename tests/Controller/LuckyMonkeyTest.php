<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class LuckyRouteDataTest class.
 */
class LuckyMonkeyTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $helper = new LuckyMonkey();
        $this->assertInstanceOf("\App\Controller\LuckyMonkey", $helper);
    }

    /**
     * Tests that luckyData method returns
     * expected Data
     */
    public function testData(): void
    {
        $monkey = new LuckyMonkey();
        $img = <<<EOD
        <img class="monkey" id="monkey" src="img/monkey.png" style="margin-left: 4%; margin-top: 4%;" alt="apa">
        EOD;
        $exp = [
            'page' => "lucky",
            'monkey' => $img,
            'url' => "/lucky",
        ];
        $res = $monkey->data();
        $this->assertEquals($exp, $res);
    }
}
