<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;

class MoveACardTraitTest extends TestCase
{
    use MoveACardTrait;

    private bool $playerSuggestCalled = false;

    /**
     * Mocked method to remove dependecy
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function playerSuggest(): void
    {
        $this->playerSuggestCalled = true;
    }



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
        $fromRow = 2;
        $fromCol = 4;
        $toRow = 1;
        $toCol = 3;
        $card = "8H";
        $this->fromSlot = [$fromRow, $fromCol];

        $player = $this->createMock(Grid::class);
        $player->expects($this->once())->method('removeCard')->with($this->equalTo($fromRow), $this->equalTo($fromCol))->willReturn($card);
        $player->expects($this->once())->method('addCard')->with($this->equalTo($toRow), $this->equalTo($toCol), $this->equalTo($card));
        $this->player = $player;
        $this->moveCard($toRow, $toCol);
        $this->assertTrue($this->playerSuggestCalled);
        $this->assertEquals([], $this->fromSlot);
    }
}
