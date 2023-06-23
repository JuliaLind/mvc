<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FourOfAKindStat1Test extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4D", "5H", "4C", "4S"];
        $deck = [];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk2(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4D", "4C", "4S"];
        $deck = ["4S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk3(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4C", "5S"];
        $deck = ["4S", "4D", "14D"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [];
        $deck = ["4S", "4D", "14D", "4C", "5S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4S"];

        $deck = ["8S", "4D", "14D", "4C", "4H", "7S"];
        $card = "5S";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4S"];
        $deck = ["8S", "5D", "14D", "5C", "5H", "7S"];
        $card = "5S";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
