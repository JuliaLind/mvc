<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait5Test extends TestCase
{
    use FullHouseTrait5;


    public function testCheck1Ok(): void
    {
        $ranksHand = [
            4 => 3,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 2,
        ];

        $res = $this->check1($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck1Ok2(): void
    {
        $ranksHand = [
            4 => 2,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 3,
        ];

        $res = $this->check1($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testcheck1Ok3(): void
    {
        $ranksHand = [
            4 => 3,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 3,
        ];

        $res = $this->check1($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testcheck1NotOk(): void
    {
        $ranksHand = [
            2 => 1,
            4 => 3,
        ];

        $ranksDeck = [
            4 => 2,
            5 => 1,
        ];

        $res = $this->check1($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testcheck1NotOk2(): void
    {
        $ranksHand = [
            4 => 4,
        ];

        $ranksDeck = [
            4 => 2,
            5 => 1,
        ];

        $res = $this->check1($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testcheck1NotOk3(): void
    {
        $ranksHand = [
            4 => 2,
        ];

        $ranksDeck = [
            5 => 1,
            10 => 2,
        ];

        $res = $this->check1($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
