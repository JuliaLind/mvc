<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait5Pt2Test extends TestCase
{
    use FullHouseTrait5;


    public function testCheck1SubCheckOk(): void
    {
        $countHand = 2;
        $rank = 10;

        $ranksDeck = [
            5 => 3,
            9 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck1SubCheckOk2(): void
    {
        $countHand = 2;
        $rank = 10;

        $ranksDeck = [
            5 => 2,
            10 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck1SubCheckNotOk(): void
    {
        $countHand = 2;
        $rank = 10;

        $ranksDeck = [
            5 => 2,
            9 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck1SubCheckNotOk2(): void
    {
        $countHand = 2;
        $rank = 10;

        $ranksDeck = [
            5 => 1,
            10 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testCheck1SubCheckOk3(): void
    {
        $countHand = 3;
        $rank = 10;

        $ranksDeck = [
            5 => 2,
            9 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck1SubCheckOk4(): void
    {
        $countHand = 3;
        $rank = 11;

        $ranksDeck = [
            5 => 2,
            9 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testCheck1SubCheckNotOk3(): void
    {
        $countHand = 3;
        $rank = 10;

        $ranksDeck = [
            5 => 1,
            9 => 1,
        ];

        $res = $this->check1SubCheck($countHand, $rank, $ranksDeck);
        $this->assertFalse($res);
    }
}
