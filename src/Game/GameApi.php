<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class that returns current state of 21 game for the api route
 */
class GameApi
{
    /**
     * Returns data for the Json route where current game is idsplayed
     * @return array<mixed> with current game status
     */
    public function data(Game21Interface $game): array
    {
        $gameStatus = "No game started";
        if ($game != null) {
            $gameStatus = $game->getGameStatus();
            $gameStatus['risk'] = $game->getRisk();
        }

        $data = [
            'players' => $game->getPlayerData(),
            'status' => $gameStatus,
        ];
        return $data;
    }
}
