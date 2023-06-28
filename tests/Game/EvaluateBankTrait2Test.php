<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Markdown\MdParser;

/**
 * Test cases for trait BettingGameTrait.
 */
class EvaluateBankTrait2Test extends TestCase
{
    use EvaluateBankTrait2;

    public function testBankWinsOnEqual(): void
    {
        $res = $this->bankWinsOnEqual(17, 17);
        $this->assertTrue($res);

        $res = $this->bankWinsOnEqual(18, 17);
        $this->assertFalse($res);

        $res = $this->bankWinsOnEqual(21, 17);
        $this->assertTrue($res);

        $res = $this->bankWinsOnEqual(17, 18);
        $this->assertFalse($res);
    }

    public function testHasBankMoreThan21(): void
    {
        $res = $this->hasBankMoreThan21(21);
        $this->assertFalse($res);

        $res = $this->hasBankMoreThan21(18);
        $this->assertFalse($res);

        $res = $this->hasBankMoreThan21(22);
        $this->assertTrue($res);
    }

    public function testHasBankBestScore(): void
    {
        $res = $this->hasBankBestScore(17, 17);
        $this->assertFalse($res);

        $res = $this->hasBankBestScore(18, 17);
        $this->assertTrue($res);

        $res = $this->bankWinsOnEqual(17, 18);
        $this->assertFalse($res);
    }
}
