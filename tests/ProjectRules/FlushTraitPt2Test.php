<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushTraitPt2Test extends TestCase
{
    use CountBySuitTrait;
    use FlushTrait;


    public function testPossibleWithoutCardNotOk(): void
    {
        $deck = ["14C", "8D", "5H"];
        $hand = ["8H", "2S", "4H", "7H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardNotOk2(): void
    {
        $deck = ["14C", "8D", "5D"];
        $hand = ["8H", "2H", "4H", "7H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }

    public function testPossibleWithoutCardOk(): void
    {
        $deck = ["14C", "9H", "5D"];
        $hand = ["8H", "2H", "4H", "7H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }

    public function testPossibleWithoutCardOk2(): void
    {
        $deck = ["14C", "9H", "5D", "2H", "4H", "7H"];
        $hand = ["8H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertTrue($res);
    }
}
