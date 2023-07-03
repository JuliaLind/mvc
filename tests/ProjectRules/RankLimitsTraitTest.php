<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RankLimitsTraitTest extends TestCase
{
    use RankLimitsTrait;
    use CountByRankTrait;


    public function testSetRankLimitsOk(): void
    {
        $cards = ["14H", "12D", "10C", "13C"];
        $res = $this->setRankLimits($cards);
        $this->assertTrue($res);
        $this->assertEquals(10, $this->minRank);
        $this->assertEquals(14, $this->maxRank);
    }

    public function testSetRankLimitsNotOk(): void
    {
        $cards = ["14H", "8D", "4C", "14S"];
        $res = $this->setRankLimits($cards);
        $this->assertFalse($res);
    }

    public function testSetRankLimitsNotOk2(): void
    {
        $cards = ["14H", "9D", "11S"];
        $res = $this->setRankLimits($cards);
        $this->assertFalse($res);
    }

}
