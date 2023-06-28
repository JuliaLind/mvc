<?php

namespace App\Game;

use App\Cards\DeckOfCards;

/**
 * Base class for the 21 card game
 */
class Game21
{
    use Game21DataTrait;
    use Game21Trait;
    use BettingGameTrait;
    use Game21FlashTrait;
    use EndRoundTrait;
    use PlayersTurnTrait;
    use NextRoundTrait;
    use EvaluateBankTrait;
    use EvaluateBankTrait2;
    use EvaluatePlayerTrait;

    protected Player21 $winner;
    protected Player21 $player;
    protected Player21 $bank;
    protected bool $roundOver=false;
    protected bool $bankPlaying=false;
    protected int $currentRound=0;
    protected DeckOfCards $deck;
    protected bool $finished=false;

    public function __construct(Player21 $player=new Player21(), DeckOfCards $deck=new DeckOfCards())
    {
        $this->deck = $deck;
        $this->deck->shuffle();
        $this->player = $player;
        $this->bank = new Player21('Bank');

        $startingMoney = 100;
        $this->player->incrMoney($startingMoney);
        $this->bank->incrMoney($startingMoney);
        $this->winner = new Player21('');
        $this->moneyPot = new MoneyPot();
    }
}
