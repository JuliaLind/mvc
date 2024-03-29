<?php

namespace App\Project;

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Game of Poker Squares, from kmom10/Project
 */
class Game
{
    /**
     * Returns an array with current state of the game
     * to be used in the game routes and in the twig templates
     */
    use CurrentStateTrait;
    /**
     * Evaluates results when both grids are completely filled
     */
    use EvaluateTrait;
    /**
     * House places card
     */
    use HousePlaceCardTrait;
    /**
     * Moves a placed card from one slot to another
     */
    use MoveACardTrait;
    /**
     * Player places card, house places card
     */
    use OneRoundTrait;
    /**
     * Generates suggestion-data for player
     */
    use PlayerSuggestTrait;
    /**
     * Adds player's bet to the pot
     */
    use PotTrait;

    /**
     * Undoes the last round (reverses the last cardplacement by player and by house)
     */
    use UndoLastRoundTrait;

    private string $card;
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private Grid $house;
    private Grid $player;

    /**
     * Constructor
     * @param array<Grid> $grids
     */
    public function __construct(
        array $grids,
        Deck $deck = new Deck(),
        RuleEvaluator $evaluator = new RuleEvaluator(),
    ) {
        $this->house = $grids['house'];
        $this->player = $grids['player'];
        $this->evaluator = $evaluator;
        $this->deck = $deck;
        $this->card = $this->deck->deal();
        /**
         * Get the preliminary data on scored rules (at start of the game it is "None" and 0 for all ten)
         */
        $this->results = [
            'player' => $evaluator->results($this->player),
            'house' => $evaluator->results($this->house)
        ];
    }
}
