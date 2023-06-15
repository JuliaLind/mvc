<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = ["4D", "4H", "5D", "4C", "5H"];
        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = ["4D", "8D", "4C", "4H", "5H"];
        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = ["5D", "4C", "4H", "5H"];

        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $hand = ["5D", "4C", "4H", "3H", "5H"];

        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
