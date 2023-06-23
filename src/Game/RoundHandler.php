<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class for handling Game 21
 */
class RoundHandler
{
    /**
     * Increases number of currenRound attribute by 1
     * and resets for next round.
     * Returns an associative array with investment
     * limit, player's money and nr of next round
     * @param Game21Easy $game
     * @return array<int>
     */
    public function nextRound($game): array
    {
        $game->setCurrentRound($game->getCurrentRound() + 1);
        $game->setRoundOver(false);
        $game->setBankPlaying(false);
        $game->getPlayer()->emptyHand();
        $game->getBank()->emptyHand();
        $game->setWinner(new Player21(''));

        $nextRoundData = [
            'limit' => $game->getInvestLimit(),
            'money' => $game->getPlayer()->getMoney(),
            'round' => $game->getCurrentRound(),
        ];
        return $nextRoundData;
    }

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
    public function endRound($game): void
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
