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

        public function testCheckNotOk3(): void
        {
            $hand = ["11C", "13S", "9S", "9C"];
            $card = "10S";
            $deck = [
                "2S", "12H", "2C", "4C",
                "5S", "10D", "14D", "6C"
            ];

            $rule = new StraightStat();
            $res = $rule->check($hand, $deck, $card);
            $this->assertFalse($res);
        }

    public function testCheckNotOk4(): void
    {
        $hand = ["14S", "5D"];
        $card = "6C";
        $deck = [
            "2S",
            "12H",
            "2C",
            "4C",
            "5S",
            "10D",
            "14D"
        ];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk6(): void
    {
        $hand = ["9S", "4D", "3H", "4H"];
        $card = "14D";
        $deck = [
            "2S",
            "12H",
            "2C",
            "4C",
            "5S",
            "10D"
        ];

        $rule = new StraightStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
