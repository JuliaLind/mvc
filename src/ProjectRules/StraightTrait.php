<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightTrait
{
    protected CardCounter $cardCounter;
    protected int $maxRank;
    protected int $minRank;

    /**
     * @param array<Card> $cards
     * @param string $suit
     */
    private function checkForCards($cards, $suit): bool
    {
        $possible = true;
        $searcher = $this->searcher;
        for ($rank = $this->minRank; $rank <= $this->maxRank; $rank++) {
            $possible = $searcher->search($cards, $rank, $suit);
            if ($possible === false) {
                break;
            }
        }
        return $possible;
    }
}
