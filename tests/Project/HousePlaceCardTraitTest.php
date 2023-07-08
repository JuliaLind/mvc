<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class HousePlaceCardTraitTest extends TestCase
{
    use HousePlaceCardTrait;
    use SuggestMessageTrait;

    public function testHousePlaceCard(): void
    {
        $deck = $this->createMock(Deck::class);
        $evaluator = $this->createMock(RuleEvaluator::class);
        $house = $this->createMock(Grid::class);
        $possibleCards = ["2H","2S","3H","3S","3D","4H","4C","5D","5S", "12H","12S","13H"];
        $row = 1;
        $col = 3;
        $card = "8H";
        $deck->method('deal')->willReturn($card);
        $deck->method('possibleCards')->willReturn($possibleCards);

        $evaluator->expects($this->once())->method('suggestion')->with($this->equalTo($house), $this->equalTo($card), $this->equalTo($possibleCards))->willReturn(
            [
                'row-rule' => "One Pair",
                'col-rule' => "Two Pairs",
                'slot' => [$row, $col],
                'row-rules' => [
                    [
                        'rule-with-card' => "",
                        'weight' => -0.25,
                        'rule-without-card' => "Full House"
                    ],
                    [
                        'rule-with-card' => "",
                        'weight' => -200,
                        'rule-without-card' => ""
                    ],
                    [
                        'rule-with-card' => "One Pair",
                        'weight' => 2.5,
                        'rule-without-card' => "One Pair"
                    ],
                    [
                        'rule-with-card' => "",
                        'weight' => -0.1,
                        'rule-without-card' => "Three Of A Kind"
                    ],
                    [
                        'rule-with-card' => "One Pair",
                        'weight' => 2,
                        'rule-without-card' => "One Pair"
                    ],
                ],
                'col-rules' => [
                    [
                        'rule-with-card' => "",
                        'weight' => 0,
                        'rule-without-card' => "One Pair"
                    ],
                    [
                        'rule-with-card' => "Two Pairs",
                        'weight' => 6,
                        'rule-without-card' => "Two Pairs"
                    ],
                    [
                        'rule-with-card' => "One Pair",
                        'weight' => 2,
                        'rule-without-card' => "One Pair"
                    ],
                    [
                        'rule-with-card' => "One Pair",
                        'weight' => 2,
                        'rule-without-card' => "One Pair"
                    ],
                    [
                        'rule-with-card' => "",
                        'weight' => -0.2,
                        'rule-without-card' => "Flush"
                    ],
                ],
                'tot-weight-slot' => 2.5 + 6
            ]
        );

        $house->expects($this->once())->method('addCard')->with($row, $col, $card);

        $this->evaluator = $evaluator;
        $this->house = $house;
        $this->deck = $deck;
        $this->housePlaceCard();
        $this->assertEquals([$row, $col], $this->lastRound['house']);
    }
}
