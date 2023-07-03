<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait6Test extends TestCase
{
    use FullHouseTrait6;


    public function testCheck2Ok(): void
    {
        $ranksHand = [
            4 => 3,
            10 => 2
        ];
        $res = $this->check2($ranksHand);
        $this->assertTrue($res);
    }

    public function testCheck2NotOk(): void
    {
        $ranksHand = [
            4 => 4,
        ];
        $res = $this->check2($ranksHand);
        $this->assertFalse($res);
    }

    public function testCheck2Ok2(): void
    {
        $ranksHand = [
            2 => 3,
            4 => 1,
        ];
        $res = $this->check2($ranksHand);
        $this->assertTrue($res);
    }

    public function testCheck2NotOk2(): void
    {
        $ranksHand = [
            2 => 2,
            4 => 1,
            10 => 2
        ];
        $res = $this->check2($ranksHand);
        $this->assertFalse($res);
    }

    public function testCheck2NotOk3(): void
    {
        $ranksHand = [
            2 => 3,
            4 => 1,
            10 => 1
        ];
        $res = $this->check2($ranksHand);
        $this->assertFalse($res);
    }

    public function testCheck2NotOk4(): void
    {
        $ranksHand = [
            2 => 3,
            3 => 2,
            4 => 1,
            10 => 1
        ];
        $res = $this->check2($ranksHand);
        $this->assertFalse($res);
    }
}
