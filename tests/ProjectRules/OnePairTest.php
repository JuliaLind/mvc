<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class OnePairTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H')];
        $rule = new SameOfAKind(2);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }
}
