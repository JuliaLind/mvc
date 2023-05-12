<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for trait GameTestingTrait.
 */
class GameTestingTraitTest extends TestCase
{
    use GameTestingTrait;

    protected MoneyPot $moneyPot;
    protected Player21 $bank;
    protected Player21 $winner;

    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected bool $finished=false;

    protected function setUp(): void
    {
        $this->bank = $this->createMock(Player21::class);
        $this->moneyPot = $this->createMock(MoneyPot::class);
        $this->moneyPot->method('currentAmount')->willReturn(130);
        $this->winner = $this->createMock(Player21::class);
    }

    /**
     * Tests the setter for moneypot
     */
    public function testSetMoneyPot(): void
    {
        $pot = $this->createMock(MoneyPot::class);
        $pot->method('currentAmount')->willReturn(30);
        $this->setMoneyPot($pot);
        $res = $this->moneyPot->currentAmount();
        $exp = 30;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the setter for bank
     */
    public function testSetBank(): void
    {
        $bank = $this->createMock(Player21::class);
        $bank->method('getName')->willReturn("I'm the bank");
        $this->setBank($bank);
        $res = $this->bank->getName();
        $exp = "I'm the bank";
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

    /**
     * Tests the setter for roundOver
     */
    public function testSetRoundOver(): void
    {
        $this->setRoundOver(true);
        $res = $this->roundOver;
        $this->assertTrue($res);
    }

    /**
     * Tests the getter for roundOver
     */
    public function testIsRoundOver(): void
    {
        $res = $this->isRoundOver();
        $this->assertFalse($res);
    }

    /**
     * Tests the getter for bankPlaying
     */
    public function testIsBankPlaying(): void
    {
        $res = $this->isBankPlaying();
        $this->assertFalse($res);
    }

    /**
     * Tests the setter for bankPlaying
     */
    public function testSetBankPlaying(): void
    {
        $this->setBankPlaying(true);
        $res = $this->bankPlaying;
        $this->assertTrue($res);
    }

    /**
     * Tests the setter for finished
     */
    public function testSetFinished(): void
    {
        $this->setFinished(true);
        $res = $this->finished;
        $this->assertTrue($res);
    }

    // /**
    //  * Tests the getter for finished
    //  */
    // public function testIsFinished(): void
    // {
    //     $res = $this->isFinished();
    //     $this->assertFalse($res);
    // }
}
