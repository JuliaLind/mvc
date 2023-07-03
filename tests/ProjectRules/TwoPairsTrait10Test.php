<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait10Test extends TestCase
{
    use TwoPairsTrait10;

    public function testOneCardTwoPairsOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 2
        ];
        $ranksHand = [
            8 => 1,
        ];

        $res = $this->oneCardTwoPairs($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testOneCardTwoPairsNotOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            8 => 1,
        ];

        $res = $this->oneCardTwoPairs($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testOneCardTwoPairsNotOk2(): void
    {
        $ranksDeck = [
            5 => 1,
            9 => 1,
            10 => 1,
            14 => 2
        ];
        $ranksHand = [
            8 => 1,
        ];

        $res = $this->oneCardTwoPairs($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
