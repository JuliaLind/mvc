<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightFlushTraitTest extends TestCase
{
    use StraightFlushTrait;
    use StraightTrait3;
    use GroupBySuitTrait;


    public function testPossibleWithoutCardNotOk3(): void
    {
        $hand = [
            "10S",
            "9C",
            "8D",
            "7D"
        ];
        $deck = [
            "6C",
            "6D",
            "9D",
            "10C",
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
            "9D",
            "8D",
            "7D"
        ];
        $deck = [
            "5D",
            "9D",
            "10S",
            "11D",
            "14H",
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
            // "6D",
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
        $this->assertTrue($res);
    }


    public function testPossibleWithoutCardNotOk(): void
    {
        $hand = [
            "8D",
            "7D"
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

    public function testPossibleWithoutCardNotOk2(): void
    {
        $hand = [
            "8D",
            "7D"
        ];
        $deck = [
            "9D",
            "10S",
            "12H",
            "14H",
            "11S",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk4(): void
    {
        $hand = [
            "3D",
            "8D"
        ];
        $deck = [
            "9D",
            "10S",
            "12H",
            "14H",
            "11S",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }
}
