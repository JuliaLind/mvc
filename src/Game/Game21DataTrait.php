<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

trait Game21DataTrait
{
    protected Player21 $winner;
    protected Player21 $player;
    protected Player21 $bank;
    protected bool $roundOver=false;
    protected bool $finished=false;
    protected bool $bankPlaying=false;
    protected int $currentRound=0;
    protected string $level;
    protected DeckOfCards $deck;
    protected MoneyPot $moneyPot;

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

        $winner = $this->winner->getName();

        $data = [
            'bankPlaying' => $this->bankPlaying,
            'winner' => $winner,
            'cardsLeft' => $this->deck->getCardCount(),
            'finished' => $this->finished,
            'currentRound' => $this->currentRound,
            'moneyPot' => $this->moneyPot->currentAmount(),
            'roundOver' => $this->roundOver,
            'level' => $this->level,
        ];
        return $data;
    }
}
