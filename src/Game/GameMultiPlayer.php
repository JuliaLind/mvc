<?php

namespace App\Game;

// use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;

class GameMultiPlayer extends Game
{
    /**
     * @var array<Player> $players
     */
    protected $players;

    /**
     * @var string $winner
     */
    protected $winner;

    /**
     * @var int $moneyPot
     */
    protected $moneyPot;

    /**
     * @var int $current Index nr of current player in array.
     */
    protected $current;

    /**
     * @param array<Player> $players
     */
    public function __construct(DeckOfCards $deck, array $players)
    {
        parent::__construct($deck);
        $this->players = $players;
        $this->current = 0;
        $this->winner = "";
        $this->moneyPot = 0;
    }

    public function nextPlayer(): void
    {
        $next = $this->current + 1;
        if ($next > count($this->players) - 1) {
            $next = 0;
        }
        $this->current = $next;
    }

    public function dealMany(int $number): void
    {
        $this->players[$this->current]->drawMany($this->deck, $number);
    }

    public function deal(): int
    {
        $this->players[$this->current]->draw($this->deck);
        return -1;
    }

    public function getWinner(): string
    {
        return $this->winner;
    }

    public function currentPlayerMoney(): int
    {
        return $this->players[$this->current]->getMoney();
    }

    public function getInvestLimit(): int
    {
        $limit = $this->players[0]->getMoney();
        foreach ($this->players as $player) {
            $money = $player->getMoney();
            if ($money < $limit) {
                $limit = $money;
            }
        }
        return $limit;
    }

    public function addToMoneyPot(int $amount): void
    {
        $limit = $this->getInvestLimit();
        if ($limit < $amount) {
            $amount = $limit;
        }
        foreach ($this->players as $player) {
            $this->moneyPot += $player->decrMoney($amount);
        }
    }

    public function moneyToWinner(Player $player): void
    {
        $player->incrMoney($this->moneyPot);
        $this->moneyPot = 0;
    }

    public function getMoneyPot(): int
    {
        return $this->moneyPot;
    }

    public function getCurrentPlayerName(): string
    {
        return $this->players[$this->current]->getName();
    }

    /**
     * Returns data for each player.
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    public function getPlayerData(): array
    {
        $players = [];
        foreach ($this->players as $player) {
            $players[] = [
                'name' => $player->getName(),
                'cards' => $player->showHandGraphic(),
                'money' => $player->getMoney(),
                'points' => $player->getPoints(),
            ];
        }
        return $players;
    }
}
