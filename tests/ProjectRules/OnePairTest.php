<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class OnePairTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = ["4D", "4H"];
        $rule = new SameOfAKind(2);
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }
}
