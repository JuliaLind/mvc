<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightFlushScoredTraitTest extends TestCase
{
    use StraightFlushScoredTrait;
    use CountSuitAndRankTrait;

    public function testScoredNotOk(): void
    {
        $hand = ["6H", "2H", "4H", "5C", "3D"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredOk(): void
    {
        $hand = ["6H", "2H", "4H", "5H", "3H"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredNotOk2(): void
    {
        $hand = ["6H", "2H", "4H", "5H", "7D"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredOk2(): void
    {
        $hand = ["6H", "7H", "4H", "5H", "3H"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredOk3(): void
    {
        $hand = ["13C", "12C", "10C", "9C", "11C"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredNotOk4(): void
    {
        $hand = ["6H", "2H", "4H", "2C", "3D"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }


    public function testScoredOk4(): void
    {
        $hand = ["13H", "12H", "10H", "9H", "11H"];

        $res = $this->scored($hand);
        $this->assertTrue($res);
    }

    public function testScoredNotOk5(): void
    {
        $hand = ["6H", "7H", "4H", "5C", "3D"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }

    public function testScoredNotOk6(): void
    {
        $hand = ["13H", "12H", "10D", "9H", "11H"];

        $res = $this->scored($hand);
        $this->assertFalse($res);
    }

}
