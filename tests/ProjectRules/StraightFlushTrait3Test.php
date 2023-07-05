<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class StraightFlushTrait3Test extends TestCase
{
    use StraightFlushTrait3;
    use StraightTrait3;
    use GroupBySuitTrait;

    public function testPossibleDeckOnlyNotOk(): void
    {

        $deck = [
            "9D",
            "10S",
            "12H",
            "14H",
            "11S",
            "14S"
        ];
        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }

    public function testPossibleDeckOnlyNotOk2(): void
    {

        $deck = [
            "9D",
            "10S",
            "12H",
            "6D",
            "14H",
            "11S",
            "8H",
            "14S"
        ];
        $res = $this->possibleDeckOnly($deck);
        $this->assertFalse($res);
    }
}
