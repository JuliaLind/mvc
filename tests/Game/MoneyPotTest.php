<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Test cases for class MoneyPot.
 */
class MoneyPotTest extends TestCase
{
    protected MoneyPot $moneyPot;

    protected function setUp(): void
    {
        $this->moneyPot = new MoneyPot();
    }

    /**
     * Construct object and check that all metods return
     * expected properties
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Game\MoneyPot", $this->moneyPot);

        $res = $this->moneyPot->currentAmount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests addMoney method
     */
    public function testAddMoneyOk(): void
    {
        $player = $this->createMock(Player::class);
        $player->method('decrMoney')->willReturn(30);

        $this->moneyPot->addMoney(30, [$player, $player, $player]);
        $res = $this->moneyPot->currentAmount();
        $exp = 90;
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests moneyToWinner method
     */
    public function testMoneyToWinnerOk(): void
    {
        $player = $this->createMock(Player::class);
        $player->method('decrMoney')->willReturn(30);
        $this->moneyPot->addMoney(30, [$player, $player, $player]);

        $player->expects($this->once())
        ->method('incrMoney')
        ->with($this->equalTo(90));
        $this->moneyPot->moneyToWinner($player);

        $res = $this->moneyPot->currentAmount();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
