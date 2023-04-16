<?php

namespace App\Game;

use App\Game\Player21;
use App\Cards\DeckOfCards;

class Game21 extends GameMultiPlayer
{
    /**
     * @var int $currentRound.
     */
    public $currentRound;

    /**
     * @var bool $roundOver.
     */
    public $roundOver;

    /**
     * @param array<Player21> $players
     */
    public function __construct(DeckOfCards $deck=new DeckOfCards(), array $players=[new Player21('You'), new Player21('Bank', 'bank')])
    {
        $startingMoney = 100;
        parent::__construct($deck, $players);
        foreach($this->players as $player) {
            $player->incrMoney($startingMoney);
        }
        $this->currentRound = 0;
        $this->roundOver = false;
    }

    public function estimateRisk(): float
    {
        $badCards = 0;
        $currentPlayer = $this->players[$this->current];
        $currentPoints = $currentPlayer->getMinPoints();
        $cardsLeft = $this->deck->getCardCount();
        $possibleCards = $this->deck->getValues();
        $risk = 0;

        foreach($this->players as $player) {
            if($player !== $currentPlayer) {
                $cardsLeft += $player->getCardCount();
                $possibleCards = array_merge($possibleCards, $player->getCardValues());
            }
        }

        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }
                if ($currentPoints + $value > 21) {
                    $badCards += 1;
                }
            }
            $risk = $badCards / $cardsLeft;
        }

        return $risk;
    }

    public function nextRound(): void
    {
        $this->currentRound = $this->currentRound + 1;
        $this->current = 0;
        $this->roundOver = false;
        foreach ($this->players as $player) {
            $player->emptyHand();
        }
    }

    public function evaluate(): int
    {
        $roundOver = 0;
        $gameOver = 1;
        $continue = 2;

        $currentPlayer = $this->players[$this->current];
        $otherPlayer = $this->players[0];
        if ($this->current === 0) {
            $otherPlayer = $this->players[1];
        }
        $winner = $currentPlayer;
        $currentPlayerPoints = $currentPlayer->getPoints();
        $otherPlayerPoints = $otherPlayer->getPoints();

        if (($currentPlayerPoints > 21)) {
            $winner = $otherPlayer;
        } elseif (($currentPlayer->getType() !== "bank") && ($this->cardsLeft() > 0)) {
            return $continue;
        } elseif (($currentPlayer->getType() === 'bank') && (($currentPlayerPoints === 21) || $currentPlayerPoints === $otherPlayerPoints)) {
            $winner = $currentPlayer;
        } elseif (($currentPlayer->getType() === 'bank') || ($this->cardsLeft() === 0)) {
            $diff1 = 21 - $currentPlayerPoints;
            $diff2 = 21 - $otherPlayerPoints;
            if ($diff1 > $diff2) {
                $winner = $otherPlayer;
            }
        }

        $this->moneyToWinner($winner);
        // $winner->incrMoney($this->moneyPot);
        // $this->moneyPot = 0;
        $this->winner = $winner->getName();
        $this->roundOver = true;
        if (($this->getInvestLimit() === 0 && $this->moneyPot === 0) || $this->cardsLeft() === 0) {
            $this->finished = true;
            return $gameOver;
        }
        return $roundOver;
    }

    /**
     * Returns all current data for game
     *
     * @return array{players: array{array<string,array<array<string>>|int|string>}}
     */
    public function getGameStatus(): array
    {
        $risk = strVal(round($this->estimateRisk() * 100));
        $bankPlaying = false;
        if ($this->players[$this->current]->getType() === 'bank') {
            $bankPlaying=true;
        }

        $data = [
            'players'=>[
                ($this->getPlayerData())[1],
                ($this->getPlayerData())[0],
            ],
            'bankPlaying'=>$bankPlaying,
            'winner'=>$this->winner,
            'cardsLeft'=>$this->cardsLeft(),
            'statistics'=> $risk . ' %',
            'finished'=>$this->finished,
            'currentRound'=>$this->currentRound,
            'moneyPot'=>$this->moneyPot,
            'roundOver'=>$this->roundOver,
            'currentPlayer'=>$this->current,
        ];
        return $data;
    }
}
