<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for trait GameAttrHandlerTrait.
 */
class GameAttrHandler2TraitTest extends TestCase
{
    use GameAttrHandler2Trait;

    protected Player21 $bank;
    protected Player21 $player;
    protected Player21 $winner;
    protected int $currentRound=0;

    protected function setUp(): void
    {
        $this->bank = $this->createMock(Player21::class);
        $this->player = $this->createMock(Player21::class);
        $this->winner = $this->createMock(Player21::class);
        $this->currentRound = 3;
    }

    public function testSetBank(): void
    {
        $bank = $this->createMock(Player21::class);
        $bank->method('getName')->willReturn("I'm the bank");
        $this->setBank($bank);
        $res = $this->bank->getName();
        $exp = "I'm the bank";
        $this->assertEquals($exp, $res);
    }

    public function testGetBank(): void
    {
        $bank = $this->createMock(Player21::class);
        $bank->method('getName')->willReturn("I'm the bank");
        $this->bank = $bank;
        $res = $this->getBank()->getName();
        $exp = "I'm the bank";
        $this->assertEquals($exp, $res);
    }

    public function testSetPlayer(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('getName')->willReturn("I'm the player");
        $this->setPlayer($player);
        $res = $this->player->getName();
        $exp = "I'm the player";
        $this->assertEquals($exp, $res);
    }

    public function testGetPlayer(): void
    {
        $player = $this->createMock(Player21::class);
        $player->method('getName')->willReturn("I'm the player");
        $this->player = $player;
        $res = $this->getPlayer()->getName();
        $exp = "I'm the player";
        $this->assertEquals($exp, $res);
    }

    public function testSetCurrentRound(): void
    {

        $this->setCurrentRound(8);
        $res = $this->currentRound;
        $exp = 8;
        $this->assertEquals($exp, $res);
    }

    public function testGetCurrentRound(): void
    {
        $res = $this->getCurrentRound();
        $exp = 3;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the setter for winner
     */
    public function testSetWinner(): void
    {
        $winner = $this->createMock(Player21::class);
        $winner->method('getName')->willReturn("a winner");
        $this->setWinner($winner);
        $res = $this->winner->getName();
        $exp = "a winner";
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getter for winner
     */
    public function testGetWinnerOk(): void
    {
        $winner = $this->createMock(Player21::class);
        $winner->method('getName')->willReturn("I'm a winner");
        $this->winner = $winner;
        $res = $this->getWinner()->getName();
        $exp = "I'm a winner";
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the getter for winner
     */
    public function testGetWinnerNotOk(): void
    {
        $res = $this->getWinner()->getName();
        $exp = "";
        $this->assertEquals($exp, $res);
    }
}
