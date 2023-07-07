<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\SameOfAKind;
use App\ProjectRules\FullHouse;


use PHPUnit\Framework\TestCase;

class CheckWithoutCardTraitTest extends TestCase
{
    use CheckWithoutCardTrait;

    public function testCheckSingleRuleWithoutNotOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $hand = ["6C","6D","6H","7C","7D",];
        $hands = [
            2 => $hand
        ];
        $rule = new FullHouse();

        $exp = "";
        $res = $this->checkSingleRuleWithout($hands, 2, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithoutOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];

        $hand = ["6C","6D","6H","7C","7D",];
        $hands = [
            2 => $hand
        ];
        $rule = new FullHouse();

        $exp = "Full House";
        $res = $this->checkSingleRuleWithout($hands, 3, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithoutNotOk2(): void
    {
        $deck = ["2H","3S","3D","9S", "7C", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];

        $hand = ["6C","6D","6H","7D",];
        $hands = [
            3 => $hand
        ];
        $rule = new FullHouse();

        $exp = "Full House";
        $res = $this->checkSingleRuleWithout($hands, 3, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithoutOk2(): void
    {
        $deck = ["2H","3S","3D","6S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];

        $hand = ["6C","6D","7D"];
        $hands = [
            3 => $hand
        ];
        $rule = new SameOfAKind(3);

        $exp = "Three Of A Kind";
        $res = $this->checkSingleRuleWithout($hands, 3, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testCheckSingleRuleWithoutOk3(): void
    {
        $deck = ["2H","3S","3D","9S", "6H", "7C", "9D","10S","11S","11C","11D","12S","13S","14H", "6C", "14S"];

        $hand = ["6C","6D","7D"];
        $hands = [
            3 => $hand
        ];
        $rule = new SameOfAKind(4);

        $exp = "Four Of A Kind";
        $res = $this->checkSingleRuleWithout($hands, 3, $deck, $rule);
        $this->assertEquals($exp, $res);
    }
}
