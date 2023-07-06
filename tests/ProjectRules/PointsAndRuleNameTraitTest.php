<?php

namespace App\ProjectRules;

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
            'points' => -1,
            'rule' => ""
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
            'points' => 29,
            'rule' => "Full House"
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
            'points' => 28,
            'rule' => "Full House"
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
            'points' => 0,
            'rule' => ""
        ];
        $res = $this->pointsAndName($hand, $deck, $card, $rule);
        $this->assertEquals($exp, $res);
    }

    // public function testPointsAndNameEmptyHandOk3(): void
    // {
    //     $deck = ["2H","3S","3D","6H","9S", "9D","10S","11S","11C","11D","12S","6D","14H","14S"];
    //     $card = "7C";
    //     $hand = ["6C","13S","7D"];
    //     $rule = new TwoPairs();

    //     $exp = [
    //         'points' => 7,
    //         'rule' => "Two Pairs"
    //     ];
    //     $res = $this->pointsAndName($hand, $deck, $card, $rule);
    //     $this->assertEquals($exp, $res);
    // }
}
