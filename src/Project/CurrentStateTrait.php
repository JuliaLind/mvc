<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

trait CurrentStateTrait
{
    private int $pot=0;
    private string $card;
    private string $message = "";
    /**
     * @var array<string,array<int,array<string,float|int|string>|int>|int|string> $suggestion
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
    public function currentState(): array
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
            'house' => $this->house->graphic(),
            'player' => $this->player->graphic(),
            'placedCards' => $this->player->getCardCount(),
            'fromSlot' => $this->fromSlot,
            'finished' => $this->finished,
            'deckCardCount' => count($this->deck->getCards()),
            'playerPossibleCards' => $this->deck->possibleCards(),
            'lastRound' => $this->lastRound,
        ];
    }

    /**
     * @return array<mixed>
     */
    public function currentStateApi(): array
    {
        return [
            'bet' => $this->pot,
            'card' => $this->card,
            'player-suggestion' => $this->suggestion,
            'results' => $this->results,
            'house' => $this->house,
            'player' => $this->player,
            'placedCardsPlayer' => $this->player->getCardCount(),
            'placedCardsHouse' =>$this->house->getCardCount(),
            'deckCardCount' => count($this->deck->getCards()),
            'playerPossibleCards' => $this->deck->possibleCards(),
            'message' => $this->message,
            'fromSlot' => $this->fromSlot,
            'lastRound' => $this->lastRound,
            'finished' => $this->finished,
            'card-graphic' => [
                'img' => "img/project/cards/".$this->card.".svg",
                'alt' => $this->card
            ],
            'house-graphic' => $this->house->graphic(),
            'player-graphic' => $this->player->graphic(),
        ];
    }
}
