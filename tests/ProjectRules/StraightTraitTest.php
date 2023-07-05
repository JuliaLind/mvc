<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightTraitTest extends TestCase
{
    use CountByRankTrait;
    use StraightTrait;

    public function testPossibleWithoutCardNotOk(): void
    {
        $hand = [
            "12S",
            "11S",
            "11C",
            "10D"
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
            "12S",
            "11S",
            "11C",
            "10D",
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

    public function testPossibleWithoutCardNotOk3(): void
    {
        $hand = [
            "12S",
            "11S",
            "9C",
            "10D",
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

    public function testPossibleWithoutCardOk3(): void
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
            "10S",
            "12H",
            "14H",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNot4(): void
    {
        $hand = [
            "8D",
            "7D"
        ];
        $deck = [
            "6C",
            "6D",
            "10S",
            "12H",
            "14H",
            "14S"
        ];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk5(): void
    {
        $hand = [
            "8D",
            "7D"
        ];
        $deck = [
            "6C",
            "6D",
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
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk2(): void
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
        $this->assertTrue($res);
    }

    public function testPossibleDeckOnlyNotOk(): void
    {

        $deck = [
            "9D",
            "10S",
            "12H",
            "14H",
            "11S",
            "14S"
        ];
        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyOk(): void
    {

        $deck = [
            "9D",
            "10S",
            "12H",
            "6D",
            "14H",
            "11S",
            "8H",
            "14S"
        ];
        $res = $this->possibleDeckOnly($deck);
        $this->assertTrue($res);
    }
}
