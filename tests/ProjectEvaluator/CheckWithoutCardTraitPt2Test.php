<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RoyalFlush;
use App\ProjectRules\StraightFlush;
use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;
use App\ProjectRules\Flush;
use App\ProjectRules\Straight;
use App\ProjectRules\TwoPairs;

use PHPUnit\Framework\TestCase;

class CheckWithoutCardTraitPt2Test extends TestCase
{
    use CheckWithoutCardTrait;

    protected function setUp(): void
    {
        $this->rules = [
            new RoyalFlush(),
            new StraightFlush(),
            new SameOfAKind(4),
            new FullHouse(),
            new Flush(),
            new Straight(),
            new SameOfAKind(3),
            new TwoPairs(),
            new SameOfAKind(2)
        ];

    }

    public function testHandRuleWithoutNotOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $hand = ["6C","6D","6H","7C","7D",];
        $hands = [
            2 => $hand
        ];

        $exp = "";
        $res = $this->handRuleWithout($hands, 2, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testHandRuleWithoutOk(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $hand = ["6C","6D", "7C","7D"];
        $hands = [
            2 => $hand
        ];

        $exp = "Full House";
        $res = $this->handRuleWithout($hands, 2, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testHandRuleWithoutOk2(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $hands = [];

        $exp = "Royal Flush";
        $res = $this->handRuleWithout($hands, 2, $deck);
        $this->assertEquals($exp, $res);
    }

    public function testHandRuleWithoutOk3(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "9D","10H","11S","11C","11D","12S","13S","14H","14S"];

        $hands = [];

        $exp = "Full House";
        $res = $this->handRuleWithout($hands, 2, $deck);
        $this->assertEquals($exp, $res);
    }
}
