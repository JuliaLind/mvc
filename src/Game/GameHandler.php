<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Helper class to handle game in the Game21Controller
 */
class GameHandler
{
    /**
     * Returns either a Grane21Easy or a Game21Hard object
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

    /**
     * Updates game-object to next round, returns some data
     * for the route's template
     * @return array<int|string>
     */
    public function selectAmount(Game21Interface $game): array
    {
        $nextRoundData = $game->nextRound();
        $data = [
            'page' => "game no-header card",
            'url' => "/game",
        ];
        $data = array_merge($nextRoundData, $data);
        return $data;
    }

    /**
     * Updates the amount of money in the game obejcts moneypot
     * @return void
     */
    public function bet(int $amount, Game21Interface $game): void
    {
        $game->addToMoneyPot($amount);
    }

    /**
     * Handles player's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function playerDraw(Game21Interface $game): array
    {
        $game->deal();
        $game->evaluate();
        $game->endRound();

        $flash = $game->generateFlash();
        return $flash;
    }

    /**
     * Handles bank's turn to draw
     * @return array<string> with class and message for flashmessage
     */
    public function bankDraw(Game21Interface $game): array
    {
        $game->dealBank();
        $game->evaluateBank();
        $game->endRound();

        $flash = $game->generateFlash();
        return $flash;
    }

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

    /**
     * Returns data for the Json route where current game is idsplayed
     * @return array<mixed> with current game status
     */
    public function jsonGame(Game21Interface $game): array
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
