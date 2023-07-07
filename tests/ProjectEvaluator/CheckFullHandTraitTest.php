<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RoyalFlush;
use App\ProjectRules\StraightFlush;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\Flush;
use App\ProjectRules\Straight;
use App\ProjectRules\TwoPairs;

use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CheckFullHandTraitTest extends TestCase
{
    use CheckFullHandTrait;

    protected function setUp(): void
    {
        $royalFlush = $this->createMock(RoyalFlush::class);
        $straightFlush = $this->createMock(StraightFlush::class);
        $fourOfAKind = $this->createMock(SameOfAKind::class);
        $fullHouse =$this->createMock(FullHouse::class);
        $flush = $this->createMock(Flush::class);
        $straight = $this->createMock(Straight::class);
        $threeOfAKind = $this->createMock(SameOfAKind::class);
        $twoPairs = $this->createMock(TwoPairs::class);
        $onePair = $this->createMock(SameOfAKind::class);
        foreach([$royalFlush, $straightFlush, $fourOfAKind, $fullHouse, $flush, $straight, $threeOfAKind, $twoPairs, $onePair] as $rule) {
            $rule->expects($this->never())->method('scored');
        }
        $this->rules = [
            $royalFlush,
            $straightFlush,
            $fourOfAKind,
            $fullHouse,
            $flush,
            $straight,
            $threeOfAKind,
            $twoPairs,
            $onePair
        ];
    }

    public function testCheckHandForWin(): void
    {
        $hand = ["card1", "card2", "card3", "card4", "card5"];
        $royalFlush = $this->createMock(RoyalFlush::class);
        $royalFlush->expects($this->once())->method('scored')->with($this->equalTo($hand))
        ->willReturn(true);
        $royalFlush->method('getName')->willReturn('Royal Flush');
        $royalFlush->method('getPoints')->willReturn(100);
        $this->rules[0] = $royalFlush;
        $exp = [
            'name' => "Royal Flush",
            'points' => 100
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWin2(): void
    {
        $hand = ["card1", "card2", "card3", "card4", "card5"];
        $royalFlush = $this->createMock(RoyalFlush::class);
        $straightFlush = $this->createMock(StraightFlush::class);
        $fourOfAKind = $this->createMock(SameOfAKind::class);
        $fullHouse =$this->createMock(FullHouse::class);

        $royalFlush->expects($this->once())
        ->method('scored')
        ->with($this->equalTo($hand))
        ->willReturn(false);

        $straightFlush->expects($this->once())
        ->method('scored')
        ->with($this->equalTo($hand))
        ->willReturn(false);

        $fourOfAKind->expects($this->once())
        ->method('scored')
        ->with($this->equalTo($hand))
        ->willReturn(false);

        $fullHouse->expects($this->once())
        ->method('scored')
        ->with($this->equalTo($hand))
        ->willReturn(true);

        $fullHouse->method('getName')->willReturn('Full House');
        $fullHouse->method('getPoints')->willReturn(25);


        $this->rules[0] = $royalFlush;
        $this->rules[1] = $straightFlush;
        $this->rules[2] = $fourOfAKind;
        $this->rules[3] = $fullHouse;
        $exp = [
            'name' => "Full House",
            'points' => 25
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

    public function testCheckHandForWin3(): void
    {
        $hand = ["card1", "card2", "card3", "card4", "card5"];
        $royalFlush = $this->createMock(RoyalFlush::class);
        $straightFlush = $this->createMock(StraightFlush::class);
        $fourOfAKind = $this->createMock(SameOfAKind::class);
        $fullHouse =$this->createMock(FullHouse::class);
        $flush = $this->createMock(Flush::class);
        $straight = $this->createMock(Straight::class);
        $threeOfAKind = $this->createMock(SameOfAKind::class);
        $twoPairs = $this->createMock(TwoPairs::class);
        $onePair = $this->createMock(SameOfAKind::class);

        $rules = [$royalFlush, $straightFlush, $fourOfAKind, $fullHouse, $flush, $straight, $threeOfAKind, $twoPairs, $onePair];

        foreach($rules as $rule) {
            $rule->expects($this->once())->method('scored')->with($this->equalTo($hand))
            ->willReturn(false);
        }
        $this->rules = $rules;

        $exp = [
            'name' => "None",
            'points' => 0
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

}
