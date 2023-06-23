<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FourOfAKindStat2Test extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4D", "5H", "4C", "5S"];
        $deck = ["5C"];
        $card = "8H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4D", "5H", "4C", "4S"];
        $deck = ["14H"];
        $card = "5H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4D", "4C", "5S"];
        $deck = ["14H"];
        $card = "5H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk4(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4D", "4C", "5S"];
        $deck = ["14H"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk5(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [];
        $deck = ["4S", "4D", "14D", "4C", "4H"];
        $card = "5S";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk6(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = ["4S", "7S"];
        $deck = ["8S", "4D", "14D", "4C", "4H"];
        $card = "5S";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
