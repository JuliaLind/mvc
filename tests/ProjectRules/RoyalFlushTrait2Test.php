<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RoyalFlushTrait2Test extends TestCase
{
    use RoyalFlushTrait2;



    public function testpossibleDeckOnlyOk(): void
    {
        $cards = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $res = $this->possibleDeckOnly($cards);
        $this->assertTrue($res);
    }

    public function testpossibleDeckOnlyNotOk(): void
    {
        $cards = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11C","11D","12S","13S","14H","14S"];
        $res = $this->possibleDeckOnly($cards);
        $this->assertFalse($res);
    }

}
