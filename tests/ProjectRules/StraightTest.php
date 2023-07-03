<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightTest extends TestCase
{
    public function testCreateObject(): void
    {
        $rule = new Straight();
        $res = $rule->getName();
        $exp = "Straight";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 15;
        $this->assertEquals($exp, $res);
    }
}
