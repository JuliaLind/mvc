<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait14Test extends TestCase
{
    use TwoPairsTrait14;

    public function testThreeCardsTwoPairsNotOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            4 => 1
        ];
        $res = $this->threeCardsTwoPairs($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testThreeCardsTwoPairsOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $ranksDeck = [
            3 => 1,
            6 => 1
        ];
        $res = $this->threeCardsTwoPairs($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testThreeCardsTwoPairsOk2(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $ranksDeck = [
            3 => 2,
            7 => 1
        ];
        $res = $this->threeCardsTwoPairs($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testThreeCardsTwoPairsOk3(): void
    {
        $ranksHand = [
            4 => 2,
        ];
        $ranksDeck = [
            3 => 2,
            7 => 1
        ];
        $res = $this->threeCardsTwoPairs($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }
}
