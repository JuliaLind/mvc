<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait8Test extends TestCase
{
    use TwoPairsTrait8;

    public function testSubCheck5Ok(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            8 => 1,
            11 => 1
        ];
        $res = $this->subCheck5($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testSubCheckNotOk(): void
    {
        $ranksDeck = [
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
        $res = $this->subCheck5($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testSubCheckNotOk2(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [];
        $res = $this->subCheck5($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
