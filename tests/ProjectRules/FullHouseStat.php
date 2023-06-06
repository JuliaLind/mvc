<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FullHouseStatTest extends TestCase
{
    public function testCheckNotOk(): void
    {
        $rule = new FullHouseStat();
        $hand = [new Card(4, 'D'), new Card(2, 'C'), new Card(8, 'D')];

        $deck = [new Card(4, 'S'), new Card(2, 'D'), new Card(4, 'C')];
        $card = new Card(8, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk(): void
    {
        $rule = new FullHouseStat();
        $hand = [new Card(4, 'D'), new Card(2, 'C'),  new Card(2, 'D')];

        $deck = [new Card(4, 'S'), new Card(5, 'S'),];
        $card = new Card(4, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new FullHouseStat();
        $hand = [new Card(4, 'C'), new Card(4, 'D'), new Card(14, 'D'), new Card(14, 'H'),];

        $deck = [new Card(14, 'S'), new Card(4, 'S')];
        $card = new Card(8, 'H');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
