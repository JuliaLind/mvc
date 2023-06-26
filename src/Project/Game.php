<?php

namespace App\Project;

use App\ProjectCard\Deck;
use App\ProjectGrid\Grid;
use App\ProjectGrid\GridGraphic;
use App\ProjectRules\WinEvaluator;
use App\ProjectRules\MoveEvaluator;
use Datetime;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Entity\Score;

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
    private array $results = [];
    private string $message = "";

    /**
     * @var array<string,array<int,int|string>|int|string> $suggestion
     */
    private array $suggestion = ["message" => ""];


    /**
     * @var array<int> $fromSlot
     */
    private array $fromSlot = [];
    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];

    public function setPot(int $amount): void
    {
        $this->pot = $amount;
    }

    /**
     * @param array<Grid> $grids
     */
    public function __construct(
        array $grids,
        Deck $deck = new Deck(),
        MoveEvaluator $moveEvaluator=new MoveEvaluator(),
        WinEvaluator $winEvaluator=new WinEvaluator()
    ) {
        $this->house = $grids['house'];
        $this->player = $grids['player'];
        $this->moveEvaluator = $moveEvaluator;
        $this->winEvaluator = $winEvaluator;
        $deck->shuffle();
        $this->deck = $deck;
        $this->card = $this->deck->deal();
        $this->playerSuggest();
    }

    /**
     * @param array<string,array<int,int|string>|int|string> $suggestion
     */
    private function createMessage(array $suggestion): string
    {
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion["slot"];
        // $this->suggestedSlot = $slot;
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
        $message = "";
        if ($rowRule != "" && $colRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$rowRule} horizontally and/or {$colRule} vertically.";
        } elseif ($rowRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$rowRule} horizontally.";
        } elseif ($colRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$colRule} vertically.";
        }
        return $message;
    }


    public function playerSuggest(): void
    {
        $suggestion = $this->moveEvaluator->suggestion($this->player->getCards(), $this->card, $this->deck->possibleCards());
        $this->suggestion = $suggestion;
        $this->suggestion['message'] = $this->createMessage($suggestion);
    }

    public function setFromSlot(int $row, int $col): void
    {
        $this->fromSlot = [$row, $col];
        $this->lastRound = [];
    }

    public function moveCard(int $row, int $col): void
    {
        $card = $this->player->removeCard($this->fromSlot[0], $this->fromSlot[1]);
        $this->player->addCard($row, $col, $card);
        $this->fromSlot = [];
        $this->playerSuggest();
    }

    public function undoLastRound(): void
    {
        $houseSlot = $this->lastRound['house'];
        $playerSlot = $this->lastRound['player'];
        $houseCard = $this->house->removeCard($houseSlot[0], $houseSlot[1]);
        $playerCard = $this->player->removeCard($playerSlot[0], $playerSlot[1]);
        $this->deck->addCard($this->card);
        $this->deck->addCard($houseCard);
        $this->card = $playerCard;
        $this->lastRound = [];
        $this->playerSuggest();
    }

    public function oneRound(int $row, int $col): bool
    {
        $this->player->addCard($row, $col, $this->card);
        $this->lastRound['player'] = [$row, $col];
        $this->housePlaceCard();
        if (!($this->checkIfFinished($this->house->getCardCount()))) {
            $this->card = $this->deck->deal();
            $this->playerSuggest();
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
        $this->lastRound['house'] = $slot;
        $this->house->addCard($slot[0], $slot[1], $card);
    }


    private function checkIfFinished(int $houseCardCount): bool
    {
        $finished = $houseCardCount === 25;
        $this->finished = $finished;
        return $finished;
    }

    public function evaluate(EntityManagerInterface $manager, int $userId): void
    {
        $this->suggestion = ['message' => ""];

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
        // $amount = 0;

        if ($playerTotal >= $houseTotal) {
            $winner = "You";
            $amount = ($this->pot + ($playerTotal - $houseTotal)) * 2;
            $lastPart = " and received {$amount} coins";

            /**
             * @var User $user;
             */
            $user = $manager->getRepository(User::class)->find($userId);
            $register = new Register($manager, $userId);
            $register->transaction($amount, 'return (bet + profit)');
            $score = new Score();
            date_default_timezone_set('Europe/Stockholm');
            $score->setRegistered(new DateTime());
            $score->setPoints($playerTotal);
            $score->setUser($user);
            $manager->persist($score);
            $manager->flush();
        }
        $this->message = "Game finished, You got {$playerTotal} points and House got {$houseTotal} points. {$winner} won{$lastPart}";
        $this->results = [
            'player' => $playerData,
            'house' => $houseData
        ];
        $this->pot = 0;
        // return $amount;
    }

    /**
     * @return array<mixed>
     */
    public function currentState(GridGraphic $grid = new GridGraphic()): array
    {
        return [
            'bet' => $this->pot,
            'card' => [
                'img' => "img/project/cards/".$this->card.".svg",
                'alt' => $this->card
            ],
            'message' => $this->message,
            'suggestion' => $this->suggestion,
            'results' => $this->results,
            'house' => $grid->graphic($this->house->getCards()),
            'player' => $grid->graphic($this->player->getCards()),
            'fromSlot' => $this->fromSlot,
            'finished' => $this->finished,
            'placedCards' => $this->player->getCardCount(),
            'deckCardCount' => count($this->deck->getCards()),
            'playerPossibleCards' => $this->deck->possibleCards(),
            'lastRound' => $this->lastRound,
        ];
    }

}
