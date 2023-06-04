<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class OnePairStatTest extends TestCase
{
    public function testPossibleOk(): void
    {
        $rule = new OnePairStat();
        $hand = [new Card(4, 'D'), new Card(2, 'C'), new Card(8, 'D')];

        $deck = [new Card(2, 'D')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
