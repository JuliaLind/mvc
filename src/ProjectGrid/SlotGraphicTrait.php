<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for getting a graphic representation
 * of a slot in a grid (img link and alt text).
 * Empty slots are represented by empty string.
 * From kmom10/Project
 */
trait SlotGraphicTrait
{
    /**
     * @var array<array<string>> $grid
     */
    private array $grid = [];

    /**
     * Returns graphic representation of a slot in the grid
     * (i.e. an associative array with img link and alt text).
     * Empty slots are represented by associative array with empty strings
     * @return array<string,string>
     */
    private function slotGraphic(int $row, int $col): array
    {
        $grid = $this->grid;
        if (array_key_exists($row, $grid) && array_key_exists($col, $grid[$row])) {
            $card = $grid[$row][$col];
            return [
                'img' => "img/project/cards/".$card.".svg",
                'alt' => $card
            ];
        }
        return [
            'img' => "",
            'alt' => ""
        ];
    }
}
