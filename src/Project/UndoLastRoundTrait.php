<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Trait for handling reversal of the last moves done by house and player.
 * For each of house and player contains an array with all moves done from start
 * (of from the last time player used the move-a-card functionality)
 */
trait UndoLastRoundTrait
{
    /**
     * The latest card that has been dealt to the player
     */
    private string $card;
    private RuleEvaluator $evaluator;
    private Deck $deck;
    private Grid $house;


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
    private Grid $player;
    /**
     * The results for the player and the house.
     * Contains the rule scored and the points
     * for each of the 10 hands and the totals
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results = [];


    /**
     * Undoes the last round. The latest card that is dealt to the player
     * is placed back into the deck. The latest placed card in the houses grid
     * is also removed and placed back into the deck. And the latest card placed by the player is lifted from the player's grid.
     * The suggestion data for the player is re-generated based on the updated grid
     */
    public function undoLastRound(): void
    {
        // $houseSlot = $this->lastRound['house'];
        // $playerSlot = $this->lastRound['player'];
        /**
         * @var array<int> $houseSlot
         */
        $houseSlot = array_pop($this->lastRound['house']);
        /**
         * @var array<int> $playerSlot
         */
        $playerSlot = array_pop($this->lastRound['player']);




        $houseCard = $this->house->removeCard($houseSlot[0], $houseSlot[1]);
        $playerCard = $this->player->removeCard($playerSlot[0], $playerSlot[1]);
        $this->deck->addCard($this->card);
        $this->deck->addCard($houseCard);
        $this->card = $playerCard;
        $evaluator = $this->evaluator;
        $this->results = [
            'player' => $evaluator->results($this->player),
            'house' => $evaluator->results($this->house)
        ];
    }
}
