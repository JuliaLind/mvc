<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;

class UndoLastRoundTraitTest extends TestCase
{
    use UndoLastRoundTrait;

    private bool $playerSuggestCalled = false;

    /**
     * Mocked method to remove dependecy
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    private function playerSuggest(): void
    {
        $this->playerSuggestCalled = true;
    }


    public function testUndoLastRound(): void
    {
        $this->lastRound = [
            'player' => [2, 3],
            'house' => [1, 0]
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
        $this->assertTrue($this->playerSuggestCalled);
        $this->assertEquals([], $this->lastRound);
        $this->assertEquals("12D", $this->deck->deal());
        $this->assertEquals("5S", $this->deck->deal());
        $this->card = "8H";
    }
}
