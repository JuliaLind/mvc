<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";


trait RuleDataTrait
{
    private string $name;
    private int $points;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

}
