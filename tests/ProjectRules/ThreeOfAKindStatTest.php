<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class ThreeOfAKindStatTest extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4D", "2C", "8D"];
        $deck = ["4S", "2D"];
        $card = "8H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4D", "2C", "5S", "2D"];
        $deck = ["4S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4C", "4D", "14D", "14H"];
        $deck = ["14S", "4S"];
        $card = "8H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheck3Ok(): void
    {
        $deck = ["14C", "8C", "8D", "8H", "7C"];

        $rule = new SameOfAKindStat(3);
        $res = $rule->check3($deck);
        $this->assertTrue($res);
    }
}
