<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class MinRankLimitsTrait2Test extends TestCase
{
    use MinRankLimitsTrait;

    public function testMinRankLimitsOk(): void
    {
        $minRank = 7;
        $maxRank = 8;
        $exp = [
            'min' => 4,
            'max' => 7
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }
}
