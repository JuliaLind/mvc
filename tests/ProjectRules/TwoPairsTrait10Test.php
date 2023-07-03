<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait10Test extends TestCase
{
    use TwoPairsTrait10;

    public function testSubCheck7Ok(): void
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

        $res = $this->subCheck7($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testSubCheck7NotOk(): void
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

        $res = $this->subCheck7($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testSubCheck7NotOk2(): void
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

        $res = $this->subCheck7($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
