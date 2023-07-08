<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Generates message based on suggestion-data for user
 */
trait SuggestMessageTrait
{
    /**
     * Generates a message based on the
     * suggestion data (suggested slot and rules
     * that can be scored if placing the dealt
     * card into the suggsted slot)
     * @param array<string,array<int,array<string,float|int|string>|int>|float|string> $suggestion
     */
    private function createMessage(array $suggestion): string
    {
        /**
         * @var array<int> $slot
         */
        $slot = $suggestion["slot"];
        $row = $slot[0];
        $col = $slot[1];
        /**
         * @var string $rowRule
         */
        $rowRule = $suggestion['row-rule'];
        /**
         * @var string $colRule
         */
        $colRule = $suggestion['col-rule'];
        $message = "";
        if ($rowRule != "" && $colRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$rowRule} horizontally and/or {$colRule} vertically.";
        } elseif ($rowRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$rowRule} horizontally.";
        } elseif ($colRule != "") {
            $message = "Place card in row {$row} column {$col} for possible {$colRule} vertically.";
        }
        return $message;
    }
}
