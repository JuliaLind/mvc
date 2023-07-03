<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait5Test extends TestCase
{
    use TwoPairsTrait5;

    public function testCheckForTwoPairs1Ok(): void
    {
        $rank = 6;
        $ranksHand = [
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 2
        ];
        $res = $this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheckForTwoPairs1Ok2(): void
    {
        $rank = 6;
        $ranksHand = [
            6 => 1,
            8 => 1
        ];
        $ranksDeck = [
            3 => 1,
            7 => 2
        ];
        $res = $this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheckForTwoPairs1NotOk(): void
    {
        $rank = 3;
        $ranksHand = [
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 2
        ];
        $res = $this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheckForTwoPairs1NotOk2(): void
    {
        $rank = 3;
        $ranksHand = [
            3 => 1,
        ];
        $ranksDeck = [
            8 => 1,
            7 => 1
        ];
        $res = $this->checkForTwoPairs1($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheckForTwoPairs2Ok(): void
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
        $res = $this->checkForTwoPairs2($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheckForTwoPairs2NotOk(): void
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
        $res = $this->checkForTwoPairs2($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheckForTwoPairs2NotOk2(): void
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
        $res = $this->checkForTwoPairs2($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck2NotOk(): void
    {
        $rank = 6;
        $ranksHand = [
            2 => 1,
            6 => 1
        ];
        $ranksDeck = [
            4 => 1,
            7 => 1,
            8 => 1
        ];
        $res = $this->check2($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck2NotOk2(): void
    {
        $rank = 6;
        $ranksHand = [
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1,
            8 => 1
        ];
        $res = $this->check2($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck2NotOk3(): void
    {
        $rank = 6;
        $ranksHand = [
            2 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 2,
            8 => 1
        ];
        $res = $this->check2($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
