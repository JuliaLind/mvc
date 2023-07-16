<?php

namespace App\Project;

use App\ProjectEvaluator\RuleEvaluator;
use App\ProjectGrid\Grid;
use PHPUnit\Framework\TestCase;

class UndoLastRoundTraitTest extends TestCase
{
    use UndoLastRoundTrait;

    /**
     * Test undo last round when the grids contain more thatn one card each
     */
    public function testUndoLastRound(): void
    {
        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->exactly(2))->method('results');
        $this->evaluator = $evaluator;
        $this->lastRound = [
            'house' => [[0, 2], [1, 0]],
            'player' => [[4, 1], [2, 3]],
        ];
        $this->card = "5S";

        $house = $this->createMock(Grid::class);
        $player = $this->createMock(Grid::class);
        $house->expects($this->once())
        ->method('removeCard')->with($this->equalTo(1), $this->equalTo(0))->willReturn("12D");
        $player->expects($this->once())
        ->method('removeCard')->with($this->equalTo(2), $this->equalTo(3))->willReturn("8H");
        $this->house = $house;
        $this->player = $player;

        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')
        ->willReturn([]);

        $this->deck = new Deck($factory);
        $this->undoLastRound();


        $exp = [
            'house' => [[0, 2]],
            'player' => [[4, 1]],
        ];
        $this->assertEquals($exp, $this->lastRound);
        $this->assertEquals("12D", $this->deck->deal());
        $this->assertEquals("5S", $this->deck->deal());
        $this->card = "8H";
    }

    /**
     * Test undo last round if both contain one card each and will be empty after
     */
    public function testUndoLastRound2(): void
    {
        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->exactly(2))->method('results');
        $this->evaluator = $evaluator;
        $this->lastRound = [
            'house' => [[1, 0]],
            'player' => [[2, 3]],
        ];
        $this->card = "5S";

        $house = $this->createMock(Grid::class);
        $player = $this->createMock(Grid::class);
        $house->expects($this->once())
        ->method('removeCard')->with($this->equalTo(1), $this->equalTo(0))->willReturn("12D");
        $player->expects($this->once())
        ->method('removeCard')->with($this->equalTo(2), $this->equalTo(3))->willReturn("8H");
        $this->house = $house;
        $this->player = $player;

        $factory = $this->createMock(CardFactory::class);
        $factory->method('fullSet')
        ->willReturn([]);

        $this->deck = new Deck($factory);
        $this->undoLastRound();


        $exp = [
            'house' => [],
            'player' => [],
        ];
        $this->assertEquals($exp, $this->lastRound);
        $this->assertEquals("12D", $this->deck->deal());
        $this->assertEquals("5S", $this->deck->deal());
        $this->card = "8H";
    }
}
