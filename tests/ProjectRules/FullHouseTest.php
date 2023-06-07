<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FullHouseTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'D'), new Card(4, 'C'), new Card(5, 'H')];

        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'D'), new Card(4, 'C'), new Card(4, 'H'), new Card(5, 'H')];

        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk2(): void
    {
        $hand = [new Card(5, 'D'), new Card(4, 'C'), new Card(4, 'H'), new Card(5, 'H')];

        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }

    public function testCheckNotOk3(): void
    {
        $hand = [new Card(5, 'D'), new Card(4, 'C'), new Card(4, 'H'), new Card(3, 'H'), new Card(5, 'H')];

        $rule = new FullHouse();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}