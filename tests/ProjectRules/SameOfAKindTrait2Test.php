<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTrait2Test extends TestCase
{
    use CountByRankTrait;
    use SameOfAKindTrait2;
    use SameOfAKindTrait4;


    public function testPossibleWithoutCardOk(): void
    {
        $this->minCountRank = 2;
        $hand = ["4D", "9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "3H"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk2(): void
    {
        $this->minCountRank = 2;
        $hand = ["9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "3H", "4D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk(): void
    {
        $this->minCountRank = 2;
        $hand = ["9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "3H"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk2(): void
    {
        $this->minCountRank = 3;
        $hand = ["9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "4H", "4D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk3(): void
    {
        $this->minCountRank = 3;
        $hand = ["9H", "13C"];
        $deck = ["4S", "5S", "8S", "4H", "4D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk3(): void
    {
        $this->minCountRank = 3;
        $hand = ["9H", "12C", "13C", "4S"];
        $deck = ["5S", "8S", "4H", "4D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk4(): void
    {
        $this->minCountRank = 4;
        $hand = ["9H", "4S"];
        $deck = ["5S", "8S", "4H", "4D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk4(): void
    {
        $this->minCountRank = 4;
        $hand = ["9H", "4S"];
        $deck = ["4C", "8S", "4H", "4D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk5(): void
    {
        $this->minCountRank = 4;
        $hand = ["9H"];
        $deck = ["4C", "8S", "4H", "4D", "4S"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk5(): void
    {
        $this->minCountRank = 4;
        $hand = ["9H", "4H", "9C"];
        $deck = ["4C", "8S", "4D", "4S"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }
}
