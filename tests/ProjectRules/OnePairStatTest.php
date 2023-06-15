<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class OnePairStatTest extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new SameOfAKindStat(2);
        $hand = ["4D", "2C", "8D"];
        $deck = ["2D"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(2);
        $hand = ["4D", "2C", "8D"];
        $deck = ["9D", "4H"];
        $card = "9H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
