<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

use App\ProjectCard\CardCounter;

class RankLimitsTraitTest extends TestCase
{
    use RankLimitsTrait;

    public function testSetRankLimitsOk(): void
    {
        $ranks = ['ranks' => [8 => 1, 9 => 1, 11 => 1]];
        $res = $this->setRankLimits($ranks);
        $this->assertTrue($res);
        $this->assertEquals(8, $this->minRank);
        $this->assertEquals(11, $this->maxRank);
    }

    public function testSetRankLimitsNotOk(): void
    {
        $ranks = ['ranks' => [4 => 1, 9 => 1, 11 => 1, 14 => 1]];
        $res = $this->setRankLimits($ranks);
        $this->assertFalse($res);
    }

    public function testMinRankLimits(): void
    {
        $ranks = ['ranks' => [3 => 2, 4 => 3, 5 => 1]];
        $this->setRankLimits($ranks);
        $res = $this->minRankLimits();
        $exp = [
            'min' => 2,
            'max' => 3
        ];
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimits2(): void
    {
        $ranks = ['ranks' => [11 => 1, 14 => 4]];
        $this->setRankLimits($ranks);
        $res = $this->minRankLimits();
        $exp = [
            'min' => 10,
            'max' => 10
        ];
        $this->assertEquals($exp, $res);
    }
}
