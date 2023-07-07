<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class CheckWithCardTraitTest extends TestCase
{
    use CheckWithCardTrait;

    public function testCheckSingleRuleWithNotOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        $hand = ["6C","6D","6H","7C","7D",];
        $hands = [
            2 => $hand
        ];
        $rule = new FullHouse();

        $exp = [
            'points' => -1,
            'rule' => ""
        ];
        $res = $this->checkSingleRuleWith($hands, 2, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10H","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10S";
        $hand = ["6C","6D","6H","7C","7D",];
        $hands = [
            2 => $hand
        ];
        $rule = new RoyalFlush();

        $exp = [
            'points' => 100.5,
            'rule' => "Royal Flush"
        ];
        $res = $this->checkSingleRuleWith($hands, 3, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithNotOk2(): void
    {
        $deck = ["2H","3S","3D","9S", "7C", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        $hand = ["6C","6D","6H","7D",];
        $hands = [
            3 => $hand
        ];
        $rule = new FullHouse();

        $exp = [
            'points' => 0,
            'rule' => ""
        ];
        $res = $this->checkSingleRuleWith($hands, 3, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithOk2(): void
    {
        $deck = ["2H","3S","3D","9S", "7C", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "6H";
        $hand = ["6C","6D","7D",];
        $hands = [
            3 => $hand
        ];
        $rule = new FullHouse();

        $exp = [
            'points' => 28,
            'rule' => "Full House"
        ];
        $res = $this->checkSingleRuleWith($hands, 3, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }
}
