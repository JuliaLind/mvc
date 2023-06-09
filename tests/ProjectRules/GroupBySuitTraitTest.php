<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class GroupBySuitTraitTest extends TestCase
{
    use GroupBySuitTrait;

    public function testGroupBySuit(): void
    {
        $cards = ["14H", "8D", "4C", "8C", "14S", "10S", "5C", "8S"];
        $exp = [
            "H" => [14],
            "D" => [8],
            "C" => [4, 8, 5],
            "S" => [14, 10, 8]
        ];
        $res = $this->groupBySuit($cards);
        $this->assertEquals($exp, $res);
    }

    public function testGroupBySuit2(): void
    {
        $cards = [
                    "10D",
                    "9D",
                    "8D",
                    "7D"
                ];
        $exp = [
            "D" => [10, 9, 8, 7],
        ];
        $res = $this->groupBySuit($cards);
        $this->assertEquals($exp, $res);
    }
}
