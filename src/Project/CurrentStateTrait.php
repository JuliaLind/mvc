<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;
use App\ProjectCard\Deck;
use App\ProjectGrid\GridGraphic;

trait CurrentStateTrait
{
    private int $pot=0;
    private string $card;
    private string $message = "";
    /**
     * @var array<string,array<int,int|string>|int|string> $suggestion
     */
    private array $suggestion = ["message" => ""];
    /**
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results = [];
    private Grid $house;
    private Grid $player;
    private Deck $deck;
    private bool $finished = false;

    /**
     * @var array<string,array<int>>> $lastRound
     */
    private array $lastRound = [];
    /**
     * @var array<int> $fromSlot
     */
    private array $fromSlot = [];

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
