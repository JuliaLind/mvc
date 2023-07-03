<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RoyalFLushScoredTraitTest extends TestCase
{
    use RoyalFlushScoredTrait;
    use CountSuitAndRankTrait;


    public function testScoredNotOk(): void
    {
        $cards = ["11H", "8H", "9H", "10H", "12H"];
        $res = $this->scored($cards);
        $this->assertFalse($res);
    }

    public function testScoredNotOk2(): void
    {
        $cards = ["13H", "12H", "11H", "10H", "9H"];
        $res = $this->scored($cards);
        $this->assertFalse($res);
    }

    public function testScoredNotOk3(): void
    {
        $cards = ["13H", "12H", "11D", "10H", "14H"];
        $res = $this->scored($cards);
        $this->assertFalse($res);
    }

    public function testScoredOk(): void
    {
        $cards = ["13H", "12H", "11H", "10H", "14H"];
        $res = $this->scored($cards);
        $this->assertTrue($res);
    }


}
