<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class SearchSpecificCardTraitTest extends TestCase
{
    use SearchSpecificCardTrait;


    public function testSearchSpecificCardOk(): void
    {
        $cards = ["8C", "14S", "14H", "10S"];
        $rank = 14;
        $suit = "H";

        $res = $this->searchSpecificCard($cards, $rank, $suit);
        $this->assertTrue($res);
    }

    public function testSearchSpecificCardOk2(): void
    {
        $cards = ["8C", "14S", "14H", "10S"];
        $rank = 10;
        $suit = "S";

        $res = $this->searchSpecificCard($cards, $rank, $suit);
        $this->assertTrue($res);
    }

    public function testSearchSpecificCardNotOk(): void
    {
        $cards = ["8C", "14S", "14H", "10S"];
        $rank = 11;
        $suit = "S";

        $res = $this->searchSpecificCard($cards, $rank, $suit);
        $this->assertFalse($res);
    }

    public function testSearchSpecificCardNotOk2(): void
    {
        $cards = ["8C", "14S", "14H", "10S"];
        $rank = 14;
        $suit = "C";

        $res = $this->searchSpecificCard($cards, $rank, $suit);
        $this->assertFalse($res);
    }
}
