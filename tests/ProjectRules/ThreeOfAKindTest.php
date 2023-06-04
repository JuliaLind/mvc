<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class ThreeOfAKindTest extends TestCase
{
    public function testScoreOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'H'), new Card(4, 'C'), new Card(8, 'S')];

        $rule = new ThreeOfAKind();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "Three Of A Kind",
            'points' => 10,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoreOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'C'), new Card(4, 'S')];

        $rule = new ThreeOfAKind();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "Three Of A Kind",
            'points' => 10,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoreNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(9, 'S')];
        $rule = new ThreeOfAKind();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(5, 'S'), new Card(9, 'S')];
        $rule = new ThreeOfAKind();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }
}
