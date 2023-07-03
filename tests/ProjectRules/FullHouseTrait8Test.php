<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait8Test extends TestCase
{
    use FullHouseTrait8;


    public function testSubCheck3Ok(): void
    {
        $ranksHand = [
            4 => 3,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 2,
        ];

        $res = $this->subCheck3($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testSubCheck3Ok2(): void
    {
        $ranksHand = [
            4 => 2,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 3,
        ];

        $res = $this->subCheck3($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testSubCheckOk3(): void
    {
        $ranksHand = [
            4 => 3,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 3,
        ];

        $res = $this->subCheck3($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testSubCheck3NotOk(): void
    {
        $ranksHand = [
            2 => 1,
            4 => 3,
        ];

        $ranksDeck = [
            4 => 2,
            5 => 1,
        ];

        $res = $this->subCheck3($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testSubCheck3NotOk2(): void
    {
        $ranksHand = [
            4 => 4,
        ];

        $ranksDeck = [
            4 => 2,
            5 => 1,
        ];

        $res = $this->subCheck3($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testSubCheck3NotOk3(): void
    {
        $ranksHand = [
            4 => 2,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 2,
        ];

        $res = $this->subCheck3($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
