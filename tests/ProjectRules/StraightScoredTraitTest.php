<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightScoredTraitTest extends TestCase
{
    use StraightScoredTrait;
    use CountByRankTrait;

    public function testScoredOk(): void
    {
        $hand = ["6H", "2H", "4H", "5C", "3D"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredNotOk(): void
    {
        $hand = ["6H", "2H", "4H", "2C", "3D"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredNotOk2(): void
    {
        $hand = ["6H", "2H", "4H", "5C", "7D"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredOk2(): void
    {
        $hand = ["6H", "7H", "4H", "5C", "3D"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredOk3(): void
    {
        $hand = ["13H", "12H", "10H", "9C", "11D"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }
}
