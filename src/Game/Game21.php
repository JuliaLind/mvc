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
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    /**
     * @var bool $roundOver.
     */
    public $roundOver;

    /**
     * @var bool $bankPlaying.
     */
    public $bankPlaying;

    /**
     * @var Player21 $bank.
     */
    public $bank;

    /**
     * @var array<Player21> $players.
     */
    protected $players;

    /**
     * @param array<Player21> $players
     */
    public function __construct(array $players=[new Player21('You')], DeckOfCards $deck=new DeckOfCards())
    {
        $startingMoney = 100;
        parent::__construct($deck, $players);
        foreach($this->players as $player) {
            $player->incrMoney($startingMoney);
        }
        $this->currentRound = 0;
        $this->roundOver = false;
        $this->bankPlaying = false;
        $this->bank = new Player21('Bank', 'bank');
        $this->bank->incrMoney($startingMoney);
    }

    public function currentPlayer(): Player21
    {
        $currentPlayer = $this->bank;
        if ($this->bankPlaying === false) {
            $currentPlayer = $this->players[$this->current];
        }
        return $currentPlayer;
    }

    public function estimateRisk(): float
    {
        $badCards = 0;
        $currentPlayer = $this->currentPlayer();
        $currentPoints = $currentPlayer->getMinPoints();
        $cardsLeft = $this->deck->getCardCount();
        $possibleCards = $this->deck->getValues();
        $risk = 0;

        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }

                if ($currentPoints + $value > self::GOAL) {
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
        $this->bank->emptyHand();
        $this->bankPlaying = false;
    }

    public function endRound(Player21 $winner): int
    {
        $roundOver = 0;
        $gameOver = 1;
        $this->moneyToWinner($winner);
        $this->winner = $winner->getName();
        $this->roundOver = true;
        if (($this->getInvestLimit() === 0 && $this->moneyPot === 0) || $this->cardsLeft() === 0) {
            $this->finished = true;
            return $gameOver;
        }
        return $roundOver;
    }

    public function evaluate(): int
    {
        $continue = -1;

        $currentPlayer = $this->players[$this->current];
        $otherPlayer = $this->bank;

        $winner = $currentPlayer;
        $currentPlayerPoints = $currentPlayer->getPoints();

        if ($currentPlayerPoints > self::GOAL) {
            $winner = $otherPlayer;
        } elseif ($this->cardsLeft() > 0) {
            return $continue;
        }

        return $this->endRound($winner);
    }

    public function evaluateBank(): int
    {
        $currentPlayer = $this->bank;
        $otherPlayer = $this->players[$this->current];

        $currentPlayerPoints = $currentPlayer->getPoints();
        $otherPlayerPoints = $otherPlayer->getPoints();

        $winner = $otherPlayer;

        if (($currentPlayerPoints === self::GOAL) || ($currentPlayerPoints === $otherPlayerPoints)) {
            $winner = $currentPlayer;
        } elseif ($currentPlayerPoints < self::GOAL) {
            $diff1 = self::GOAL - $currentPlayerPoints;
            $diff2 = self::GOAL - $otherPlayerPoints;
            if ($diff1 < $diff2) {
                $winner = $currentPlayer;
            }
        }
        return $this->endRound($winner);
    }

    /**
     * Returns data for each player.
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    public function getBankData(): array
    {
        $bankData = [];
        $bankData[] = [
            'name' => $this->bank->getName(),
            'cards' => $this->bank->showHandGraphic(),
            'money' => $this->bank->getMoney(),
            'points' => $this->bank->getPoints(),
        ];
        return $bankData;
    }



    public function getInvestLimit(): int
    {
        $limit = $this->players[$this->current]->getMoney();
        $money = $this->bank->getMoney();
        if ($money < $limit) {
            $limit = $money;
        }
        return $limit;
    }

    public function addToMoneyPot(int $amount): void
    {
        $limit = $this->getInvestLimit();
        if ($limit < $amount) {
            $amount = $limit;
        }
        $this->moneyPot += $this->bank->decrMoney($amount);
        $this->moneyPot += $this->players[$this->current]->decrMoney($amount);
    }


    /**
     * Returns all current data for game
     *
     * @return array<mixed>
     */
    public function getGameStatus(): array
    {
        $risk = strVal(round($this->estimateRisk() * 100));
        $players = array_merge($this->getBankData(), $this->getPlayerData());

        $data = [
            'players'=>$players,
            'bankPlaying'=>$this->bankPlaying,
            'winner'=>$this->winner,
            'cardsLeft'=>$this->cardsLeft(),
            'statistics'=> $risk . ' %',
            'finished'=>$this->finished,
            'currentRound'=>$this->currentRound,
            'moneyPot'=>$this->moneyPot,
            'roundOver'=>$this->roundOver,
        ];
        return $data;
    }

    public function deal(): int
    {
        $evaluate = parent::deal();
        $evaluate = $this->evaluate();
        return $evaluate;
    }
}
