<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsStatTrait9Test extends TestCase
{
    use TwoPairsStatTrait9;

    public function testSubCheckOk(): void
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
        $res = $this->subCheck6($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testSubCheckNotOk(): void
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
        $res = $this->subCheck6($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testSubCheckNotOk2(): void
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
        $res = $this->subCheck6($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
