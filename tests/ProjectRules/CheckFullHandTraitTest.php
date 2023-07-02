<?php

namespace App\ProjectRules;

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
        foreach([$royalFlush, $straightFlush, $fourOfAKind, $fullHouse, $flush,$straight, $threeOfAKind, $twoPairs, $onePair] as $rule) {
            $rule->expects($this->never())->method('scored');
        }
        // $royalFlushStat = $this->createMock(RoyalFlushStat::class);
        // $straightFlushStat = $this->createMock(StraightFlushStat::class);
        // $fourOfAKindStat = $this->createMock(SameOfAKindStat::class);
        // $fullHouseStat =$this->createMock(FullHouseStat::class);
        // $flushStat = $this->createMock(FlushStat::class);
        // $straightStat = $this->createMock(StraightStat::class);
        // $threeOfAKindStat = $this->createMock(SameOfAKindStat::class);
        // $twoPairsStat = $this->createMock(TwoPairsStat::class);
        // $onePairStat = $this->createMock(SameOfAKindStat::class);
        $this->rules = [
            [
                'name' => 'Royal Flush',
                'points' => 100,
                'scored' => $royalFlush,
                'possible' => $this->createMock(RoyalFlushStat::class)
            ],
            [
                'name' => 'Straight Flush',
                'points' => 75,
                'scored' => $straightFlush,
                'possible' => $this->createMock(StraightFlushStat::class)
            ],
            [
                'name' => 'Four Of A Kind',
                'points' => 50,
                'scored' => $fourOfAKind,
                'possible' => $this->createMock(SameOfAKindStat::class)
            ],
            [
                'name' => 'Full House',
                'points' => 25,
                'scored' => $fullHouse,
                'possible' => $this->createMock(FullHouseStat::class)
            ],
            [
                'name' => 'Flush',
                'points' => 20,
                'scored' => $flush,
                'possible' => $this->createMock(FlushStat::class)
            ],
            [
                'name' => 'Straight',
                'points' => 15,
                'scored' => $straight,
                'possible' => new StraightStat()
            ],
            [
                'name' => 'Three Of A Kind',
                'points' => 10,
                'scored' => $threeOfAKind,
                'possible' => $this->createMock(SameOfAKindStat::class)
            ],
            [
                'name' => 'Two Pairs',
                'points' => 5,
                'scored' => $twoPairs,
                'possible' => $this->createMock(StraightStat::class)
            ],
            [
                'name' => 'One Pair',
                'points' => 2,
                'scored' => $onePair,
                'possible' => $this->createMock(SameOfAKindStat::class)
            ],
        ];
    }

    public function testCheckHandForWin(): void
    {
        $hand = ["card1", "card2", "card3", "card4", "card5"];
        $royalFlush = $this->createMock(RoyalFlush::class);
        $royalFlush->expects($this->once())->method('scored')->with($this->equalTo($hand))
        ->willReturn(true);
        $this->rules[0]['scored'] = $royalFlush;
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


        $this->rules[0]['scored'] = $royalFlush;
        $this->rules[1]['scored'] = $straightFlush;
        $this->rules[2]['scored'] = $fourOfAKind;
        $this->rules[3]['scored'] = $fullHouse;
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
        foreach([$royalFlush, $straightFlush, $fourOfAKind, $fullHouse, $flush,$straight, $threeOfAKind, $twoPairs, $onePair] as $index => $rule) {
            $rule->expects($this->once())->method('scored')->with($this->equalTo($hand))
            ->willReturn(false);
            $this->rules[$index]['scored'] = $rule;
        }

        $exp = [
            'name' => "None",
            'points' => 0
        ];
        $res = $this->checkHandForWin($hand);
        $this->assertEquals($exp, $res);
    }

}
