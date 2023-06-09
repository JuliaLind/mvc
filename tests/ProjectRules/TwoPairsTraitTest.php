<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTraitTest extends TestCase
{
    // use AdditionalValueTrait;
    use CountByRankTrait;
    use TwoPairsTrait;
    use TwoPairsTrait3;
    use TwoPairsTrait8;

    public function testPossibleWithCardNotOk(): void
    {
        $card = "9S";
        $hand = ["8C", "14S", "14H", "10S"];
        $deck = ["4C", "5C", "8S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleWithCardOk(): void
    {
        $card = "8S";
        $hand = ["8C", "14S", "14H", "10S"];
        $deck = ["4C", "5C", "9S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(3, $this->additionalValue);
    }

    public function testPossibleWithCardNotOk2(): void
    {
        $card = "10S";
        $hand = ["8C", "14S", "14H"];
        $deck = ["4C", "5C", "9S", "8S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleWithCardOk2(): void
    {
        $card = "8C";
        $hand = ["3C", "14S", "14H"];
        $deck = ["4C", "5C", "9S", "8S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(2, $this->additionalValue);
    }

    public function testPossibleWithCardNotOk5(): void
    {
        $card = "8C";
        $hand = ["3C", "14S", "9S"];
        $deck = ["4C", "5C", "14H", "8S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
        $this->assertEquals(0, $this->additionalValue);
    }

    public function testPossibleWithCardNotOk3(): void
    {
        $card = "8C";
        $hand = ["3C", "14S", "9S"];
        $deck = ["4C", "5C", "14H", "9D"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleWithCardOk4(): void
    {
        $card = "8C";
        $hand = ["3C", "14S"];
        $deck = ["4C", "5C", "14H", "8S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(1, $this->additionalValue);
    }

    public function testPossibleWithCardOk5(): void
    {
        $card = "14C";
        $hand = ["3C", "14S"];
        $deck = ["4C", "5C", "8H", "8S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(1, $this->additionalValue);
    }

    public function testPossibleWithCardOk6(): void
    {
        $card = "7C";
        $hand = ["6C","13S","7D"];
        $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","6D","14H","14S"];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertTrue($res);
        $this->assertEquals(2, $this->additionalValue);
    }

    public function testPossibleWithCardNotOk4(): void
    {
        $card = "10S";
        $hand = ["6D", "13D", "3H"];
        $deck = [
            "2S", "12H", "2C", "4C",
            "5S", "10D", "14D", "6C"
        ];

        $res = $this->possibleWithCard($hand, $deck, $card);
        $this->assertFalse($res);
    }

}
