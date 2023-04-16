<?php

namespace App\Game;

use App\Game\Player21;
use App\Cards\DeckOfCards;

class Game21SinglePlayer extends GameSinglePlayer
{
    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    public bool $roundOver;
    public bool $bankPlaying;
    protected Player21 $bank;
    public int $currentRound;

    public string $winner;
    protected int $moneyPot;

    public function __construct(PlayerInterface $player=new Player21('You'), DeckOfCards $deck=new DeckOfCards())
    {
        $startingMoney = 100;
        parent::__construct($deck, $player);
        $this->player->incrMoney($startingMoney);
        $this->currentRound = 0;
        $this->roundOver = false;
        $this->bankPlaying = false;
        $this->bank = new Player21('Bank', 'bank');
        $this->bank->incrMoney($startingMoney);
        $this->winner = "";
        $this->moneyPot = 0;
    }

    protected function currentPlayer(): PlayerInterface
    {
        $currentPlayer = $this->player;
        if ($this->bankPlaying === true) {
            $currentPlayer = $this->bank;
        }
        return $currentPlayer;
    }

    public function moneyToWinner(PlayerInterface $player): void
    {
        $player->incrMoney($this->moneyPot);
        $this->moneyPot = 0;
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
        $this->roundOver = false;
        $this->player->emptyHand();
        $this->bank->emptyHand();
        $this->bankPlaying = false;
    }

    public function endRound(PlayerInterface $winner): int
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
        $player = $this->player;
        $bank = $this->bank;

        $winner = $player;
        $playerPoints = $player->getPoints();

        if ($playerPoints > self::GOAL) {
            $winner = $bank;
        } elseif ($this->cardsLeft() > 0) {
            return $continue;
        }
        return $this->endRound($winner);
    }

    public function evaluateBank(): int
    {
        $bank = $this->bank;
        $player = $this->player;

        $bankPoints = $bank->getPoints();
        $playerPoints = $player->getPoints();

        $winner = $player;

        if (($bankPoints === self::GOAL) || ($bankPoints === $playerPoints)) {
            $winner = $bank;
        } elseif ($bankPoints < self::GOAL) {
            $diffBank = self::GOAL - $bankPoints;
            $diffPlayer = self::GOAL - $playerPoints;
            if ($diffBank < $diffPlayer) {
                $winner = $bank;
            }
        }
        return $this->endRound($winner);
    }

    /**
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
        $limit = $this->player->getMoney();
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
        $this->moneyPot += $this->player->decrMoney($amount);
    }

    /**
     * Returns player data
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    public function getPlayerData(): array
    {
        $players = [];
        $players[] = [
            'name' => $this->bank->getName(),
            'cards' => $this->bank->showHandGraphic(),
            'money' => $this->bank->getMoney(),
            'points' => $this->bank->getPoints(),
        ];
        $players = array_merge($players, parent::getPlayerData());
        return $players;
    }  

    /**
     * Returns all current data for game
     *
     * @return array<mixed>
     */
    public function getGameStatus(): array
    {
        $risk = strVal(round($this->estimateRisk() * 100));
        $players = $this->getPlayerData();
        $data = [
            'players'=>$players,
            'bankPlaying'=>$this->bankPlaying,
            'winner'=>$this->winner,
            'cardsLeft'=>$this->cardsLeft(),
            'risk'=> $risk . ' %',
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
