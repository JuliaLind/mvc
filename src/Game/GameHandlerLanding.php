<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Helper class to handle the landing page and the docs page in the Game21Controller
 */
class GameHandlerLanding
{
    /**
     * Returns associative array with data for the /game route
     * @return array<string,bool|string>
     */
    public function main(MdParser $parser, Game21Interface|null $game): array
    {
        $finished = true;
        if ($game && $game->gameOver() === false) {
            $finished = false;
        }

        $data = [
            'about' => $parser->getParsedText(),
            'page' => "game",
            'url' => "/game",
            'finished' => $finished,
        ];

        return $data;
    }

    /**
     * Returns associative array with data for the /game /doc route
     * @return array<string,bool|string>
     */
    public function doc(MdParser $parser): array
    {
        $data = [
            'about' => $parser->getParsedText(),
            'page' => "landing doc",
            'url' => "/game"
        ];

        return $data;
    }
}
