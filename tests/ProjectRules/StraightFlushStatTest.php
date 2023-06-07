<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

/**
 * Test cases for class Royal Flush Stat.
 */
class StraightFlushStatTest extends TestCase
{
    public function testCheckOk3(): void
    {
        $hand = [new Card(9, 'D'), new Card(10, 'D'), new Card(11, 'D'), new Card(13, 'D')];

        $card = new Card(12, 'D');
        $deck = [new Card(8, 'C')];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckOk4(): void
    {
        $hand = [new Card(10, 'D'), new Card(11, 'D'), new Card(13, 'D')];

        $card = new Card(9, 'D');
        $deck = [new Card(8, 'C'), new Card(12, 'D')];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk4(): void
    {
        $hand = [new Card(10, 'D'), new Card(11, 'D'), new Card(13, 'D')];

        $card = new Card(9, 'C');
        $deck = [new Card(8, 'C'), new Card(12, 'D')];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }


    public function testCheckNotOk(): void
    {
        $hand = [new Card(10, 'D'), new Card(11, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(9, 'C');
        $deck = [new Card(9, 'D')];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testCheckOk(): void
    {
        $hand = [new Card(10, 'D'), new Card(11, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(9, 'D');
        $deck = [new Card(9, 'C')];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = [new Card(10, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(9, 'D');
        $deck = [new Card(8, 'C')];

        $rule = new StraightFlushStat();
        $res = $rule->check($hand, $deck, $card);
        $this->assertFalse($res);
    }
}
