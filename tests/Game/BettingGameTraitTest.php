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

    protected function setUp(): void
    {
        $this->player = $this->createMock(Player21::class);
        $this->bank = $this->createMock(Player21::class);
        $this->player->method('getMoney')->will($this->onConsecutiveCalls(30, 10, 10));
        $this->bank->method('getMoney')->will($this->onConsecutiveCalls(15, 35, 0));
        $this->player->method('decrMoney')->will($this->onConsecutiveCalls(15, 10, 0));
        $this->bank->method('decrMoney')->will($this->onConsecutiveCalls(15, 10, 0));

        $this->moneyPot = new MoneyPot();
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
    public function testAddToMoneyPotMockPlayers(): void
    {
        $this->addToMoneyPot(30);
        $res = $this->moneyPot->currentAmount();
        $exp = 30;
        $this->assertEquals($exp, $res);

        $this->addToMoneyPot(30);
        $res = $this->moneyPot->currentAmount();
        $exp = 50;
        $this->assertEquals($exp, $res);

        $this->addToMoneyPot(30);
        $res = $this->moneyPot->currentAmount();
        $exp = 50;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the addToMoneyPot method with amount at limit
     */
    public function testAddToMoneyPotActualPlayersOk(): void
    {
        $this->bank = new Player21();
        $this->bank->incrMoney(130);
        $this->player = new Player21();
        $this->player->incrMoney(50);

        $this->addToMoneyPot(50);
        $res = $this->moneyPot->currentAmount();
        $exp = 100;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests the addToMoneyPot method with amount higher than limit
     */
    public function testAddToMoneyPotActualPlayersNotOk(): void
    {
        $this->bank = new Player21();
        $this->bank->incrMoney(130);
        $this->player = new Player21();
        $this->player->incrMoney(50);
        $this->addToMoneyPot(130);
        $res = $this->moneyPot->currentAmount();
        $exp = 100;
        $this->assertEquals($exp, $res);
    }
}
