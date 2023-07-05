<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RoyalFlushTraitTest extends TestCase
{
    use RoyalFlushTrait;
    use CountSuitAndRankTrait;


    public function testPossibleWithoutCardNotOk3(): void
    {
        $hand = [
            "10S",
            "11C",
            "12D",
            "13D"
        ];
        $deck = [
            "6C",
            "6D",
            "9D",
            "10S",
            "12H",
            "14H",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk(): void
    {
        $hand = [
            "10D",
            "11D",
            "13D",
            "12D"
        ];
        $deck = [
            "5D",
            "9D",
            "10S",
            "11D",
            "14D",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk5(): void
    {
        $hand = [
            "10D",
            "9D",
            "8D",
            "7D"
        ];
        $deck = [
            "6C",
            "6D",
            "9D",
            "10S",
            "11C",
            "14H",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk2(): void
    {
        $hand = [
            "12D",
            "14D",
            "11D",
            "10D"
        ];
        $deck = [
            "6C",
            "6D",
            "13D",
            "10S",
            "11C",
            "14H",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }


    public function testPossibleWithoutCardNotOk(): void
    {
        $hand = [
            "13D",
            "9D"
        ];
        $deck = [
            "6C",
            "6D",
            "10D",
            "10S",
            "12D",
            "11D",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }
}
