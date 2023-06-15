<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightStatTest extends TestCase
{
    public function testCheckOk3(): void
    {
        $hand = ["9D", "10D", "11D", "13D"];
        $card = "12D";
        $deck = ["8C"];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk4(): void
    {
        $hand = ["10D", "11D", "13D"];
        $card = "9C";
        $deck = ["8C", "12D"];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }


    public function testCheckNotOk5(): void
    {
        $hand = ["10D", "11D", "13D", "6D"];
        $card = "9C";
        $deck = ["8C", "12D"];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }


    public function testCheckOk(): void
    {
        $hand = ["10D", "11D", "12D", "13D"];
        $card = "9C";
        $deck = ["9D"];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = ["10D", "12D", "13D"];
        $card = "9D";
        $deck = ["8C"];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
