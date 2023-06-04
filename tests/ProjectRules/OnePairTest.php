<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;

class OnePairTest extends TestCase
{
    public function testScoreOk(): void
    {
        $hand = [new Card(4, 'D'), new Card(4, 'H')];

        $rule = new OnePair();
        $res = $rule->scored($hand);
        $exp = [
            'name' => "One Pair",
            'points' => 2,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }
}
