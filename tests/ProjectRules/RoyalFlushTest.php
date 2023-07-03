<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RoyalFlushTest extends TestCase
{
    public function testCreateObject(): void
    {
        $rule = new RoyalFlush();

        $res = $rule->getName();
        $exp = "Royal Flush";
        $this->assertEquals($exp, $res);

        $res = $rule->getPoints();
        $exp = 100;
        $this->assertEquals($exp, $res);
    }
}
