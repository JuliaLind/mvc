<?php

namespace App\ProjectRules;

use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait StraightStatTrait
{
    /**
     * @param array<Card> $cards
     */
    protected function checkAllPossible($cards): bool
    {
        $possible = false;
        $minLimits = $this->minRankLimits();
        $minMinRank = $minLimits['min'];
        $maxMinRank = $minLimits['max'];
        for ($minRank = $minMinRank; $minRank <= $maxMinRank; $minRank++) {
            $possible = $this->checkForCards($cards, $minRank);
            if ($possible === true) {
                break;
            }
        }
        return $possible;
    }
}
