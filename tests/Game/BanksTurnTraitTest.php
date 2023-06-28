<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

/**
 * Test cases for trait BettingGameTrait.
 */
class BanksTurnTraitTest extends TestCase
{
    use BanksTurnTrait;

    protected bool $dealBankCalled = false;
    protected bool $evaluateBankCalled = false;
    protected bool $endRoundCalled = false;


    protected function dealBank(): void
    {
        $this->dealBankCalled = true;
    }

    protected function evaluateBank(): void
    {
        $this->evaluateBankCalled = true;
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


    public function testBankTurn(): void
    {
        $flash = $this->banksTurn();
        $this->assertEquals(["test", "This is a test message"], $flash);
        $this->assertTrue($this->dealBankCalled);
        $this->assertTrue($this->evaluateBankCalled);
        $this->assertTrue($this->endRoundCalled);
    }
}
