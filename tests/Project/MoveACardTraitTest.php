<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class MoveACardTraitTest extends TestCase
{
    use MoveACardTrait;


    public function testSetFromSlot(): void
    {
        $this->lastRound = [
            'player' => [2, 3],
            'house' => [1, 0]
        ];
        $row = 2;
        $col = 4;
        $this->setFromSlot($row, $col);

        $this->assertEquals([$row, $col], $this->fromSlot);
        $this->assertEquals([], $this->lastRound);
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

        $this->assertEquals([], $this->fromSlot);
    }
}
