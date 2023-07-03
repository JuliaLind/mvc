<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTrait3Test extends TestCase
{
    use SameOfAKindTrait3;
    use CountByRankTrait;

    public function testPossibleDeckOnlyOk(): void
    {
        $this->minCountRank = 2;
        $deck = ["4S", "5S", "8S", "4D", "3H"];
        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }

    public function testPossibleDeckOnlyNotOk(): void
    {
        $this->minCountRank = 2;
        $deck = ["4S", "5S", "8S", "9D", "3H"];
        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyNotOk2(): void
    {
        $this->minCountRank = 3;
        $deck = ["4S", "5S", "8S", "4D", "3H"];

        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyOk4(): void
    {
        $this->minCountRank = 3;
        $deck = ["4S", "5S", "8S", "4D", "4H"];
        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }

    public function testPossibleDeckOnlyNotOk3(): void
    {
        $this->minCountRank = 4;
        $deck = ["4S", "5S", "8S", "4D", "4H"];
        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyOk6(): void
    {
        $this->minCountRank = 4;
        $deck = ["4S", "5S", "4C", "4D", "4H"];
        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }
}
