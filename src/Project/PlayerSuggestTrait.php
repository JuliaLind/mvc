<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectEvaluator\RuleEvaluator;

// use App\Project\NoCardsException;

trait PlayerSuggestTrait
{
    private Grid $player;
    private string $card;
    private Deck $deck;
    private RuleEvaluator $evaluator;

    /**
     * @var array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
     */
    private array $suggestion = ["message" => ""];

    /**
     * @param array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
     */
    abstract private function createMessage(array $suggestion): string;


    /**
     * Analyses player's grid and saves a suggestion
     * on slot to place card and information
     * on which rule is possible at best with card
     * resp. without card
     */
    private function playerSuggest(): void
    {
        $suggestion = $this->evaluator->suggestion($this->player, $this->card, $this->deck->possibleCards());
        $this->suggestion = $suggestion;
        $this->suggestion['message'] = $this->createMessage($suggestion);
    }
}
