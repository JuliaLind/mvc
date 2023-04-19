<?php

namespace App\Game;

use App\Game\Player21;
use App\Cards\DeckOfCards;
use App\Game\MoneyPot;

class Game21Easy extends Game implements Game21Interface
{
    use BettingGameTrait;

    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    protected Player21 $player;
    protected Player21 $bank;

    protected bool $roundOver=false;
    protected bool $bankPlaying=false;

    protected int $currentRound=0;
    protected string $winner="";

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

        $this->moneyPot = new MoneyPot();
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
     * and resets for next round.
     * Returns an associative array with investment
     * limit, player's money and nr of next round
     * @return array<int>
     */
    public function nextRound(): array
    {
        $this->currentRound = $this->currentRound + 1;
        $this->roundOver = false;
        $this->bankPlaying = false;
        $this->player->emptyHand();
        $this->bank->emptyHand();

        $nextRoundData = [
            'limit' => $this->getInvestLimit(),
            'money' => $this->player->money,
            'round' => $this->currentRound,
        ];
        return $nextRoundData;
    }

    /**
     * Returns the risk of current player getting
     * above 21 with next drawn card
     *
     * @return float
     */
    protected function estimateRisk(): float
    {
        $currentPlayer = $this->currentPlayer();
        $minHandValue = $currentPlayer->minHandValue();
        $cardsLeft = $this->deck->getCardCount();
        $possibleCards = $this->deck->getValues();
        $badCards = 0;
        $risk = 0;
        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }
                if ($minHandValue + $value > self::GOAL) {
                    $badCards += 1;
                }
            }
            $risk = $badCards / $cardsLeft;
        }
        return $risk;
    }

    /**
     * Deals a card to the player and returns data for generating
     * a flash message (array with type and message) if round over or
     * game over, otherwise returns
     * an array with two empty strings
     *
     * @return array<string>
     */
    public function deal(): array
    {
        $this->player->draw($this->deck);
        $this->evaluate();
        return $this->generateFlash();
    }

    /**
     * Called after the player has picked a card
     * and checks if the round is over/value of hand is above 21
     *
     * @return void
     */
    protected function evaluate(): void
    {
        $player = $this->player;
        $handValue = $player->handValue();

        $winner = $player;
        if ($handValue > self::GOAL) {
            $winner = $this->bank;
        } elseif ($this->cardsLeft() > 0) {
            if ($handValue === self::GOAL) {
                $this->bankPlaying = true;
            }
            return;
        }
        $this->endRound($winner);
    }

    /**
     * Deals cards to the bank and returns data for setting flashmessage
     *
     * @return array<string> array with two strings - first type of the message,
     * second - the message
     */
    public function dealBank(): array
    {
        $this->bankPlaying = true;
        $bank = $this->bank;

        while (($bank->handValue() < 17) && ($this->cardsLeft() > 0)) {
            $bank->draw($this->deck);
        }
        $this->evaluateBank();
        return $this->generateFlash();
    }

    /**
     * Called after the bank is finished with drawing cards
     *
     * @return void
     */
    protected function evaluateBank(): void
    {
        $bank = $this->bank;
        $player = $this->player;

        $bankHandValue = $bank->handValue();
        $playerHandValue = $player->handValue();

        $winner = $player;

        if (($bankHandValue === self::GOAL) || ($bankHandValue === $playerHandValue)) {
            $winner = $bank;
        } elseif ($bankHandValue < self::GOAL) {
            $diffBank = self::GOAL - $bankHandValue;
            $diffPlayer = self::GOAL - $playerHandValue;
            if ($diffBank < $diffPlayer) {
                $winner = $bank;
            }
        }
        $this->endRound($winner);
    }

    /**
     * End the round
     * @param Player21 $winner
     *
     * @return void
     */
    protected function endRound(Player21 $winner): void
    {
        $this->moneyPot->moneyToWinner($winner);
        $this->roundOver = true;
        if (($this->getInvestLimit() === 0 && $this->moneyPot->currentAmount() === 0) || $this->cardsLeft() === 0) {
            $this->finished = true;
            $player = $this->player;
            $bank = $this->bank;
            $winner = $bank;
            if ($player->money > $bank->money) {
                $winner = $player;
            }
        }
        $this->winner = $winner->name;
    }

    /**
     * Returns array with flash message type and the message
     *
     * @return array<string>
     */
    protected function generateFlash(): array
    {
        $type = "";
        $message = "";
        $winner = $this->winner;

        if ($this->roundOver === true) {
            $type = "notice";
            if ($winner === "Bank") {
                $type = "warning";
            }
            $message = "Round over, {$winner} won!";
        }
        if ($this->finished === true) {
            $message = "Game over, {$winner} won!";
        }
        return [$type, $message];
    }

    /**
     * Returns name, graphic representation, money amount and current
     * value of hand for player and bank
     *
     * @return array<int<0,max>,array<string,array<array<string>>|int|string>>
     */
    protected function getPlayerData(): array
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
     * Returns all data for current game
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
            'moneyPot'=>$this->moneyPot->currentAmount(),
            'roundOver'=>$this->roundOver,
            'level' => 'easy',
        ];
        return $data;
    }
}
