<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class TwoPairsTest extends TestCase
{
    public function testCheckOk(): void
    {
        $rule = new TwoPairs();
        $hand = ["2H", "4D", "5D", "2D", "5C"];
        $this->assertTrue($rule->scored($hand));
    }

    public function testCheckOk2(): void
    {
        $rule = new TwoPairs();
        $hand = ["2H", "4D", "5D", "4D", "5C"];
        $this->assertTrue($rule->scored($hand));
    }


    public function testCheckNotOk(): void
    {
        $rule = new TwoPairs();
        $hand = ["2H", "4D", "5D", "6D", "5C"];
        $this->assertFalse($rule->scored($hand));
    }

    public function testCheckNotOk2(): void
    {
        $rule = new TwoPairs();
        $hand = ["2H", "4D", "5D", "6D", "7C"];
        $this->assertFalse($rule->scored($hand));
    }

    public function testCheckNotOk3(): void
    {
        $rule = new TwoPairs();
        $hand = ["2H", "4D", "5D", "7D", "7C"];
        $this->assertFalse($rule->scored($hand));
    }
}
