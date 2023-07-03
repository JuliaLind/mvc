<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class MinRankLimitsTraitTest extends TestCase
{
    use MinRankLimitsTrait;



    public function testMinRankLimitsOk(): void
    {
        $this->minRank = 7;
        $this->maxRank = 7;
        $exp = [
            'min' => 3,
            'max' => 7
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk2(): void
    {
        $this->minRank = 7;
        $this->maxRank = 8;
        $exp = [
            'min' => 4,
            'max' => 7
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk3(): void
    {
        $this->minRank = 7;
        $this->maxRank = 9;
        $exp = [
            'min' => 5,
            'max' => 7
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk4(): void
    {
        $this->minRank = 7;
        $this->maxRank = 10;
        $exp = [
            'min' => 6,
            'max' => 7
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }


    public function testMinRankLimitsOk5(): void
    {
        $this->minRank = 7;
        $this->maxRank = 11;
        $exp = [
            'min' => 7,
            'max' => 7
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsOk6(): void
    {
        $this->minRank = 14;
        $this->maxRank = 14;
        $exp = [
            'min' => 10,
            'max' => 10
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }


    public function testMinRankLimitsNotOk(): void
    {
        $this->minRank = 3;
        $this->maxRank = 5;
        $exp = [
            'min' => 2,
            'max' => 3
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsNotOk2(): void
    {
        $this->minRank = 3;
        $this->maxRank = 4;
        $exp = [
            'min' => 2,
            'max' => 3
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsNotOk3(): void
    {
        $this->minRank = 12;
        $this->maxRank = 13;
        $exp = [
            'min' => 9,
            'max' => 10
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }

    public function testMinRankLimitsNotOk4(): void
    {
        $this->minRank = 11;
        $this->maxRank = 14;
        $exp = [
            'min' => 10,
            'max' => 10
        ];
        $res = $this->minRankLimits();
        $this->assertEquals($exp, $res);
    }


    // public function testSetRankLimitsNotOk(): void
    // {
    //     $cards = ["14H", "8D", "4C", "14S"];
    //     $res = $this->setRankLimits($cards);
    //     $this->assertFalse($res);
    // }

    // public function testSetRankLimitsNotOk2(): void
    // {
    //     $cards = ["14H", "9D", "11S"];
    //     $res = $this->setRankLimits($cards);
    //     $this->assertFalse($res);
    // }

}
