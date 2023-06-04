<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;
use App\ProjectCard\Card;
use App\ProjectCard\CardCounter;

/**
 * Test cases for class Royal Flush.
 */
class SameRankTraitTest extends TestCase
{
    use SameRankTrait;


    protected function setUp(): void
    {
        $this->cardCounter= new CardCounter();
        $this->minCountRank = 2;
        $this->points = 5;
        $this->name = "Test Rule";
    }

    public function testScoredOk(): void
    {
        $hand = [new Card(5, 'S'), new Card(8, 'C'), new Card(5, 'D')];
        $res = $this->scored($hand);
        $exp = [
            'name' => 'Test Rule',
            'points' => 5,
            'scored' => true
        ];
        $this->assertEquals($exp, $res);
    }

    public function testScoredNotOk(): void
    {
        $hand = [new Card(7, 'S'), new Card(8, 'C'), new Card(5, 'D')];
        $res = $this->scored($hand);
        $exp = [
            'name' => 'Test Rule',
            'points' => 5,
            'scored' => false
        ];
        $this->assertEquals($exp, $res);
    }
}
