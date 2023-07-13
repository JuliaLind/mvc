<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Handles the cheat of moving a placed card from one slot to another
 */
trait MoveACardTrait
{
    /**
     * The slot from which to move the card
     * @var array<int> $fromSlot
     */
    private array $fromSlot = [];

    /**
     * Contains the coordinates of the slots
     * where the house and the player placed the
     * cards in all the previous moves
     * @var array<string,array<array<int>>> $lastRound
     */
    private array $lastRound = [
        'house' => [],
        'player' => []
    ];
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private Grid $house;
    private Grid $player;
    /**
     * The results for the player and the house.
     * Contains the rule scored and the points
     * for each of the 10 hands and the totals
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results = [];

    /**
     * Contains the suggestion for player on a slot
     * to place the dealt card and also the data for
     * all 10 hands (best possible rule with the
     * dealt card and best possible rule wihtout
     * the dealt card)
     * @var array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
     */
    private array $suggestion = [];

    /**
     * Sets the slot from which to pick up the placed card
     */
    public function setFromSlot(int $row, int $col): void
    {
        $this->fromSlot = [$row, $col];
        // $this->lastRound = [];
        $this->lastRound = [
            'house' => [],
            'player' => []
        ];
    }

    /**
     * Picks up card from the previously set from-slot
     * and places it in the new slot
     * Generates new suggestion data for the player
     * based on the updated grid
     */
    public function moveCard(int $row, int $col): void
    {
        $this->suggestion = [];
        $card = $this->player->removeCard($this->fromSlot[0], $this->fromSlot[1]);
        $this->player->addCard($row, $col, $card);
        $this->fromSlot = [];
        $evaluator = $this->evaluator;
        $this->results = [
            'player' => $evaluator->results($this->player),
            'house' => $evaluator->results($this->house)
        ];
    }
}
