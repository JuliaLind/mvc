<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait SameSuitTrait
{
    private string $suit;
    abstract private function countBySuit($cards): array;

    /**
     * @param array<string> $hand
     */
    private function setSuit(array $hand): bool
    {
        /**
         * @var array<string,int> $suits
         */
        $suits = $this->countBySuit($hand);
        /**
         * @var string $suit
         */
        $suit = array_key_first($suits);
        $this->suit = $suit;
        return count($suits) === 1;
    }
}
