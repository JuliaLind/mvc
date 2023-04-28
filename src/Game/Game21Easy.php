<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Class representing the easy version of the 21 card game
 */
class Game21Easy extends Game implements Game21Interface
{
    use BettingGameTrait;

    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    /**
     * @var Player21|null $winner.
     */
    protected $winner=null;

    protected Player21 $player;
    protected Player21 $bank;
    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected int $currentRound=0;

    /**
     * Constructor
     *
     * @param Player21 $player
     * @param DeckOfCards $deck
     * @param Player21 $bank
     */
    public function __construct(Player21 $player=new Player21(), DeckOfCards $deck=new DeckOfCards(), Player21 $bank=new Player21('Bank'))
    {
        parent::__construct($deck);

        $this->player = $player;
        $this->bank = $bank;

        $startingMoney = 100;
        $this->player->incrMoney($startingMoney);
        $this->bank->incrMoney($startingMoney);

        $this->moneyPot = new MoneyPot();
    }

    /**
     * Returns the currently playing party - player or bank
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
            'money' => $this->player->getMoney(),
            'round' => $this->currentRound,
        ];
        return $nextRoundData;
    }


    /**
     * Deals a card to the player
     *
     * @return void
     */
    public function deal(): void
    {
        $this->player->draw($this->deck);
    }


    /**
     * Called after the player has picked a card.
     *
     * @return void
     */
    public function evaluate(): void
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
        $this->winner = $winner;
        $this->roundOver = true;
    }

    /**
     * Deals cards to the bank until the value of bank's hand is at
     * or above 17 or there are no cards left in deck
     *
     * @return void
     */
    public function dealBank(): void
    {
        $this->bankPlaying = true;
        $bank = $this->bank;

        while (($bank->handValue() < 17) && ($this->cardsLeft() > 0)) {
            $bank->draw($this->deck);
        }
    }

    /**
     * Called after the bank is finished with drawing cards.
     * Determines the winner of the round.
     *
     * @return void
     */
    public function evaluateBank(): void
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

        $this->winner = $winner;
        $this->roundOver = true;
    }

    /**
     * Moves money from the money pot to the winner.
     * Determines if the game is finished,
     * and if it is - who the final winner is
     *
     * @return void
     */
    public function endRound(): void
    {
        $winner = $this->winner;

        if ($winner) {
            $this->moneyPot->moneyToWinner($winner);

            if (($this->getInvestLimit() === 0 && $this->moneyPot->currentAmount() === 0) || $this->cardsLeft() === 0) {
                $this->finished = true;
            }
            if ($this->cardsLeft() === 0) {
                $player = $this->player;
                $bank = $this->bank;

                $winner = $bank;
                if ($player->getMoney() > $bank->getMoney()) {
                    $winner = $player;
                }
            }

            $this->winner = $winner;
        }
    }

    /**
     * Returns array with flash message type and the message
     *
     * @return array<string>
     */
    public function generateFlash(): array
    {
        $type = "";
        $message = "";
        $winner = "";
        if ($this->winner) {
            $winner = $this->winner->getName();
        }

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
     * value of hand for each of player and bank
     *
     * @return array<array<mixed>>
     */
    public function getPlayerData(): array
    {
        $players = [];
        foreach ([$this->bank, $this->player] as $player) {
            $name = $player->getName();
            $cards = $player->showHandGraphic();
            $money = $player->getMoney();
            $handValue = $player->handValue();
            $players[] = [
                'name' => $name,
                'cards' => $cards,
                'money' => $money,
                'handValue' => $handValue,
            ];
        }
        return $players;
    }

    /**
     * Returns status data for current game
     *
     * @return  array<mixed>
     */
    public function getGameStatus(): array
    {
        $risk = strVal(round($this->currentPlayer()->estimateRisk($this->deck) * 100, 2));
        $winner = "";
        if ($this->winner) {
            $winner = $this->winner->getName();
        }

        $data = [
            'bankPlaying'=>$this->bankPlaying,
            'winner'=>$winner,
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
