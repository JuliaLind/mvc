<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTrait7Test extends TestCase
{
    use TwoPairsTrait7;

    public function testFourCardsTwoPairsOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 2,
        ];
        $res = $this->fourCardsTwoPairs($ranksHand);
        $this->assertTrue($res);
    }

    public function testFourCardsTwoPairsNotOk(): void
    {
        $ranksHand = [
            4 => 2,
            6 => 1,
        ];
        $res = $this->fourCardsTwoPairs($ranksHand);
        $this->assertFalse($res);
    }
}
