<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class OneRoundTraitTest extends TestCase
{
    use OneRoundTrait;
    use PlayerSuggestTrait;
    use HousePlaceCardTrait;
    use SuggestMessageTrait;

    public function testOneRoundNotFinished(): void
    {
        $playerPossible = ["2H","2S","3H","3S","3D","4H","4C","5D","5S", "12H","12S","13H"];
        $housePossible = ["5C","7H","8D","8H","9C","10S","10H","11H","11C","13D","14D","14S"];
        $card ="5H";
        $row = 1;
        $col = 3;

        $deck = $this->createMock(Deck::class);
        $deck->method('deal')->will($this->onConsecutiveCalls("10D", "8H"));
        $deck->method('possibleCards')->will($this->onConsecutiveCalls(
            $playerPossible,
            $housePossible
        ));

        $house = $this->createMock(Grid::class);
        $house->method('getCardCount')->willReturn(24);

        $player = $this->createMock(Grid::class);
        $player->expects($this->once())
        ->method('addCard')->with($row, $col, $card);
        $house->expects($this->once())
        ->method('addCard')->with(2, 1, "10D");

        $houseSuggestion = [
            'row-rule' => "One Pair",
            'col-rule' => "Two Pairs",
            'slot' => [2, 1],
            //.... rest not needed in this test
        ];
        $playerSuggestion = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 4],
            //.... rest not needed in this test
        ];

        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->exactly(2))->method('suggestion')->will($this->onConsecutiveCalls($houseSuggestion, $playerSuggestion));

        $playerSuggestion['message'] = "Place card in row 0 column 4 for possible Full House horizontally and/or Full House vertically.";
        $this->card = $card;
        $this->evaluator = $evaluator;
        $this->house = $house;
        $this->player = $player;
        $this->deck = $deck;

        $res = $this->oneRound($row, $col);
        $this->assertFalse($res);
        $this->assertEquals([1, 3], $this->lastRound['player']);
        $this->assertEquals([2, 1], $this->lastRound['house']);
        $this->assertEquals("8H", $this->card);
        $this->assertEquals($playerSuggestion, $this->suggestion);
        $this->assertFalse($this->finished);
    }

    public function testOneRoundFinished(): void
    {
        $playerPossible = ["2H","2S","3H","3S","3D","4H","4C","5D","5S", "12H","12S","13H"];
        $housePossible = ["5C","7H","8D","8H","9C","10S","10H","11H","11C","13D","14D","14S"];
        $card ="5H";
        $row = 1;
        $col = 3;

        $deck = $this->createMock(Deck::class);
        $deck->method('deal')->will($this->onConsecutiveCalls("10D", "8H"));
        $deck->method('possibleCards')->will($this->onConsecutiveCalls(
            $playerPossible,
            $housePossible
        ));

        $house = $this->createMock(Grid::class);
        $house->method('getCardCount')->willReturn(25);

        $player = $this->createMock(Grid::class);
        $player->expects($this->once())
        ->method('addCard')->with($row, $col, $card);
        $house->expects($this->once())
        ->method('addCard')->with(2, 1, "10D");

        $houseSuggestion = [
            'row-rule' => "One Pair",
            'col-rule' => "Two Pairs",
            'slot' => [2, 1],
            //.... rest not needed in this test
        ];
        $playerSuggestion = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 4],
            //.... rest not needed in this test
        ];

        $evaluator = $this->createMock(RuleEvaluator::class);
        $evaluator->expects($this->once())->method('suggestion')->willReturn($houseSuggestion);

        $playerSuggestion['message'] = "Place card in row 0 column 4 for possible Full House horizontally and/or Full House vertically.";
        $this->card = $card;
        $this->evaluator = $evaluator;
        $this->house = $house;
        $this->player = $player;
        $this->deck = $deck;

        $res = $this->oneRound($row, $col);
        $this->assertTrue($res);
        $this->assertEquals([1, 3], $this->lastRound['player']);
        $this->assertEquals([2, 1], $this->lastRound['house']);
        $this->assertEquals("8H", $this->card);
        $this->assertTrue($this->finished);
    }
}
