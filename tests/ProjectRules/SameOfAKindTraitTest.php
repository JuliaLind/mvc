<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTraitTest extends TestCase
{
    use AdditionalValueTrait;
    use CountByRankTrait;
    use SameOfAKindTrait;
    use SameOfAKindTrait4;


    public function testPossibleWithCardOk(): void
    {
        $this->minCountRank = 2;
        $card = "4D";
        $hand = ["9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(0, $this->getAdditionalValue());
    }

    public function testPossibleWithCardOk2(): void
    {
        $this->minCountRank = 2;
        $card = "4D";
        $hand = ["9H", "12C", "13C", "4S"];
        $deck = ["5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(1, $this->getAdditionalValue());
    }

    public function testPossibleWithCardOk3(): void
    {
        $this->minCountRank = 2;
        $card = "4D";
        $hand = ["4S"];
        $deck = ["5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(1, $this->getAdditionalValue());
    }

    public function testPossibleWithCardOk4(): void
    {
        $this->minCountRank = 2;
        $card = "4D";
        $hand = [];
        $deck = ["5S", "8S", "3H", "4S"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(0, $this->getAdditionalValue());
    }

    public function testPossibleWithCardNotOk(): void
    {
        $this->minCountRank = 3;
        $card = "4D";
        $hand = ["9H", "12C", "13C"];
        $deck = ["4S", "5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleWithCardNotOk2(): void
    {
        $this->minCountRank = 3;
        $card = "4D";
        $hand = ["9H", "12C", "13C", "4H"];
        $deck = ["4S", "5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleWithCardNotOk3(): void
    {
        $this->minCountRank = 3;
        $card = "4D";
        $hand = ["9H","4H"];
        $deck = ["9S", "5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleWithCardOk5(): void
    {
        $this->minCountRank = 4;
        $card = "4D";
        $hand = ["4S", "4C", "4H", "9C"];
        $deck = ["5S", "8S", "3H"];
        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(3, $this->getAdditionalValue());
    }
}
