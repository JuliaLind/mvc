<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait2Test extends TestCase
{
    use CountByRankTrait;
    use TwoPairsTrait2;
    use TwoPairsTrait3;
    use TwoPairsTrait7;
    use TwoPairsTrait8;
    use TwoPairsTrait9;
    use TwoPairsTrait10;

    use TwoPairsTrait11;
    use TwoPairsTrait12;
    use TwoPairsTrait13;
    use TwoPairsTrait14;


    public function testPossibleWithoutCardOk(): void
    {
        $deck = ["14H", "4C", "8C", "14S", "10S", "5C", "8S"];
        $hand = ["8D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk2(): void
    {
        $deck = ["14H", "4C", "8C", "14S", "10S", "5C", "8S"];
        $hand = ["11D"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk3(): void
    {
        $deck = ["14H", "4C", "10S", "5C", "8S"];
        $hand = ["8C", "14S"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk4(): void
    {
        $deck = ["4C", "10S", "5C", "8S"];
        $hand = ["8C", "14S", "14H"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk5(): void
    {
        $deck = ["4C", "10S", "14H", "8S"];
        $hand = ["8C", "14S", "5C"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk6(): void
    {
        $deck = ["14H", "14S", "10S", "5C", "8S"];
        $hand = ["8C", "4C"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk7(): void
    {
        $deck = ["4C", "10S", "5C"];
        $hand = ["8C", "14S", "14H", "8S"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardNotOk(): void
    {
        $deck = ["4C", "8C", "14S", "14H", "8S"];
        $hand = ["10S", "5C"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk2(): void
    {
        $deck = ["4C", "14S", "14H", "8S"];
        $hand = ["10S", "5C", "8C"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk3(): void
    {
        $deck = ["4C", "14S", "14H"];
        $hand = ["10S", "5C", "8C", "8S"];
        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }
}
