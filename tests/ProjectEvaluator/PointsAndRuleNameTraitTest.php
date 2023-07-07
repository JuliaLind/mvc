<?php

namespace App\ProjectEvaluator;

use App\ProjectRules\FullHouse;
use App\ProjectRules\TwoPairs;


use PHPUnit\Framework\TestCase;

class PointsAndRuleNameTraitTest extends TestCase
{
    use PointsAndRuleNameTrait;

    public function testPointsAndNameEmptyHandNotOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "10H";
        $hand = ["6C","6D","6H","7C","7D",];
        $rule = new FullHouse();

        $exp = [
            'weight' => -200,
            'rule-with-card' => ""
        ];
        $res = $this->pointsAndName($hand, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk(): void
    {
        $deck = ["2H","3S","3D","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "7C";
        $hand = ["6C","6D","6H", "7D",];
        $rule = new FullHouse();

        $exp = [
            'weight' => 29,
            'rule-with-card' => "Full House"
        ];
        $res = $this->pointsAndName($hand, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk2(): void
    {
        $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","13S","14H","14S"];
        $card = "7C";
        $hand = ["6C","6D","7D",];
        $rule = new FullHouse();

        $exp = [
            'weight' => 28,
            'rule-with-card' => "Full House"
        ];
        $res = $this->pointsAndName($hand, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandNotOk2(): void
    {
        $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","6D","14H","14S"];
        $card = "7C";
        $hand = ["6C","13S","7D",];
        $rule = new FullHouse();

        $exp = [
            'weight' => 0,
            'rule-with-card' => ""
        ];
        $res = $this->pointsAndName($hand, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    public function testPointsAndNameEmptyHandOk3(): void
    {
        $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","6D","14H","14S"];
        $card = "7C";
        $hand = ["6C","13S","7D"];
        $rule = new TwoPairs();

        $exp = [
            'weight' => 7,
            'rule-with-card' => "Two Pairs"
        ];
        $res = $this->pointsAndName($hand, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }
}
