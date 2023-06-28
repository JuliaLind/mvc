<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;
use App\Cards\DeckOfCards;

/**
 * Test cases for trait BettingGameTrait.
 */
class PlayersTurnTraitTest extends TestCase
{
    use PlayersTurnTrait;

    protected bool $evaluateCalled = false;
    protected bool $endRoundCalled = false;
    protected bool $evalResult = false;

    protected function evaluate(): bool
    {
        $this->evaluateCalled = true;
        return $this->evalResult;
    }

    protected function endRound(): void
    {
        $this->endRoundCalled = true;
    }

    /**
     * Returns array with flash message type and the message
     *
     * @return array<string>
     */
    protected function generateFlash(): array
    {
        return ["test", "This is a test message"];
    }


    public function testplayersTurn(): void
    {
        $player = $this->createMock(Player21::class);
        $deck = $this->createMock(DeckOfCards::class);
        $player->expects($this->once())->method('draw')->with($this->equalTo($deck));
        $this->player = $player;
        $this->deck = $deck;


        $flash = $this->playersTurn();
        $this->assertEquals(["test", "This is a test message"], $flash);

        $this->assertTrue($this->evaluateCalled);
        $this->assertFalse($this->endRoundCalled);
    }

    public function testplayersTurn2(): void
    {
        $player = $this->createMock(Player21::class);
        $deck = $this->createMock(DeckOfCards::class);
        $player->expects($this->once())->method('draw')->with($this->equalTo($deck));
        $this->player = $player;
        $this->deck = $deck;
        $this->evalResult=true;

        $flash = $this->playersTurn();
        $this->assertEquals(["test", "This is a test message"], $flash);

        $this->assertTrue($this->evaluateCalled);
        $this->assertTrue($this->endRoundCalled);
    }
}
