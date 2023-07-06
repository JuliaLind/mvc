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

    public function testMatchRankOk(): void
    {
        $rank = 6;
        $ranksHand = [
            2 => 1,
        ];
        $ranksDeck = [
            6 => 1,
            2 => 1,
            8 => 1
        ];
        $res = $this->matchRank($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals(1, $this->additionalValue);
    }

    public function testMatchRankOk2(): void
    {
        $rank = 6;
        $ranksHand = [
            2 => 1,
            6 => 1,
        ];
        $ranksDeck = [
            7 => 1,
            8 => 1
        ];
        $res = $this->matchRank($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals(2, $this->additionalValue);
    }
}
