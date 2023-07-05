<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightTrait3Test extends TestCase
{
    use StraightTrait3;

    public function testCheckAllPoissbleOk(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 12, 13];
        $minMinRank = 7;
        $maxMinRank = 9;
        $res = $this->checkAllPossible($ranks, $minMinRank, $maxMinRank);
        $this->assertTrue($res);
    }

    public function testCheckAllPoissbleNotOk(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 12, 13];
        $minMinRank = 10;
        $maxMinRank = 10;
        $res = $this->checkAllPossible($ranks, $minMinRank, $maxMinRank);
        $this->assertFalse($res);
    }

    public function testCheckAllPoissbleOk2(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 12, 13];
        $minMinRank = 5;
        $maxMinRank = 9;
        $res = $this->checkAllPossible($ranks, $minMinRank, $maxMinRank);
        $this->assertTrue($res);
    }

    public function testCheckAllPoissbleNotOk2(): void
    {
        $ranks = [4, 6, 7, 9, 10, 12, 13, 14];
        $minMinRank = 4;
        $maxMinRank = 9;
        $res = $this->checkAllPossible($ranks, $minMinRank, $maxMinRank);
        $this->assertFalse($res);
    }
}
