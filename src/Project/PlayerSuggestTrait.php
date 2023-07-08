<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

/**
 * Generates suggestion for player on a slot
 * to place the dealt card and also the data for
 * all 10 hands (best possible rule with the
 * dealt card and best possible rule wihtout
 * the dealt card)
 */
trait PlayerSuggestTrait
{
    private Grid $player;
    /**
     * The latest card that has been dealt to
     * the player
     */
    private string $card;
    private Deck $deck;
    private RuleEvaluator $evaluator;

    /**
     * Contains the suggestion for player on a slot
     * to place the dealt card and also the data for
     * all 10 hands (best possible rule with the
     * dealt card and best possible rule wihtout
     * the dealt card)
     * @var array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
     */
    private array $suggestion = ["message" => ""];

    /**
     * Generates a message based on the
     * suggestion data (suggested slot and rules
     * that can be scored if placing the dealt
     * card into the suggsted slot)
     * @param array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
     */
    abstract private function createMessage(array $suggestion): string;


    /**
     * Provides a suggestion to the player on which slot to
     * place the card in. Also provides data for each hand on
     * the best possible rule that can be achieved with the dealt card
     * and best possible rule without the dealt card, to be used
     * in the suggestion-cheat
     */
    private function playerSuggest(): void
    {
        $suggestion = $this->evaluator->suggestion($this->player, $this->card, $this->deck->possibleCards());
        $this->suggestion = $suggestion;
        $this->suggestion['message'] = $this->createMessage($suggestion);
    }
}
