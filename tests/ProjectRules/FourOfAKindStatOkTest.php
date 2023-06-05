<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FourOfAKindStatOkTest extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $deck = [];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk2(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(4, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk3(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'),];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(5, 'S')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'S')];

        $deck = [new Card(8, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H'), new Card(7, 'S')];
        $card = new Card(5, 'S');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'S')];

        $deck = [new Card(8, 'S'), new Card(5, 'D'), new Card(14, 'D'), new Card(5, 'C'), new Card(5, 'H'), new Card(7, 'S')];
        $card = new Card(5, 'S');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
