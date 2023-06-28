<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Class representing the easy version of the 21 card game
 */
class Game21Easy extends Game implements Game21Interface
{
    use Game21Trait;
    use Game21Trait3;
    use Game21Trait4;
    use BettingGameTrait;
    use GameAttrHandlerTrait;
    use GameAttrHandler2Trait;
    use Game21FlashTrait;

    protected Player21 $winner;
    protected Player21 $player;
    protected Player21 $bank;
    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected int $currentRound=0;
    protected string $level="easy";

    /**
     * Constructor
     *
     * @param Player21 $player
     * @param DeckOfCards $deck
     */
    public function __construct(Player21 $player=new Player21(), DeckOfCards $deck=new DeckOfCards())
    {
        parent::__construct($deck);

        $this->player = $player;
        $this->bank = new Player21('Bank');

        $startingMoney = 100;
        $this->player->incrMoney($startingMoney);
        $this->bank->incrMoney($startingMoney);
        $this->winner = new Player21('');
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
     * Returns the risk of getting "fat" with
     * next card for currently playing party - player or bank
     * @return string
     */
    public function getRisk(): string
    {
        $risk = strVal(round($this->currentPlayer()->estimateRisk($this->deck) * 100, 2));
        return $risk . ' %';
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
}
