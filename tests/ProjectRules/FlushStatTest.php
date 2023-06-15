<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushStatTest extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new FlushStat();
        $hand = ["4D", "2D", "8D"];
        $deck = ["4S", "3D"];
        $card = "9D";
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $rule = new FlushStat();
        $hand = ["4D", "2D"];
        $deck = ["4S", "3D", "8C"];
        $card = "9D";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new FlushStat();
        $hand = ["4D", "2D"];
        $deck = ["4S", "3D", "8D"];
        $card = "9C";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new FlushStat();
        $hand = ["4D", "2D"];
        $deck = ["4S", "3H", "8C"];
        $card = "9D";
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
