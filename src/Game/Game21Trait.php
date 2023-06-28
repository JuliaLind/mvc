<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";


trait Game21Trait
{
    use Game21Trait2;

    protected int $goal=21;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $bankPlaying=false;

    /**
     * Called after the bank is finished with drawing cards.
     * Sets the winner of the round.
     *
     * @return void
     */
    public function evaluateBank(): void
    {
        $bank = $this->bank;
        $player = $this->player;

        $bankHandValue = $bank->handValue();
        $playerHandValue = $player->handValue();

        if ($this->hasBankMoreThan21($bankHandValue) === true) {
            $this->winner = $player;
            return;
        }
        if ($this->bankWinsOnEqual($bankHandValue, $playerHandValue) === true) {
            $this->winner = $bank;
            return;
        }
        if ($this->hasBankBestScore($bankHandValue, $playerHandValue) === true) {
            $this->winner = $bank;
            return;
        }
        $this->winner = $player;
        return;
    }
}
