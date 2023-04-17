<?php

namespace App\Game;

use App\Game\Player21;
use App\Cards\DeckOfCards;

class Game21Easy extends Game
{
    use BettingGameTrait;

    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    protected Player21 $player;
    protected Player21 $bank;

    public bool $roundOver=false;
    public bool $bankPlaying=false;
    public int $currentRound=0;
    public string $winner="";

    /**
     * Constructor
     * @param DeckOfCards $deck
     * @param Player21 $player
     */
    public function __construct(Player21 $player=new Player21(), DeckOfCards $deck=new DeckOfCards())
    {
        parent::__construct($deck);

        $this->player = $player;
        $this->bank = new Player21('Bank');

        $startingMoney = 100;
        $this->player->incrMoney($startingMoney);
        $this->bank->incrMoney($startingMoney);
    }

    /**
     * Returns the currently plaing party - player or bank
     * @return Player21
     */
    protected function currentPlayer(): Player21
    {
        $currentPlayer = $this->player;
        if ($this->bankPlaying === true) {
            $currentPlayer = $this->bank;
        }
        return $currentPlayer;
    }

    /**
     * Increases number of currenRound attribute by 1
     * and resets for next round
     * @return void
     */
    public function nextRound(): void
    {
        $this->currentRound = $this->currentRound + 1;
        $this->roundOver = false;
        $this->player->emptyHand();
        $this->bank->emptyHand();
        $this->bankPlaying = false;
    }

    /**
     * Returns the risk of current player getting
     * above 21 with next drawn card
     *
     * @return float
     */
    protected function estimateRisk(): float
    {
        $badCards = 0;
        $currentPlayer = $this->currentPlayer();
        $currentPoints = $currentPlayer->minHandValue();
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

    /**
     * Deals a card to the player,
     * returns indicator if player can continue to draw or if the round is over
     *
     * @return int
     */
    public function deal(): int
    {
        $this->player->draw($this->deck);
        return $this->evaluate();
    }

    /**
     * Called after the player has picked a card
     * and checks if the round is over/value of hand is above 21
     *
     * @return int
     */
    protected function evaluate(): int
    {
        $continue = -1;
        $player = $this->player;
        $bank = $this->bank;

        $winner = $player;
        $playerPoints = $player->handValue();

        if ($playerPoints > self::GOAL) {
            $winner = $bank;
        } elseif ($this->cardsLeft() > 0) {
            return $continue;
        }
        return $this->endRound($winner);
    }

    /**
     * Deals cards to the bank and returns indicator
     * of if the round is over or if the game is over
     *
     * @return int
     */
    public function dealBank(): int
    {
        $bank = $this->bank;
        $currentPoints = $bank->handValue();
        while (($currentPoints < 17) && ($this->cardsLeft() > 0)) {
            $bank->draw($this->deck);
            $currentPoints = $bank->handValue();
        }

        return $this->evaluateBank();
    }

    /**
     * Called after the bank is finished with drawing cards
     * and determins the winner of the round.
     *
     * @return int
     */
    protected function evaluateBank(): int
    {
        $bank = $this->bank;
        $player = $this->player;

        $bankPoints = $bank->handValue();
        $playerPoints = $player->handValue();

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
     * End the round. Returns an indicator of
     * if only the round is over or if the whole
     * game is over
     * @param Player21 $winner
     *
     * @return int
     */
    protected function endRound(Player21 $winner): int
    {
        $roundOver = 0;
        $gameOver = 1;
        $this->moneyToWinner($winner);
        $this->winner = $winner->name;
        $this->roundOver = true;
        if (($this->getInvestLimit() === 0 && $this->moneyPot === 0) || $this->cardsLeft() === 0) {
            $this->finished = true;
            return $gameOver;
        }
        return $roundOver;
    }


    /**
     * Returns player data
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    public function getPlayerData(): array
    {
        $players = [];
        $player = $this->player;
        $bank = $this->bank;
        $players[] = [
            'name' => $bank->name,
            'cards' => $bank->showHandGraphic(),
            'money' => $bank->money,
            'handValue' => $bank->handValue(),
        ];
        $players[] = [
            'name' => $player->name,
            'cards' => $player->showHandGraphic(),
            'money' => $player->money,
            'handValue' => $player->handValue(),
        ];
        return $players;
    }

    /**
     * Returns all current data for game
     *
     * @return array<mixed>
     */
    public function getGameStatus(): array
    {
        $risk = strVal(round($this->estimateRisk() * 100, 2));
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
            'level' => 'easy',
        ];
        return $data;
    }
}
