<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTrait2Test extends TestCase
{
    use FullHouseTrait2;
    use CountByRankTrait;


    public function testPossibleWithoutCardNotOk(): void
    {
        $hand = ["4D", "10H", "11S"];
        $deck = ["4H", "4C", "10C"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk(): void
    {
        $hand = ["4D"];
        $deck = ["4H", "4C", "10C", "10H", "11S"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk2(): void
    {
        $hand = ["4D"];
        $deck = ["4H", "10C", "10H", "11S"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk3(): void
    {
        $hand = ["4D"];
        $deck = ["4H", "4C", "10H", "11S"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk2(): void
    {
        $hand = ["10S"];
        $deck = ["4H", "4C", "10C", "10H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk5(): void
    {
        $hand = ["10S"];
        $deck = ["4H", "4C", "10C"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk3(): void
    {
        $hand = ["10S", "10C"];
        $deck = ["4H", "4C", "10H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk6(): void
    {
        $hand = ["10S", "10C"];
        $deck = ["4H", "4C"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk4(): void
    {
        $hand = ["4H", "4C"];
        $deck = ["10H", "10S", "10C"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk5(): void
    {
        $hand = ["4H"];
        $deck = ["10H", "10S", "4C", "10C"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }
}
