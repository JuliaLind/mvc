<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait7Test extends TestCase
{
    use FullHouseTrait7;


    public function testSubCheck2Ok(): void
    {
        $ranksHand = [
            4 => 3,
            10 => 2
        ];
        $res = $this->subCheck2($ranksHand);
        $this->assertTrue($res);
    }

    public function testSubCheck2NotOk(): void
    {
        $ranksHand = [
            4 => 4,
        ];
        $res = $this->subCheck2($ranksHand);
        $this->assertFalse($res);
    }

    public function testSubCheck2Ok2(): void
    {
        $ranksHand = [
            2 => 3,
            4 => 1,
        ];
        $res = $this->subCheck2($ranksHand);
        $this->assertTrue($res);
    }

    public function testSubCheck2NotOk2(): void
    {
        $ranksHand = [
            2 => 2,
            4 => 1,
            10 => 2
        ];
        $res = $this->subCheck2($ranksHand);
        $this->assertFalse($res);
    }

    public function testSubCheck2NotOk3(): void
    {
        $ranksHand = [
            2 => 3,
            4 => 1,
            10 => 1
        ];
        $res = $this->subCheck2($ranksHand);
        $this->assertFalse($res);
    }

    public function testSubCheck2NotOk4(): void
    {
        $ranksHand = [
            2 => 3,
            3 => 2,
            4 => 1,
            10 => 1
        ];
        $res = $this->subCheck2($ranksHand);
        $this->assertFalse($res);
    }
}
