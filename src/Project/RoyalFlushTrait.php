<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";


trait RoyalFlushTrait
{
    /**
     * @var int $MAXRANK corresponds to Ace
     */
    private const MAXRANK = 14;

    /**
     * @var int $MINRANK corresponds to Ten
     */
    private const MINRANK = 10;

    /**
     * @var int $UNIQUESUITS
     */
    private const UNIQUESUITS = 1;

    private CardCounter $cardCounter;
}
