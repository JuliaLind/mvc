<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class GameHandler
{
    /**
     * Returns data for the route where current game is displayed
     * @return array<mixed> with current game status
     */
    public function play(Game21Interface $game): array
    {
        $pageData = [
            'players' => $game->getPlayerData(),
            'risk'=> $game->getRisk(),
            'page' => "game no-header card",
            'url' => "/game",
            'title' => 'Game 21'
        ];
        $data = array_merge($game->getGameStatus(), $pageData);
        return $data;
    }
}
