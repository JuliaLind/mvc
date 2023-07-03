<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait4Test extends TestCase
{
    use TwoPairsTrait4;

    public function testSubCheckOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            8 => 1,
            11 => 1
        ];
        $hand = ["4H", "8H", "4S", "11C"];
        $rank = 11;
        $res = $this->subCheck($hand, $rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals(3, $this->additionalValue);
    }

    public function testSubCheckOk2(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            9 => 1,
        ];
        $hand = ["4H", "9H", "4S"];
        $rank = 14;
        $res = $this->subCheck($hand, $rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals(2, $this->additionalValue);
    }

    public function testSubCheckNotOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            9 => 1,
        ];
        $hand = ["4H", "9H", "4S"];
        $rank = 13;
        $res = $this->subCheck($hand, $rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
        $this->assertEquals(0, $this->additionalValue);
    }
}
