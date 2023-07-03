<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SameOfAKindTest extends TestCase
{
    public function testOnePair(): void
    {
        $rule = new SameOfAKind(2);
        $res = $rule->getName();
        $exp = "One Pair";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 2;
        $this->assertEquals($exp, $res);
    }

    public function testThreeOfAKind(): void
    {
        $rule = new SameOfAKind(3);
        $res = $rule->getName();
        $exp = "Three Of A Kind";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 10;
        $this->assertEquals($exp, $res);
    }

    public function testFourOfAKind(): void
    {
        $rule = new SameOfAKind(4);
        $res = $rule->getName();
        $exp = "Four Of A Kind";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 50;
        $this->assertEquals($exp, $res);
    }
}
