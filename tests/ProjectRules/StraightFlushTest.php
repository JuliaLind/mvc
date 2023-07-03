<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightFlushTest extends TestCase
{
    public function testCreateObject(): void
    {
        $rule = new StraightFlush();
        $res = $rule->getName();
        $exp = "Straight Flush";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 75;
        $this->assertEquals($exp, $res);
    }
}
