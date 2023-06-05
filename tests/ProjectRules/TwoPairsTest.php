<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class TwoPairsTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'D'), new Card(5, 'H')];

        $rule = new TwoPairs();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(4, 'H')];

        $rule = new TwoPairs();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
