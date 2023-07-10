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
        $evaluator->expects($this->exactly(2))->method('results');

        $grids = [
            'player' => $player,
            'house' => $house
        ];
        $game = new Game($grids, $deck, $evaluator);
        $this->assertInstanceOf("\App\Project\Game", $game);
    }
}
