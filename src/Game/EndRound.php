<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class for handling Game 21
 */
class EndRound
{
    public function determineWinner(Player21 $player, Player21 $bank): Player21
    {
        $winner = $bank;
        if ($player->getMoney() > $bank->getMoney()) {
            $winner = $player;
        }

        return $winner;
    }


    /**
     * @param Game21Easy $game
     */
    public function finishGame($game): void
    {
        if (($game->getInvestLimit() === 0 && $game->getMoneyPot()->currentAmount() === 0)) {
            $game->setFinished(true);
        }
    }

    /**
     * Moves money from the money pot to the winner.
     * Determines if the game is finished,
     * and if it is - who the final winner is
     * @param Game21Easy $game
     *
     * @return void
     */
    public function main($game): void
    {
        $winner = $game->getWinner();
        $game->setRoundOver(true);

        $game->getMoneyPot()->moneyToWinner($winner);

        if ($game->cardsLeft() === 0) {
            $this->finishGame($game);
            $winner = $this->determineWinner($game->getPlayer(), $game->getBank());

        }

        $game->setWinner($winner);

    }

}
