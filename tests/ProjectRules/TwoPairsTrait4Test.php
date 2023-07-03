<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait4Test extends TestCase
{
    use TwoPairsTrait4;

    public function testCheck1Ok(): void
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
        $rank = 11;
        $res = $this->check1($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals(3, $this->additionalValue);
    }

    public function testCheck1Ok2(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            9 => 1,
        ];

        $rank = 14;
        $res = $this->check1($rank, $ranksHand, $ranksDeck);
        $this->assertTrue($res);
        $this->assertEquals(2, $this->additionalValue);
    }

    public function testCheck1NotOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            9 => 1,
        ];

        $rank = 13;
        $res = $this->check1($rank, $ranksHand, $ranksDeck);
        $this->assertFalse($res);
        $this->assertEquals(0, $this->additionalValue);
    }
}
