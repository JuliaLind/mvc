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
    public function main(Game21Interface|null $game, MdParser $parser = new MdParser(), string $filename = "markdown/game21.md"): array
    {
        $finished = true;

        if ($game) {
            $finished = $game->gameOver();
        }



        return [
            'about' => $parser->getParsedText($filename),
            'page' => "game",
            'url' => "/game",
            'finished' => $finished,
        ];
    }

    /**
     * Returns associative array with data for the /game /doc route
     * @return array<string,bool|string>
     */
    public function doc(MdParser $parser = new MdParser(), string $filename = "markdown/doc.md"): array
    {
        return [
            'about' => $parser->getParsedText($filename),
            'page' => "landing doc",
            'url' => "/game"
        ];
    }
}
