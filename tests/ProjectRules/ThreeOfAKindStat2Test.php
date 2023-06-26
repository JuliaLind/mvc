<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class ThreeOfAKindStat2Test extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4D", "2C"];
        $deck = ["4S", "4H"];
        $card = "5H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk2(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4D", "2C", "5S"];
        $deck = ["2D", "4S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk3(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4C"];
        $deck = ["4S", "4D", "14D", "5S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = [];
        $deck = ["4S", "4D", "14D", "5C", "5H", "4S", "5S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk5(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4D", "4H", "5D"];
        $deck = ["4S", "4C", "5C"];
        $card = "5H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk6(): void
    {
        $rule = new SameOfAKindStat(3);
        $hand = ["4D", "4H", "5D", "8C"];
        $deck = ["4S", "5C"];
        $card = "4C";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }


    public function testCheckOk7(): void
    {
        $hand = [];
        $card = "14D";
        $deck = ["11D","14H", "12D", "14C"];

        $rule = new SameOfAKindStat(3);
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk8(): void
    {
        $deck = ["11D","14H", "12D", "14C", "14D"];

        $rule = new SameOfAKindStat(3);
        $res = $rule->check3($deck);
        $this->assertTrue($res);
    }
}
