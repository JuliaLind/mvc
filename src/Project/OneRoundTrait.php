<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectRules\RuleEvaluator;

trait OneRoundTrait
{
    private string $card;
    private Deck $deck;
    private RuleEvaluator $evaluator;
    private bool $finished=false;
    private Grid $house;
    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    private Grid $player;

    abstract private function playerSuggest(): void;

    public function oneRound(int $row, int $col): bool
    {
        $this->player->addCard($row, $col, $this->card);
        $this->lastRound['player'] = [$row, $col];
        $this->housePlaceCard();
        if ($this->house->getCardCount() === 25) {
            $this->finished = true;
            return true;
        }
        $this->card = $this->deck->deal();
        $this->playerSuggest();
        return false;
    }


}
