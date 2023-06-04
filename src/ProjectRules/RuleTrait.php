<?php

namespace App\ProjectRules;

use App\ProjectCard\CardCounter;

require __DIR__ . "/../../vendor/autoload.php";


trait RuleTrait
{
    protected CardCounter $cardCounter;
    protected int $points;
    protected string $name;
}
