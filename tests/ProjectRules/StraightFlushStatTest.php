<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightFlushStatTest extends TestCase
{
    public function testCheckOk3(): void
    {
        $hand = ["9D", "10D", "11D", "13D"];
        $card = "12D";
        $deck = ["8C"];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk4(): void
    {
        $hand = ["10D", "11D", "13D"];
        $card = "9D";
        $deck = ["8C", "12D"];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk4(): void
    {
        $hand = ["10D", "11D", "13D"];
        $card = "9C";
        $deck = ["8C", "12D"];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }


    public function testCheckNotOk(): void
    {
        $hand = ["10D", "11D" ,"12D", "13D"];
        $card = "9C";
        $deck = ["9D"];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk(): void
    {
        $hand = ["10D", "11D", "12D", "13D"];
        $card = "9D";
        $deck = ["9C"];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = ["10D", "12D", "13D"];
        $card = "9D";
        $deck = ["8C"];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
