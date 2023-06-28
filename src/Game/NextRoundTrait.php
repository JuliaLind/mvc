<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";


trait NextRoundTrait
{
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $roundOver=false;
    protected int $currentRound=0;
    protected bool $bankPlaying=false;

    abstract protected function getInvestLimit(): int;

    /**
     * Increases number of currenRound attribute by 1
     * and resets for next round.
     * Returns an associative array with investment
     * limit, player's money and nr of next round
     * @return array<int>
     */
    public function nextRound(): array
    {
        $this->currentRound += 1;
        $this->roundOver = false;
        $this->bankPlaying = false;
        $this->player->emptyHand();
        $this->bank->emptyHand();
        $this->winner = new Player21('');

        $nextRoundData = [
            'limit' => $this->getInvestLimit(),
            'money' => $this->player->getMoney(),
            'round' => $this->currentRound,
        ];
        return $nextRoundData;
    }
}
