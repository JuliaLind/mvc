<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait15Test extends TestCase
{
    use TwoPairsTrait15;
    use TwoPairsTrait8;

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
}
