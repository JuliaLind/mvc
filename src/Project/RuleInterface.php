<?php

namespace App\Project;

/**
 * Interface to be implemented by the classes Game21Easy and Game21Hard
 */
interface RuleInterface
{
    /**
     * @param array<mixed> $data
     * @return array<string,string|int|bool> true if rule is fullfilled otherwise false
     */
    public function scored(array $data);

    // /**
    //  * @return int points
    //  */
    // public function getPoints();

    // /**
    //  * @return string name of the rule
    //  */
    // public function getName();

    // /**
    //  * @param array<mixed> $data
    //  * @return bool true if rule is still possible given passed value
    //  * otherwise false
    //  */
    // public function possible(array $data, Card $card);
}
