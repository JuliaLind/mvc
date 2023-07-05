<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RoyalFlushTrait3Test extends TestCase
{
    use RoyalFlushTrait3;

    public function testCheckForCardsNotOk(): void
    {
        $cards = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $minRank = 6;
        $suit = "D";
        $res = $this->checkForCards($cards, $minRank, $suit);
        $this->assertFalse($res);
    }

    public function testCheckForCardsOk(): void
    {
        $cards = ["2H","3S","10D","6C","6D","6H","7C","7D","9S", "8D","10S","11S","11C","9D","12S","13S","14H","14S"];
        $minRank = 6;
        $suit = "D";
        $res = $this->checkForCards($cards, $minRank, $suit);
        $this->assertTrue($res);
    }

    public function testCheckForCardsOk2(): void
    {
        $cards = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $minRank = 10;
        $suit = "S";
        $res = $this->checkForCards($cards, $minRank, $suit);
        $this->assertTrue($res);
    }

    public function testCheckForCardsNotOk2(): void
    {
        $cards = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S", "11C","11D","12S","13S","14H","14S"];
        $minRank = 10;
        $suit = "S";
        $res = $this->checkForCards($cards, $minRank, $suit);
        $this->assertFalse($res);
    }
}
