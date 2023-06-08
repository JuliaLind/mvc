<?php


// ta eventuellt bort denna

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;
use App\ProjectCard\Card;

require __DIR__ . "/../../vendor/autoload.php";


trait SameSuitTrait
{
    protected string $suit;

    /**
     * @param array<string,array<int,int>> $uniqueCountHand
     */
    protected function setSuit(array $uniqueCountHand): bool
    {
        /**
         * @var array<string,int> $suitsHand
         */
        $suitsHand = $uniqueCountHand['suits'];

        if (count($suitsHand) > 1) {
            return false;
        }

        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        $this->suit = $suit;
        return true;
    }
}
