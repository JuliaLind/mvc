<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FlushStatTest extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new FlushStat();
        $hand = [new Card(4, 'D'), new Card(2, 'D'), new Card(8, 'D')];

        $deck = [new Card(4, 'S'), new Card(3, 'D')];
        $card = new Card(9, 'D');
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $rule = new FlushStat();
        $hand = [new Card(4, 'D'), new Card(2, 'D')];

        $deck = [new Card(4, 'S'), new Card(3, 'D'), new Card(8, 'C')];
        $card = new Card(9, 'D');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $rule = new FlushStat();
        $hand = [new Card(4, 'D'), new Card(2, 'D')];

        $deck = [new Card(4, 'S'), new Card(3, 'D'), new Card(8, 'D')];
        $card = new Card(9, 'C');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $rule = new FlushStat();
        $hand = [new Card(4, 'D'), new Card(2, 'D')];

        $deck = [new Card(4, 'S'), new Card(3, 'H'), new Card(8, 'C')];
        $card = new Card(9, 'D');
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
