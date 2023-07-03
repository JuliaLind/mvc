<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushTrait2Test extends TestCase
{
    use FlushTrait2;
    use CountBySuitTrait;

    public function testPossibleDeckOnlyNotOk(): void
    {
        $deck = ["8S", "2S", "4H", "7H", "8H", "3S", "5H"];
        $this->assertFalse($this->possibleDeckOnly($deck));
    }

    public function testPossibleDeckOnlyOk(): void
    {
        $deck = ["8H", "2S", "4H", "7H", "8H", "3S", "5H"];
        $this->assertTrue($this->possibleDeckOnly($deck));
    }
}
