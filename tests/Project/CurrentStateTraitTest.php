<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

class CurrentStateTraitTest extends TestCase
{
    use CurrentStateTrait;


    public function testCurrentState(): void
    {
        $this->pot = 200;
        $this->card = "5H";
        $suggestion = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 4],
            //.... rest not needed in this test
        ];
        $houseCards = ['card1', 'card2', 'card3'];
        $playerCards = ['card4', 'card5', 'card6'];
        $this->suggestion = $suggestion;
        $house = $this->createMock(Grid::class);
        $house->method('graphic')->willReturn($houseCards);
        $player = $this->createMock(Grid::class);
        $player->method('graphic')->willReturn($playerCards);
        $player->method('getCardCount')->willreturn(14);
        $fromSlot = [1, 4];
        $lastRound = [
            'player' => [2, 3],
            'house' => [3, 0]
        ];
        $this->fromSlot = $fromSlot;
        $this->lastRound = $lastRound;
        $deck = $this->createMock(Deck::class);
        $deck->method('getCards')->willReturn(['card7', 'card8', 'card9', 'card10', 'card11', 'card12']);
        $possibleCards = ['card9','card11'];
        $deck->method('possibleCards')->willReturn($possibleCards);
        $this->deck = $deck;
        $this->player = $player;
        $this->house = $house;
        $exp = [
            'bet' => $this->pot,
            'card' => [
                'img' => "img/project/cards/5H.svg",
                'alt' => "5H"
            ],
            'message' => "",
            'suggestion' => $suggestion,
            'results' => [],
            'house' => $houseCards,
            'player' => $playerCards,
            'placedCards' => 14,
            'fromSlot' => $fromSlot,
            'finished' => false,
            'deckCardCount' => 6,
            'playerPossibleCards' => $possibleCards,
            'lastRound' => $lastRound,
        ];
        $res = $this->currentState();
        $this->assertEquals($exp, $res);
    }

    public function testCurrentStateApi(): void
    {
        $this->pot = 200;
        $this->card = "5H";
        $suggestion = [
            'row-rule' => "Full House",
            'col-rule' => "Full House",
            'slot' => [0, 4],
            //.... rest not needed in this test
        ];

        $this->suggestion = $suggestion;
        $house = $this->createMock(Grid::class);
        $player = $this->createMock(Grid::class);
        ;
        $player->method('getCardCount')->willreturn(14);
        $house->method('getCardCount')->willreturn(12);
        $fromSlot = [1, 4];
        $lastRound = [
            'player' => [2, 3],
            'house' => [3, 0]
        ];
        $this->fromSlot = $fromSlot;
        $this->lastRound = $lastRound;
        $deck = $this->createMock(Deck::class);
        $deck->method('getCards')->willReturn(['card7', 'card8', 'card9', 'card10', 'card11', 'card12']);
        $possibleCardsPlayer = ['card9','card11'];
        $possibleCardsHouse = ['card10', 'card12'];
        $deck->method('possibleCards')->will($this->onConsecutiveCalls($possibleCardsPlayer, $possibleCardsHouse));
        $this->deck = $deck;
        $this->player = $player;
        $this->house = $house;

        $exp = [
            'bet' => 200,
            'card' => "5H",
            'player-suggestion' => $suggestion,
            'results' => [],
            'house' => $house,
            'player' => $player,
            'placedCardsPlayer' => 14,
            'placedCardsHouse' => 12,
            'deckCardCount' => 6,
            'playerPossibleCards' => $possibleCardsPlayer,
            'housePossibleCards' => $possibleCardsHouse,
            'message' => "",
            'fromSlot' => $fromSlot,
            'lastRound' => $lastRound,
            'finished' => false,
        ];
        $res = $this->currentStateApi();
        $this->assertEquals($exp, $res);
    }
}
