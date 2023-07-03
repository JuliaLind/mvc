<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightTrait2Test extends TestCase
{
    use StraightTrait2;

    public function testCheckForRanksOk(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 12, 13];
        $minRank = 9;
        $res = $this->checkForRanks($ranks, $minRank);
        $this->assertTrue($res);
    }

    public function testCheckForRanksNotOk(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 12, 13];
        $minRank = 10;
        $res = $this->checkForRanks($ranks, $minRank);
        $this->assertFalse($res);
    }

    public function testCheckForRanksNotOk2(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 12, 13];
        $minRank = 7;
        $res = $this->checkForRanks($ranks, $minRank);
        $this->assertFalse($res);
    }

    public function testCheckForRanksNotOk3(): void
    {
        $ranks = [4, 6, 7, 9, 10, 11, 13, 14];
        $minRank = 9;
        $res = $this->checkForRanks($ranks, $minRank);
        $this->assertFalse($res);
    }
}
