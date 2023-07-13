<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Trait for handling moving a card from one slot to another
 */
class MoveACardTraitTest extends TestCase
{
    use MoveACardTrait;


    public function testSetFromSlot(): void
    {
        $this->lastRound = [
            'player' => [[2, 3], [4, 1]],
            'house' => [[1, 0], [0, 2]]
        ];
        $row = 2;
        $col = 4;
        $this->setFromSlot($row, $col);

        $this->assertEquals([$row, $col], $this->fromSlot);
        $this->assertEquals([[2, 3], [4, 1]], $this->lastRound['player']);
        $this->assertEquals([[1, 0], [0, 2]], $this->lastRound['house']);
    }

    public function testMoveCard(): void
    {
        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->exactly(2))->method('results');
        $this->evaluator = $evaluator;
        $fromRow = 2;
        $fromCol = 4;
        $toRow = 1;
        $toCol = 3;
        $card = "8H";
        $this->fromSlot = [$fromRow, $fromCol];

        $player = $this->createMock(Grid::class);
        $this->house = $this->createMock(Grid::class);
        $player->expects($this->once())->method('removeCard')->with($this->equalTo($fromRow), $this->equalTo($fromCol))->willReturn($card);
        $player->expects($this->once())->method('addCard')->with($this->equalTo($toRow), $this->equalTo($toCol), $this->equalTo($card));
        $this->player = $player;
        $this->moveCard($toRow, $toCol);
        $this->assertEquals([], $this->lastRound['player']);
        $this->assertEquals([], $this->lastRound['house']);
        $this->assertEquals([], $this->fromSlot);
    }
}
