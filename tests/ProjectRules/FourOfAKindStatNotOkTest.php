<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FourOfAKindStatNotOkTest extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [ new Card(5, 'C')];
        $card = new Card(8, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(5, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(5, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk4(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(10, 'H')];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk5(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H')];
        $card = new Card(5, 'S');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk6(): void
    {
        $rule = new SameOfAKindStat(4);
        $hand = [new Card(4, 'S'), new Card(7, 'S')];

        $deck = [new Card(8, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H')];
        $card = new Card(5, 'S');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
