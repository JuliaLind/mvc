<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Handles one round
 * 1. Player places card
 * 2. House places card
 * 3. If grids are full, evaluate and return results
 * 4. if not, generates new suggestion-data for player
 * based on the updated grid and deck data
 */
trait OneRoundTrait
{
    private string $card;
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private bool $finished=false;
    private Grid $house;
    /**
     * Contains the coordinates of the slots
     * where the house and the player placed the
     * cards in the last round
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    private Grid $player;

    /**
     * Picks a card from the deck and places
     * into the houses grid
     */
    abstract private function housePlaceCard(): void;
    /**
     * Provides a suggestion to the player on which slot to
     * place the card in. Also provides data for each hand on
     * the best possible rule that can be achieved with the dealt card
     * and best possible rule without the dealt card, to be used
     * in the suggestion-cheat
     */
    abstract private function playerSuggest(): void;

    public function oneRound(int $row, int $col): bool
    {
        $this->player->addCard($row, $col, $this->card);
        $this->lastRound['player'] = [$row, $col];
        $this->housePlaceCard();
        $this->card = $this->deck->deal();
        if ($this->house->getCardCount() === 25) {
            $this->finished = true;
            return true;
        }
        $this->playerSuggest();
        return false;
    }


}
