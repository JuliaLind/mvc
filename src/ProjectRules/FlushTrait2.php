<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait FlushTrait2
{
    /**
     * @param array<string> $cards
     * @return array<string,int>
     */
    abstract private function countBySuit(array $cards): array;

    /**
     * @param array<string> $deck
     */
    public function possibleDeckOnly(array $deck): bool
    {
        /**
         * @var array<string,int> $suits
         */
        $suits = $this->countBySuit($deck);
        return max($suits) >= 5;
    }
}
