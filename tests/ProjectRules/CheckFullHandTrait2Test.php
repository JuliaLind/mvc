<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CheckFullHandTrait2Test extends TestCase
{
    use CheckFullHandTrait;

    protected function setUp(): void
    {
        $this->rules = [
            new RoyalFlush(),
            new StraightFlush(),
            new SameOfAKind(4),
            new FullHouse(),
            new Flush(),
            new Straight(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];
    }

    public function testCheckHandForWinRoyalFlush(): void
    {
        $hand = ["10H", "12H", "11H", "14H", "13H"];

        $exp = [
            'name' => "Royal Flush",
            'points' => 100
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinStraightFlush(): void
    {
        $hand = ["2H", "3H", "4H", "5H", "6H"];

        $exp = [
            'name' => "Straight Flush",
            'points' => 75
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinFourOfAKind(): void
    {
        $hand = ["2D", "2H", "4H", "2S", "2C"];

        $exp = [
            'name' => "Four Of A Kind",
            'points' => 50
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinFullHouse(): void
    {
        $hand = ["2D", "2H", "4H", "2S", "4C"];

        $exp = [
            'name' => "Full House",
            'points' => 25
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinFlush(): void
    {
        $hand = ["2H", "3H", "5H", "6H", "7H"];

        $exp = [
            'name' => "Flush",
            'points' => 20
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinStraight(): void
    {
        $hand = ["10H", "12H", "11H", "14H", "13D"];

        $exp = [
            'name' => "Straight",
            'points' => 15
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinThreeOfAKind(): void
    {
        $hand = ["2D", "2H", "8H", "2S", "4C"];

        $exp = [
            'name' => "Three Of A Kind",
            'points' => 10
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinTwoPairs(): void
    {
        $hand = ["2D", "8H", "4H", "2S", "4C"];

        $exp = [
            'name' => "Two Pairs",
            'points' => 5
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinOnePair(): void
    {
        $hand = ["2D", "8H", "4H", "2S", "9C"];

        $exp = [
            'name' => "One Pair",
            'points' => 2
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWinNone(): void
    {
        $hand = ["2D", "8H", "4H", "3S", "9C"];

        $exp = [
            'name' => "None",
            'points' => 0
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }
}
