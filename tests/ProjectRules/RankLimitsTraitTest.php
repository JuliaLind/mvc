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
        $ranks = [8, 9, 11, 17];
        $res = $this->setRankLimits($ranks);
        $this->assertFalse($res);
    }
}
