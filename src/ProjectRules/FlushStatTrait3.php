<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushStatTrait3
{
    /**
     * @return array<string,int>
     */
    abstract private function countBySuit($cards): array;

    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<string,int> $suits
         */
        $suits = $this->countBySuit($deck);
        // return $deck != [] && max($suitsInDeck) >= 5;
        return max($suits) >= 5;
    }
}
