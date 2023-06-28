<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";


class NextRound
{
    /**
     * Increases number of currenRound attribute by 1
     * and resets for next round.
     * Returns an associative array with investment
     * limit, player's money and nr of next round
     * @param Game21Easy $game
     * @return array<int>
     */
    public function main($game): array
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
}
