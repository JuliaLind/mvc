<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class FlushTraitTest extends TestCase
{
    use CountBySuitTrait;
    use FlushTrait;


    public function testPossibleWithoutCard(): void
    {
        $hand = ["14C", "8D", "5H"];
        $deck = ["8S", "2S", "4H", "7H"];

        $res = $this->possibleWithoutCard($hand, $deck);
        $this->assertFalse($res);
    }
}
