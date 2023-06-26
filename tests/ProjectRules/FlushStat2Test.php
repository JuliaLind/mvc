<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushStat2Test extends TestCase
{
    public function testCheck2Ok(): void
    {
        $rule = new FlushStat();
        $hand = ["4D", "2D", "8D"];
        $deck = ["7D", "3D"];
        $res = $rule->check2($hand, $deck);
        $this->assertTrue($res);
    }

    public function testCheck2NotOk(): void
    {
        $rule = new FlushStat();
        $hand = ["4D", "2D", "8D"];
        $deck = ["4S", "3D"];
        $res = $rule->check2($hand, $deck);
        $this->assertFalse($res);
    }

    public function testCheck3Ok(): void
    {
        $rule = new FlushStat();
        $deck = ["4D", "3D", "7D", "2D", "8D"];
        $res = $rule->check3($deck);
        $this->assertTrue($res);
    }

    public function testCheck2NotOk2(): void
    {
        $rule = new FlushStat();
        $hand = ["3H"];
        $deck = ["4D", "3D", "7D", "2D", "8D"];
        $res = $rule->check2($hand, $deck);
        $this->assertFalse($res);
    }
}
