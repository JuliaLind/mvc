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

class BestPossibleRulesTraitTest extends TestCase
{
    use BestPossibleRulesTrait;

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

    public function testAdjustPriorityOk(): void
    {
        $ruleWithCard = "Three Of A Kind";
        $ruleWithoutCard = "One Pair";
        $weightPoints = 12;
        $handNotEmpty = true;
        $res = $this->adjustPriority($ruleWithCard, $ruleWithoutCard, $weightPoints, $handNotEmpty);
        $exp = 12;
        $this->assertEquals($exp, $res);
    }

    public function testAdjustPriorityNotOk(): void
    {
        $ruleWithCard = "One Pair";
        $ruleWithoutCard = "Three Of A Kind";
        $weightPoints = 12;
        $handNotEmpty = true;
        $res = $this->adjustPriority($ruleWithCard, $ruleWithoutCard, $weightPoints, $handNotEmpty);
        $exp = -0.1;
        $this->assertEquals($exp, $res);
    }

    public function testAdjustPriority2Notok(): void
    {
        $ruleWithCard = "Straight Flush";
        $ruleWithoutCard = "Royal Flush";
        $weightPoints = 75;
        $res = $this->adjustPriority2($ruleWithCard, $ruleWithoutCard, $weightPoints);
        $exp = -90;
        $this->assertEquals($exp, $res);
    }

    public function testAdjustPriorityNotOk2(): void
    {
        $ruleWithCard = "One Pair";
        $ruleWithoutCard = "Three Of A Kind";
        $weightPoints = 12;
        $handNotEmpty = false;
        $res = $this->adjustPriority($ruleWithCard, $ruleWithoutCard, $weightPoints, $handNotEmpty);
        $exp = 0.4;
        $this->assertEquals($exp, $res);
    }

    public function testRulesHandsOk(): void
    {

        $card = "14H";
        $hands = [
            0 => [
                0 => "10D",
                4 => "10S",
                2 => "10H",
                3 => "6S"
            ],
            4 => [
                3 => "7S",
                0 => "14D",
            ]
        ];
        $deck = ["2C","3S","3H","4H","4C","4S","5S","6H","6C","7C","7D","8S","8D","11D","11C","12D","12C","13D"];

        $exp = [
            'max' => 27,
            'bestHand' => 4,
            'allRules' => [
                0 => [
                    'rule-with-card' => "",
                    'weight' => -0.25,
                    'rule-without-card' => "Full House"
                ],
                1 => [
                    'rule-with-card' => "",
                    'weight' => 0.25,
                    'rule-without-card' => "Full House"
                ],
                2 => [
                    'rule-with-card' => "",
                    'weight' => 0.25,
                    'rule-without-card' => "Full House"
                ],
                3 => [
                    'rule-with-card' => "",
                    'weight' => 0.25,
                    'rule-without-card' => "Full House"
                ],
                4 => [
                    'rule-with-card' => "Full House",
                    'weight' => 27,
                    'rule-without-card' => "Three Of A Kind"
                ]
            ],
        ];
        $res = $this->rulesHands($hands, $deck, $card);
        $this->assertEquals($exp, $res);
    }
}
