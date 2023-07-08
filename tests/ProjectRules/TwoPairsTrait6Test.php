<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait6Test extends TestCase
{
    use TwoPairsTrait6;
    use TwoPairsTrait8;

    public function testCheck3Ok(): void
    {
        $rank = 4;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1
        ];

        $ranksDeck = [
            3 => 1,
            8 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck3NotOk4(): void
    {
        $rank = 3;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1
        ];

        $ranksDeck = [
            3 => 1,
            8 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck3NotOk2(): void
    {
        $rank = 4;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1
        ];

        $ranksDeck = [
            3 => 1,
            5 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck3NotOk3(): void
    {
        $rank = 4;
        $ranksHand = [
            4 => 1,
            6 => 1,
            8 => 1,
            9 => 1
        ];

        $ranksDeck = [
            3 => 1,
            5 => 1,
            6 => 1
        ];

        $res = $this->check3($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
