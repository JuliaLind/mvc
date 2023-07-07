<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RoyalFlush;

use PHPUnit\Framework\TestCase;

class PointsAndRuleNameTrait2Test extends TestCase
{
    use PointsAndRuleNameTrait2;

    public function testPointsAndNameEmptyHandNotOk(): void
    {
        $deck = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        $rule = new RoyalFlush();

        $exp = [
            'weight' => 0.5,
            'rule-with-card' => ""
        ];
        $res = $this->pointsAndNameEmptyHand($deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk(): void
    {
        $deck = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11S","11H","11D", "10H", "12H","14H","14S"];
        $card = "13H";
        $rule = new RoyalFlush();

        $exp = [
            'weight' => 100.5,
            'rule-with-card' => "Royal Flush"
        ];
        $res = $this->pointsAndNameEmptyHand($deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }
}
