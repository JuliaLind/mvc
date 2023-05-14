<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for trait GameAttrHandlerTrait.
 */
class GameAttrHandlerTraitTest extends TestCase
{
    use GameAttrHandlerTrait;

    protected MoneyPot $moneyPot;
    protected Player21 $bank;


    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected bool $finished=false;

    protected function setUp(): void
    {
        $this->bank = $this->createMock(Player21::class);

        $pot = $this->createMock(MoneyPot::class);
        $pot->method('currentAmount')->willReturn(130);
        $this->moneyPot = $pot;
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

    public function testGetMoneyPot(): void
    {
        $pot = $this->createMock(MoneyPot::class);
        $pot->method('currentAmount')->willReturn(30);
        $this->setMoneyPot($pot);
        $res = $this->getMoneyPot()->currentAmount();
        $exp = 30;
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
}
