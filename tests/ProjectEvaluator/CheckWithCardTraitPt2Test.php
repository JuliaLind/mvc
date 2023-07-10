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

class CheckWithCardTraitPt2Test extends TestCase
{
    use CheckWithCardTrait;

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

    public function testHandRuleWithNotOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        $hand = ["6C","6D","6H","7C","7D",];
        $hands = [
            2 => $hand
        ];

        $exp = [
            'weight' => -200,
            'rule-with-card' => ""
        ];
        $res = $this->handRuleWith($hands, 2, $deck, $card);
        $this->assertEquals($exp, $res);
    }

    public function testHandRuleWithOk(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        $hand = ["6C","6D", "7C","7D"];
        $hands = [
            2 => $hand
        ];

        $exp = [
            'weight' => 0,
            'rule-with-card' => ""
        ];
        $res = $this->handRuleWith($hands, 2, $deck, $card);
        $this->assertEquals($exp, $res);
    }

    public function testHandRuleWithOk2(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        // $hand = ["6C","6D", "7C","7D"];
        $hands = [];

        $exp = [
            'weight' => 25.5,
            'rule-with-card' => "Full House"
        ];
        $res = $this->handRuleWith($hands, 2, $deck, $card);
        $this->assertEquals($exp, $res);
    }

    public function testHandRuleWithOk3(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "9D","10H","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10S";

        $hands = [];

        $exp = [
            'weight' => 100.5,
            'rule-with-card' => "Royal Flush"
        ];
        $res = $this->handRuleWith($hands, 2, $deck, $card);
        $this->assertEquals($exp, $res);
    }
}
