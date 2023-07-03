<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Contains methods for getting the name
 * of the rule and the points the rule gives if scored
 */
trait RuleDataTrait
{
    private string $name;
    private int $points;

    /**
     * Returns the name if the rule
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns rule's worth in points
     */
    public function getPoints(): int
    {
        return $this->points;
    }

}
