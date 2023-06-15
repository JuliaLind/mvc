<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseStatTest extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new FullHouseStat();
        $hand = ["4D", "2C", "8D"];
        $deck = ["4S", "2D", "4C"];
        $card = "8H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk(): void
    {
        $rule = new FullHouseStat();
        $hand = ["4D", "2C", "2D"];
        $deck = ["4S", "5S"];
        $card = "4H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new FullHouseStat();
        $hand = ["4C", "4D", "14D", "14H"];
        $deck = ["14S", "4S"];
        $card = "8H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new FullHouseStat();
        $hand = ["4D", "8D"];
        $deck = ["4S", "2C", "2D"];
        $card = "8H";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
