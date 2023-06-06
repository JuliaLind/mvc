<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class FlushTest extends TestCase
{
    public function testCheckOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(5, 'D'), new Card(14, 'D'), new Card(8, 'D'), new Card(2, 'D')];
        $rule = new Flush();
        $res = $rule->check($hand);
        $this->assertTrue($res);
    }

    public function testCheckNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(5, 'h'), new Card(14, 'D'), new Card(8, 'D'), new Card(2, 'D')];
        $rule = new Flush();
        $res = $rule->check($hand);
        $this->assertFalse($res);
    }
}
