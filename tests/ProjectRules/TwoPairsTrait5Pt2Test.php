<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait5Pt2Test extends TestCase
{
    use TwoPairsTrait5;

    public function testCheck2Ok(): void
    {
        $rank = 6;
        $ranksHand = [
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 2,
            8 => 1
        ];
        $res = $this->check2($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck2Ok2(): void
    {
        $rank = 6;
        $ranksHand = [
            2 => 1,
        ];
        $ranksDeck = [
            6 => 1,
            7 => 2,
            8 => 1
        ];
        $res = $this->check2($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheckForTwoPairs3Ok(): void
    {
        $rank = 6;
        $ranksDeck = [
            6 => 1,
            7 => 2,
            8 => 1
        ];
        $res = $this->checkForTwoPairs3($rank, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheckForTwoPairs3NotOk(): void
    {
        $rank = 4;
        $ranksDeck = [
            6 => 1,
            7 => 2,
            8 => 1
        ];
        $res = $this->checkForTwoPairs3($rank, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheckForTwoPairs3NotOk2(): void
    {
        $rank = 6;
        $ranksDeck = [
            6 => 1,
            7 => 1,
            8 => 1
        ];
        $res = $this->checkForTwoPairs3($rank, $ranksDeck);
        $this->assertFalse($res);
    }
}
