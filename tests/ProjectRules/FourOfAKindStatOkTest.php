<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FourOfAKindStatOkTest extends TestCase
{
    public function testPossibleOk(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $deck = [];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk2(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(4, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleOk3(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'),];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleNotOk(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk2(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'S')];

        $deck = [new Card(8, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H'), new Card(7, 'S')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk3(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'S')];

        $deck = [new Card(8, 'S'), new Card(5, 'D'), new Card(14, 'D'), new Card(5, 'C'), new Card(5, 'H'), new Card(7, 'S')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
