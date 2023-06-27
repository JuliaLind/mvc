<?php


// ta eventuellt bort denna

namespace App\ProjectRules;

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
        /**
         * @var string $suit
         */
        $suit = array_key_first($suitsHand);
        $this->suit = $suit;
        return count($suitsHand) === 1;
    }
}
