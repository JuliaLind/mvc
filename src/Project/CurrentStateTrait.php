<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use App\ProjectGrid\Grid;

/**
 * Returns information on the current state of the game
 */
trait CurrentStateTrait
{
    /**
     * Contains the money the player has bet in the current game
     */
    private int $pot=0;
    private string $card;
    /**
     * Empty string until the end of the game.
     * When the game is finished the message contains information
     * on who won and if the player earned any coins
     */
    private string $message = "";

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
     * The results for the player and the house.
     * Contains the rule scored and the points
     * for each of the 10 hands and the totals
     * @var array<string,array<string,array<array<string,int|string>>|int>|string> $results
     */
    private array $results = [];
    private Grid $house;
    private Grid $player;
    private Deck $deck;
    private bool $finished = false;
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

    /**
     * Returns data to be used in the twig templates
     * and the "ordinary" routes
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
     * Returns data to be displayed in the API routes
     * @return array<mixed>
     */
    public function currentStateApi(): array
    {
        $deck = $this->deck->getCards();
        return [
            'bet' => $this->pot,
            'card' => $this->card,
            'player-suggestion' => $this->suggestion,
            'results' => $this->results,
            'house' => $this->house,
            'player' => $this->player,
            'placedCardsPlayer' => $this->player->getCardCount(),
            'placedCardsHouse' =>$this->house->getCardCount(),
            'deckCardCount' => count($deck),
            'playerPossibleCards' => $this->deck->possibleCards(),
            'housePossibleCards' => $this->deck->possibleCards(0),
            'remainingCardsDeck' => $deck,
            'message' => $this->message,
            'fromSlot' => $this->fromSlot,
            'lastRound' => $this->lastRound,
            'finished' => $this->finished,
        ];
    }
}
