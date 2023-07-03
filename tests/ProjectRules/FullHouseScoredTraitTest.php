<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FullHouseScoredTraitTest extends TestCase
{
    use FullHouseScoredTrait;
    use CountByRankTrait;


    public function testScoredNotOk(): void
    {
        $cards = ["14H", "8D", "8H", "8C", "8S"];
        $res = $this->scored($cards);
        $this->assertFalse($res);
    }

    public function testScoredNotOk2(): void
    {
        $cards = ["14H", "8D", "8H", "8C", "9S"];
        $res = $this->scored($cards);
        $this->assertFalse($res);
    }

    public function testScoredOk(): void
    {
        $cards = ["9H", "8D", "8H", "8C", "9S"];
        $res = $this->scored($cards);
        $this->assertTrue($res);
    }
}
