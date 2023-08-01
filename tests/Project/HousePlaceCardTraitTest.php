<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class HousePlaceCardTraitTest extends TestCase
{
    use HousePlaceCardTrait;

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

        $evaluator->expects($this->once())->method('houseSuggestion')->with($this->equalTo($house), $this->equalTo($card), $this->equalTo($possibleCards))->willReturn(
            [$row, $col]
        );

        $house->expects($this->once())->method('addCard')->with($row, $col, $card);

        $this->evaluator = $evaluator;
        $this->house = $house;
        $this->deck = $deck;
        $this->housePlaceCard();
        $this->assertEquals([$row, $col], $this->lastRound['house'][0]);
    }
}
