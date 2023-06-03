<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

/**
 * Test cases for class Royal Flush.
 */
class FourOfAKindTest extends TestCase
{
    public function testScoreOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $rule = new FourOfAKind();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "Four Of A Kind",
            'points' => 50,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoreOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(4, 'C'), new Card(4, 'S')];

        $rule = new FourOfAKind();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "Four Of A Kind",
            'points' => 50,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoreNotOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(4, 'S')];
        $rule = new FourOfAKind();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }

    public function testScoreNotOk2(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(5, 'C'), new Card(5, 'S'), new Card(4, 'S')];
        $rule = new FourOfAKind();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }


    public function testScoreNotOk3(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H'), new Card(4, 'S')];
        $rule = new FourOfAKind();
        $res = $rule->scored($hand);
        $this->assertFalse($res['scored']);
    }
}
