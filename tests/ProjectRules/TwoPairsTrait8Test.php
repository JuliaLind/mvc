<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait8Test extends TestCase
{
    use TwoPairsTrait8;

    public function testMatchOneInDeckOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 2,
            8 => 1,
            11 => 1
        ];
        $res = $this->matchOneInDeck($ranksHand, $ranksDeck);
        $this->assertTrue($res);
    }

    public function testMatchOneInDeckNotOk(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [
            4 => 1,
            9 => 1,
            11 => 1
        ];
        $res = $this->matchOneInDeck($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }

    public function testMatchOneInDeckNotOk2(): void
    {
        $ranksDeck = [
            5 => 1,
            8 => 1,
            10 => 1,
            14 => 1
        ];
        $ranksHand = [];
        $res = $this->matchOneInDeck($ranksHand, $ranksDeck);
        $this->assertFalse($res);
    }
}
