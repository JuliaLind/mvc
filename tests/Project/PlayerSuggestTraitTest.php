<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;
use PHPUnit\Framework\TestCase;

class PlayerSuggestTraitTest extends TestCase
{
    use PlayerSuggestTrait;


    public function testPlayerSuggest(): void
    {
        $player = $this->createMock(Grid::class);
        $deck = $this->createMock(Deck::class);
        $evaluator = $this->createMock(RuleEvaluator::class);

        $card = "6S";
        $cards = ["12D","10D","9D","5D","11C","3D","11S","5H","5S","14S","5C","2D"];

        $exp = [
            'col-rule' => "Flush",
            'row-rule' => "Straight",
            'slot' => [3, 1],
            'row-rules' => [
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "",'weight' => 0,'rule-without-card' => "Four Of A Kind"],
                ['rule-with-card' => "",'weight' => -0.25,'rule-without-card' => "Full House"],
                ['rule-with-card' => "Straight",'weight' => 17,'rule-without-card' => "Straight"],
                ['rule-with-card' => "",'weight' => -200,'rule-without-card' => ""],
            ],
            'col-rules' => [
                ['rule-with-card' => "One Pair",'weight' => -0.75,'rule-without-card' => "Straight Flush"],
                ['rule-with-card' => "Flush",'weight' => 21,'rule-without-card' => "Four Of A Kind"],
                ['rule-with-card' => "",'weight' => -0.15,'rule-without-card' => "Straight"],
                ['rule-with-card' => "Two Pairs",'weight' => 8,'rule-without-card' => "Two Pairs"],
                ['rule-with-card' => "Two Pairs",'weight' => -0.1,'rule-without-card' => "Three Of A Kind"],
            ],
            'tot-weight-slot' => 38.0
        ];
        $deck->expects($this->once())->method('possibleCards')->wilLReturn($cards);
        $evaluator->expects($this->once())->method('suggestion')->with($this->equalTo($player), $this->equalTo($card), $this->equalTo($cards))->willReturn($exp);

        $this->deck = $deck;
        $this->card = $card;
        $this->player = $player;
        $this->evaluator = $evaluator;

        $this->playerSuggest();
        $this->assertEquals($exp, $this->suggestion);
    }
}
