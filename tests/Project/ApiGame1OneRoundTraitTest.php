<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

use PHPUnit\Framework\TestCase;

class ApiGame1OneRoundTraitTest extends TestCase
{
    use ApiGame1OneRoundTrait;

    public function testOneRound(): void
    {
        $factory = $this->createMock(CardFactory::class);
        $cards = ["12S","3D","2D","13S","6C","9H","4C","8D","3C","10C","11C","13C","10S","5D","8C","5S","6S","6D","3H","3S","13H","14S","14C","5C","2H","4S","12C","4D","5H","8H","9C","13D","9S","4H","12D","11S","14D","7S","11D","10D","14H","10H","8S","9D","2C", "7C"];
        $factory->method('fullSet')->willReturn($cards);
        $this->deck = new Deck($factory);

        $grid = new Grid();
        $grid->addCard(0, 0, "11H");
        $grid->addCard(0, 4, "2S");
        $grid->addCard(4, 4, "7D");
        $grid->addCard(4, 0, "12H");
        $grid->addCard(3, 3, "6H");
        $grid->addCard(3, 4, "7H");

        $this->grid = $grid;

        $suggestion = [
           "col-rule" => "Four Of A Kind",
           "row-rule" => "Full House",
           "slot" => ["row" => 2,"col" => 4],
           "tot-weight-slot" => 77.5,
           "row-rules" => [
                ["rule-with-card" => "Two Pairs","weight" => -0.25,"rule-without-card" => "Full House"],
                ["rule-with-card" => "Full House","weight" => 25.5,"rule-without-card" => "Royal Flush"],
                ["rule-with-card" => "Full House","weight" => 25.5,"rule-without-card" => "Royal Flush"],
                ["rule-with-card" => "Three Of A Kind","weight" => 11,"rule-without-card" => "Straight Flush"],
                ["rule-with-card" => "Full House","weight" => 27,"rule-without-card" => "Three Of A Kind"]
            ],
            "col-rules" => [
                ["rule-with-card" => "Two Pairs","weight" => -0.25,"rule-without-card" => "Full House"],
                ["rule-with-card" => "Full House","weight" => 25.5,"rule-without-card" => "Royal Flush"],
                ["rule-with-card" => "Full House","weight" => 25.5,"rule-without-card" => "Royal Flush"],
                ["rule-with-card" => "Straight","weight" => 16,"rule-without-card" => "Flush"],
                ["rule-with-card" => "Four Of A Kind","weight" => 52,"rule-without-card" => "Full House"]
            ]
        ];

        $exp = [
            'placed cards' => 7,
            "picked card" => "7C",
            "suggestion" => $suggestion,
            "grid" => $grid,
            "possible cards" => ["4D","5H","8H","9C","13D","9S","4H","12D","11S","14D","7S","11D","10D","14H","10H","8S","9D","2C"],
            "remaining cards in deck" => $this->deck,
        ];

        $res = $this->oneRound();
        $this->assertEquals($exp, $res);
        $this->assertEquals(
            [
                "12S","3D","2D","13S","6C","9H","4C","8D","3C","10C",
                "11C","13C","10S","5D","8C","5S","6S","6D","3H","3S",
                "13H","14S","14C","5C","2H","4S","12C",
                "4D","5H","8H","9C","13D","9S","4H","12D","11S","14D","7S","11D","10D","14H","10H","8S","9D","2C"
            ],
            $this->deck->getcards()
        );
    }

    public function testOneRound2(): void
    {
        $grid = $this->createMock(Grid::class);
        $grid->method('getCardCount')->willReturn(25);
        $this->grid = $grid;

        $factory = $this->createMock(CardFactory::class);
        $cards = ["12S","3D","2D","13S"];
        $factory->method('fullSet')->willReturn($cards);
        $this->deck = new Deck($factory);


        $this->oneRound();
        $this->assertEquals(1, $this->grid->getCardCount());
        $this->assertEquals(51, count($this->deck->getCards()));
    }
}
