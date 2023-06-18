<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;
use App\ProjectRules\WinEvaluator;
use App\ProjectRules\MoveEvaluator;

use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;

class Game
{
    private int $pot;
    private Grid $house;
    private Grid $player;
    private Deck $deck;
    private string $card;
    private bool $finished = false;
    private MoveEvaluator $moveEvaluator;
    private WinEvaluator $winEvaluator;
    /**
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results;
    private string $message;
    /**
     * @var array<int> $suggestedSlot
     */
    private array $suggestedSlot;

    public function setPot(int $amount): void
    {
        $this->pot = $amount;
    }

    public function __construct(
        Grid $house = new Grid(),
        Grid $player = new Grid(),
        Deck $deck = new Deck(),
        MoveEvaluator $moveEvaluator=new MoveEvaluator(),
        WinEvaluator $winEvaluator=new WinEvaluator()
    ) {
        $this->house = $house;
        $this->player = $player;
        $deck->shuffle();
        $this->deck = $deck;
        $this->playerSuggest();
        $this->card = $this->deck->deal();
        $this->moveEvaluator = $moveEvaluator;
        $this->winEvaluator = $winEvaluator;
    }

    public function playerSuggest(): void
    {
        $suggestion = $this->moveEvaluator->suggestion($this->player->getCards(), $this->card, $this->deck->possibleCards());
        $message = "";
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion["slot"];
        $this->suggestedSlot = $slot;
        $row = $slot[0];
        $col = $slot[1];
        /**
         * @var string $rowRule
         */
        $rowRule = $suggestion['row-rule'];
        /**
         * @var string $colRule
         */
        $colRule = $suggestion['col-rule'];
        if ($rowRule != "" && $colRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$rowRule} horizontally and {$colRule} vertically.";
        } elseif ($rowRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$rowRule} horizontally.";
        } elseif ($colRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$colRule} vertically.";
        }
        $this->message = $message;
    }

    public function playerPlaceCard(int $row, int $col): bool
    {
        $this->player->addCard($row, $col, $this->card);
        $this->housePlaceCard();
        if (!($this->checkIfFinished($this->house->getCardCount()))) {
            $this->playerSuggest();
            $this->card = $this->deck->deal();
            return false;
        }
        return true;
    }

    private function housePlaceCard(): void
    {
        $card = $this->deck->deal();
        $suggestion = $this->moveEvaluator->suggestion($this->house->getCards(), $card, $this->deck->possibleCards());
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion['slot'];
        $this->house->addCard($slot[0], $slot[1], $card);
    }


    private function checkIfFinished(int $houseCardCount): bool
    {
        $finished = $houseCardCount === 25;
        $this->finished = $finished;
        return $finished;
    }

    public function evaluate(): int
    {
        $playerData = $this->winEvaluator->results($this->player->getCards());
        /**
         * @var int $playerTotal
         */
        $playerTotal = $playerData['total'];
        $houseData = $this->winEvaluator->results($this->house->getCards());
        /**
         * @var int $houseTotal
         */
        $houseTotal = $houseData['total'];
        $winner = "House";
        $lastPart = "";
        $amount = 0;

        if ($playerTotal >= $houseTotal) {
            $winner = "You";
            $amount = ($this->pot + ($playerTotal - $houseTotal)) * 2;
            $lastPart = " and received {$amount} coins";
        }
        $this->message = "Game finished, You got {$playerTotal} points and House got {$houseTotal} points. {$winner} won{$lastPart}";
        $this->results = [
            'player' => $playerData,
            'house' => $houseData
        ];
        return $amount;
    }

    /**
     * @return array<mixed>
     */
    public function currentState(GridGraphic $grid = new GridGraphic()): array
    {
        return [
            'house' => $grid->graphic($this->house->getCards()),
            'player' => $grid->graphic($this->player->getCards()),
            'suggestion' => $this->message != ""
        ];
    }

}
