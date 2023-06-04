<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

require __DIR__ . "/../../vendor/autoload.php";


trait RuleTrait
{
    private CardCounter $cardCounter;
    private int $points;
    private string $name;
}
