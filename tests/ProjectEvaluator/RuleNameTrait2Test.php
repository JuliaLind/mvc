<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\RoyalFlush;
use PHPUnit\Framework\TestCase;

class RuleNameTrait2Test extends TestCase
{
    use RuleNameTrait2;

    public function testPointsAndNameEmptyHandNotOk(): void
    {
        $deck = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11H","11C","11D","12S","13S","14H","14S"];
        $rule = new RoyalFlush();

        $exp = "";
        $res = $this->ruleNameEmptyHand($deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk(): void
    {
        $deck = ["2H","3S","3D","6C","6D","6H","7C","7D","9S", "9D","10S","11S","11H","11D", "10H", "13H", "12H","14H","14S"];
        $rule = new RoyalFlush();

        $exp = "Royal Flush";
        $res = $this->ruleNameEmptyHand($deck, $rule);
        $this->assertEquals($exp, $res);
    }
}
