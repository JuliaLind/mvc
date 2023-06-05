<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class OnePairStatTest extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new SameOfAKindStat(2);
        $hand = [new Card(4, 'D'), new Card(2, 'C'), new Card(8, 'D')];

        $deck = [new Card(2, 'D')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(2);
        $hand = [new Card(4, 'D'), new Card(2, 'C'), new Card(8, 'D')];

        $deck = [new Card(9, 'D'), new Card(4, 'H')];
        $card = new Card(9, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
