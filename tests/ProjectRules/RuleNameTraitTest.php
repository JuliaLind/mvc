<?php

namespace App\ProjectRules;

use PHPUnit\Framework\TestCase;

class RuleNameTraitTest extends TestCase
{
    use RuleNameTrait;

    public function testPointsAndNameEmptyHandNotOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $hand = ["6C","6D","6H","7C","7D",];
        $rule = new FullHouse();

        $exp = "";
        $res = $this->ruleName($hand, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk(): void
    {
        $deck = ["2H","3S","3D","7S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        ;
        $hand = ["6C","6D","6H", "7D",];
        $rule = new FullHouse();

        $exp = "Full House";
        $res = $this->ruleName($hand, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk2(): void
    {
        $deck = ["2H","7S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $hand = ["6C","6D","7D",];
        $rule = new FullHouse();

        $exp = "Full House";
        $res = $this->ruleName($hand, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandNotOk2(): void
    {
        $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","6D","14H","14S"];
        $hand = ["6C","13S","7D",];
        $rule = new FullHouse();

        $exp = "";
        $res = $this->ruleName($hand, $deck, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk3(): void
    {
        $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","13D","14H","14S"];
        $hand = ["6C","13S","7D"];
        $rule = new TwoPairs();

        $exp = "Two Pairs";
        $res = $this->ruleName($hand, $deck, $rule);
        $this->assertEquals($exp, $res);
    }
}
