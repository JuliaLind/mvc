<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FourOfAKindStatNotOkTest extends TestCase
{
    public function testPossibleNotOk(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [ new Card(5, 'C')];
        $card = new Card(8, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk2(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(5, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk3(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [$this->createMock(Card::class)];
        $card = new Card(5, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk4(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(5, 'S')];

        $deck = [new Card(10, 'H')];
        $card = new Card(4, 'H');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk5(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [];

        $deck = [new Card(4, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleNotOk6(): void
    {
        $rule = new FourOfAKindStat();
        $hand = [new Card(4, 'S'), new Card(7, 'S')];

        $deck = [new Card(8, 'S'), new Card(4, 'D'), new Card(14, 'D'), new Card(4, 'C'), new Card(4, 'H')];
        $card = new Card(5, 'S');
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
