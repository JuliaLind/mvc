<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectCard\CardCounter;

class RankLimitsTraitTest extends TestCase
{
    use RankLimitsTrait;


    // protected function setUp(): void
    // {
    //     $this->maxRank = 1;
    //     $this->minRank = 15;
    // }

    public function testSetRankLimitsOk(): void
    {
        $ranks = [8, 9, 11];
        $res = $this->setRankLimits($ranks);
        $this->assertTrue($res);
        $this->assertEquals(8, $this->minRank);
        $this->assertEquals(11, $this->maxRank);
    }

    public function testSetRankLimitsNotOk(): void
    {
        $ranks = [4, 9, 11, 14];
        $res = $this->setRankLimits($ranks);
        $this->assertFalse($res);
    }

    public function testMinRankLimits(): void
    {
        $ranks = [3, 4, 5];
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
        $ranks = [11, 14];
        $this->setRankLimits($ranks);
        $res = $this->minRankLimits();
        $exp = [
            'min' => 10,
            'max' => 10
        ];
        $this->assertEquals($exp, $res);
    }
}
