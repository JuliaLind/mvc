<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class CountBySuitTraitTest extends TestCase
{
    use CountBySuitTrait;

    public function testCountBySuit(): void
    {
        $cards = [];
        $res = $this->countBySuit($cards);
        $this->assertEquals([], $res);
    }

    public function testCountBySuit2(): void
    {
        $cards = ["14H", "8D", "4C", "8C", "14S", "10S", "5C", "8S"];
        $exp = [
            "H" => 1,
            "D" => 1,
            "C" => 3,
            "S" => 3
        ];
        $res = $this->countBySuit($cards);
        $this->assertEquals($exp, $res);
    }
}
