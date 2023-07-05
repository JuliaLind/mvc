<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait7Test extends TestCase
{
    use TwoPairsTrait7;


    public function testFourCardsTwoPairsOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 2,
        ];
        $res = $this->fourCardsTwoPairs($ranksHand);
        $this->assertTrue($res);
    }

    public function testFourCardsTwoPairsNotOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $res = $this->fourCardsTwoPairs($ranksHand);
        $this->assertFalse($res);
    }

    public function testFindSecondPairOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 2,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1
        ];

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testFindSecondPairOk2(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $ranksDeck = [
            6 => 1,
            7 => 1
        ];


        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testFindSecondPairOk3(): void
    {
        $ranksHand = [
            4 => 2,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1,
            9 => 2
        ];

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testFindSecondPairOk4(): void
    {
        $ranksHand = [
            4 => 2,
        ];
        $ranksDeck = [
            3 => 1,
            7 => 1
        ];

        $res = $this->findSecondPair($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
