<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = ["4D", "5D", "14D", "8D", "2D"];
        $rule = new Flush();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = ["4D", "5h", "14D", "8D", "2D"];
        $rule = new Flush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
