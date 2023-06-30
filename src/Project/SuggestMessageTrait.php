<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

trait SuggestMessageTrait
{
    /**
     * @param array<string,array<int,int|string>|int|string> $suggestion
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
