<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait9Test extends TestCase
{
    use TwoPairsTrait9;

    public function testThreeCardsTwoPairsAltOk(): void
    {
        $ranksDeck = [
            4 => 1,
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 1,
            8 => 1,
            11 => 1
        ];
        $res = $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testThreeCardsTwoPairsAltNotOk(): void
    {
        $ranksDeck = [
            4 => 1,
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 1,
            9 => 1,
            11 => 1
        ];
        $res = $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testThreeCardsTwoPairsAltNotOk2(): void
    {
        $ranksDeck = [
            4 => 1,
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            9 => 1,
            11 => 1,
            13 => 1
        ];
        $res = $this->threeCardsTwoPairsAlt($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
