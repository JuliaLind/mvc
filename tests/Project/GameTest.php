<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCreateObject(): void
    {
        $player = $this->createMock(Grid::class);
        $house = $this->createMock(Grid::class);
        $deck = $this->createMock(Deck::class);

        $possibleCards = ["2C","3S","3H","4H","4C","4S","5S","6H","6C","7C","7D","8S","8D","11D","11C","12D","12C","13D"];
        $deck->method('possibleCards')->willReturn($possibleCards);
        $deck->expects($this->once())->method('deal')->willReturn("14C");
        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->once())->method('suggestion')->with($this->equalTo($player), $this->equalTo("14C"), $this->equalTo($possibleCards))->willReturn(
            [
                'row-rule' => "One Pair",
                'col-rule' => "Two Pairs",
                'slot' => [2, 1],
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
        $grids = [
            'player' => $player,
            'house' => $house
        ];
        $game = new Game($grids, $deck, $evaluator);
        $this->assertInstanceOf("\App\Project\Game", $game);
    }
}
