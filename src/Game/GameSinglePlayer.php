<?php

namespace App\Game;

// use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;

class GameSinglePlayer extends Game
{
    /**
     * @var PlayerInterface $player
     */
    protected $player;


    public function __construct(DeckOfCards $deck, PlayerInterface $player)
    {
        parent::__construct($deck);
        $this->player = $player;
    }

    public function deal(): int
    {
        $this->player->draw($this->deck);
        return -1;
    }

    public function playerMoney(): int
    {
        return $this->player->getMoney();
    }

    // public function moneyToWinner(Player $player): void
    // {
    //     $player->incrMoney($this->moneyPot);
    //     $this->moneyPot = 0;
    // }

    /**
     * Returns player data
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    public function getPlayerData(): array
    {
        $players = [];
        $player = $this->player;
        $players[] = [
            'name' => $player->getName(),
            'cards' => $player->showHandGraphic(),
            'money' => $player->getMoney(),
            'points' => $player->getPoints(),
        ];
        return $players;
    }
}
