<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

/**
 * Test cases for class Royal Flush Stat.
 */
class RoyalFlushStatTest extends TestCase
{
    public function testScoreNotOk(): void
    {
        $hand = [new Card(10, 'D'), new Card(11, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(14, 'C');
        $deck = [new Card(14, 'D')];

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }


    public function testPossibleOk(): void
    {
        $hand = [new Card(10, 'D'), new Card(11, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(14, 'D');
        $deck = [new Card(11, 'C')];

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }

    public function testPossibleNotOk2(): void
    {
        $hand = [new Card(10, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(14, 'D');
        $deck = [new Card(11, 'C')];

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertFalse($res);
    }

    public function testPossibleOk2(): void
    {
        $hand = [new Card(10, 'D'), new Card(12, 'D'), new Card(13, 'D')];

        $card = new Card(14, 'D');
        $deck = [new Card(11, 'D')];

        $rule = new RoyalFlushStat();
        $res = $rule->possible($hand, $deck, $card);
        $this->assertTrue($res);
    }
}
