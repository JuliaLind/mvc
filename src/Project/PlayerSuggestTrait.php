<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectCard\Deck;
use App\ProjectRules\MoveEvaluator;

trait PlayerSuggestTrait
{
    private Grid $player;
    private string $card;
    private Deck $deck;
    private MoveEvaluator $moveEvaluator;

    /**
     * @var array<string,array<int,int|string>|int|string> $suggestion
     */
    private array $suggestion = ["message" => ""];

    /**
     * @param array<string,array<int,int|string>|int|string> $suggestion
     */
    abstract private function createMessage(array $suggestion): string;


    private function playerSuggest(): void
    {
        $suggestion = $this->moveEvaluator->suggestion($this->player->getCards(), $this->card, $this->deck->possibleCards());
        $this->suggestion = $suggestion;
        $this->suggestion['message'] = $this->createMessage($suggestion);
    }
}
