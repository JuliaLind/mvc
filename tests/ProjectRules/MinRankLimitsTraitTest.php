<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class MinRankLimitsTraitTest extends TestCase
{
    use MinRankLimitsTrait;

    public function testMinRankLimitsOk(): void
    {
        $minRank = 7;
        $maxRank = 7;
        $exp = [
            'min' => 3,
            'max' => 7
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk2(): void
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

    public function testMinRankLimitsOk3(): void
    {
        $minRank = 7;
        $maxRank = 9;
        $exp = [
            'min' => 5,
            'max' => 7
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk4(): void
    {
        $minRank = 7;
        $maxRank = 10;
        $exp = [
            'min' => 6,
            'max' => 7
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }


    public function testMinRankLimitsOk5(): void
    {
        $minRank = 7;
        $maxRank = 11;
        $exp = [
            'min' => 7,
            'max' => 7
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk6(): void
    {
        $minRank = 14;
        $maxRank = 14;
        $exp = [
            'min' => 10,
            'max' => 10
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }


    public function testMinRankLimitsNotOk(): void
    {
        $minRank = 3;
        $maxRank = 5;
        $exp = [
            'min' => 2,
            'max' => 3
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsNotOk2(): void
    {
        $minRank = 3;
        $maxRank = 4;
        $exp = [
            'min' => 2,
            'max' => 3
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsNotOk3(): void
    {
        $minRank = 12;
        $maxRank = 13;
        $exp = [
            'min' => 9,
            'max' => 10
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsNotOk4(): void
    {
        $minRank = 11;
        $maxRank = 14;
        $exp = [
            'min' => 10,
            'max' => 10
        ];
        $res = $this->minRankLimits($minRank, $maxRank);
        $this->assertEquals($exp, $res);
    }
}
