<?php


// ta eventuellt bort denna

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightFlushStatTrait
{
    protected CardCounter $cardCounter;
    protected int $maxRank;
    protected int $minRank;
    protected string $suit;

    /**
     * @param array<Card> $cards
     */
    protected function checkForCards($cards, int $minRank): bool
    {
        $maxRank = $minRank + 4;
        $suit = $this->suit;
        $searcher = $this->searcher;

        for ($rank = $minRank; $rank <= $maxRank; $rank++) {
            if (!($searcher->search($cards, $rank, $suit))) {
                return false;
            }
        }
        return true;
    }
}
