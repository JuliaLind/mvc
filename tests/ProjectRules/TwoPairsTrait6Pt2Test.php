<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait6Pt2Test extends TestCase
{
    use TwoPairsTrait6;
    use TwoPairsTrait8;

    public function testCheck3Ok(): void
    {
        $rank = 6;
        $ranksHand = [
            7 => 1,
        ];
        $ranksDeck = [
            6 => 1,
            7 => 1,
            8 => 1
        ];
        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck3NotOk(): void
    {
        $rank = 5;
        $ranksHand = [
            7 => 1,
        ];
        $ranksDeck = [
            6 => 1,
            7 => 1,
            8 => 1
        ];
        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck3NotOk2(): void
    {
        $rank = 6;
        $ranksHand = [
            2 => 1,
        ];
        $ranksDeck = [
            6 => 1,
            7 => 1,
            8 => 1
        ];
        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
