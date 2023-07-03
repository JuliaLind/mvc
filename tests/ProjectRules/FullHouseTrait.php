<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullhouseTest extends TestCase
{
    public function testCreateObject(): void
    {
        $rule = new FullHouse();

        $res = $rule->getName();
        $exp = "Full House";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 25;
        $this->assertEquals($exp, $res);
    }
}
