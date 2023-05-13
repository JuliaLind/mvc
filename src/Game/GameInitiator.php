<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle game in the Game21Controller
 */
class GameInitiator
{
    /**
     * Returns either a Game21Easy or a Game21Hard object
     * @return Game21Interface $game
     */
    public function init(int $level): Game21Interface
    {
        $game = new Game21Easy();
        switch($level) {
            case 2:
                $game = new Game21Hard();
                break;
        }
        return $game;
    }
}
