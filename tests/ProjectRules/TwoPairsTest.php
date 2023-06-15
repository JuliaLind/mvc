<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = ["4D", "4H", "5D", "5H"];
        $rule = new TwoPairs();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = ["4D", "4C", "4H"];

        $rule = new TwoPairs();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
