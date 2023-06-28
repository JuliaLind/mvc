<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

class EvaluateBankTraitTest extends TestCase
{
    use EvaluateBankTrait;

    protected bool $check1 = false;
    protected bool $check2 = false;
    protected bool $check3 = false;


    protected function hasBankMoreThan21(int $bankHandValue): bool
    {
        $this->check1 = true;
        return $bankHandValue > $this->goal;
    }

    protected function bankWinsOnEqual(int $bankHandValue, int $playerHandValue): bool
    {
        $this->check2 = true;
        return $bankHandValue === $this->goal || $bankHandValue === $playerHandValue;
    }


    protected function hasBankBestScore(int $bankHandValue, int $playerHandValue): bool
    {
        $this->check3 = true;
        $diffBank = $this->goal - $bankHandValue;
        $diffPlayer = $this->goal - $playerHandValue;
        return $diffBank < $diffPlayer;
    }

    public function testEvaluateBank(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(17);
        $bank->method('handValue')->willReturn(31);
        $this->player = $player;
        $this->bank = $bank;

        $this->evaluateBank();
        $this->assertTrue($this->check1);
        $this->assertFalse($this->check2);
        $this->assertFalse($this->check3);
        $this->assertSame($player, $this->winner);
    }

    public function testEvaluateBank2(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(17);
        $bank->method('handValue')->willReturn(17);
        $this->player = $player;
        $this->bank = $bank;

        $this->evaluateBank();
        $this->assertTrue($this->check1);
        $this->assertTrue($this->check2);
        $this->assertFalse($this->check3);
        $this->assertSame($bank, $this->winner);
    }

    public function testEvaluateBank3(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(17);
        $bank->method('handValue')->willReturn(18);
        $this->player = $player;
        $this->bank = $bank;

        $this->evaluateBank();
        $this->assertTrue($this->check1);
        $this->assertTrue($this->check2);
        $this->assertTrue($this->check3);
        $this->assertSame($bank, $this->winner);
    }

    public function testEvaluateBank4(): void
    {
        $player = $this->createMock(Player21::class);
        $bank = $this->createMock(Player21::class);
        $player->method('handValue')->willReturn(18);
        $bank->method('handValue')->willReturn(17);
        $this->player = $player;
        $this->bank = $bank;

        $this->evaluateBank();
        $this->assertTrue($this->check1);
        $this->assertTrue($this->check2);
        $this->assertTrue($this->check3);
        $this->assertSame($player, $this->winner);
    }

}
