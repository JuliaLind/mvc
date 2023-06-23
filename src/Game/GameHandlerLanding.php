<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";
use App\Markdown\MdParser;

/**
 * Helper class to handle the landing page and the docs page in the Game21Controller
 */
class GameHandlerLanding
{
    public MdParser $parser;

    public function __construct(MdParser $parser = new MdParser())
    {
        $this->parser = $parser;
    }

    /**
     * Returns associative array with data for the /game route
     * @return array<string,bool|string>
     */
    public function main(Game21Interface|null $game, string $filename = "markdown/game21.md"): array
    {
        $finished = true;

        if ($game) {
            $finished = $game->gameOver();
        }

        return [
            'about' => $this->parser->getParsedText($filename),
            'page' => "game",
            'url' => "/game",
            'finished' => $finished,
        ];
    }

    /**
     * Returns associative array with data for the /game /doc route
     * @return array<string,bool|string>
     */
    public function doc(string $filename = "markdown/doc.md"): array
    {
        return [
            'about' => $this->parser->getParsedText($filename),
            'page' => "landing doc",
            'url' => "/game"
        ];
    }
}
