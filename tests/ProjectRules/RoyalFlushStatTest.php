<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Royal Flush Stat.
 */
class RoyalFlushStatTest extends TestCase
{
    public function testCheckNotOk(): void
    {
        $hand = ["10D", "11D", "12D", "13D"];
        $card = "14C";
        $deck = ["14D"];

        $rule = new RoyalFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }


    public function testCheckOk(): void
    {
        $hand = ["10D", "11D", "12D", "13D"];
        $card = "14D";
        $deck = ["11C"];

        $rule = new RoyalFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = ["10D", "12D", "13D"];
        $card = "14D";
        $deck = ["11C"];

        $rule = new RoyalFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk2(): void
    {
        $hand = ["10D", "12D", "13D"];
        $card = "14D";
        $deck = ["11D"];

        $rule = new RoyalFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk3(): void
    {
        $hand = [];
        $card = "14D";
        $deck = ["11D","10D", "12D", "13D"];

        $rule = new RoyalFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
