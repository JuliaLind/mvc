<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for trait BettingGameTrait.
 */
class BettingGameTraitTest extends TestCase
{
    use BettingGameTrait;
    protected MoneyPot $moneyPot;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;

    protected function setUp(): void
    {
        $this->player = $this->createMock(Player21::class);
        $this->bank = $this->createMock(Player21::class);
        $this->player->method('getMoney')->will($this->onConsecutiveCalls(30, 10, 10));
        $this->bank->method('getMoney')->will($this->onConsecutiveCalls(15, 35, 0));
        $this->moneyPot = new MoneyPot();
        $this->winner = $this->createMock(Player21::class);
    }

    /**
     * Tests the getInvestLimit method
     */
    public function testGetInvestLimit(): void
    {
        $res = $this->getInvestLimit();
        $exp = 15;
        $this->assertEquals($exp, $res);

        $res = $this->getInvestLimit();
        $exp = 10;
        $this->assertEquals($exp, $res);

        $res = $this->getInvestLimit();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the addToMoneyPot method
     */
    public function testAddToMoneyPotOk(): void
    {
        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('addMoney')
            ->with($this->equalTo(10), $this->equalTo([$this->player, $this->bank]));

        $this->moneyPot = $pot;
        $this->addToMoneyPot(10);
    }

    /**
     * Tests the addToMoneyPot method with amount higher than limit
     */
    public function testAddToMoneyPotNotOk(): void
    {
        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('addMoney')
            ->with($this->equalTo(15), $this->equalTo([$this->player, $this->bank]));

        $this->moneyPot = $pot;
        $this->addToMoneyPot(25);

        $pot = $this->createMock(MoneyPot::class);
        $pot->expects($this->once())
            ->method('addMoney')
            ->with($this->equalTo(10), $this->equalTo([$this->player, $this->bank]));
        $this->moneyPot = $pot;
        $this->addToMoneyPot(35);
    }

    public function testIsWinnerOk(): void
    {
        $this->winner = $this->createMock(Player21::class);
        $this->winner->method('getName')->willReturn("real winner");
        $res = $this->isWinner();
        $this->assertTrue($res);
    }

    public function testIsWinnerNotOk(): void
    {
        $res = $this->isWinner();
        $this->assertFalse($res);
    }
}
