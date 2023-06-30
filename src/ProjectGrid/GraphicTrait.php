<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for getting a graphic representation (img links and alt text)
 * of the Grid. Emtpy slots are represented with emtpy strings
 */
trait GraphicTrait
{
    /**
     * Returns graphic representation of a slot in the grid
     * (i.e. an associative array with img link and alt text).
     * Empty slots are represented by associative array with empty strings
     * @return array<string,string>
     */
    abstract private function slotGraphic(int $row, int $col): array;

    /**
     * Returns graphic representation of all slots in the grid
     * (i.e. a two-dimensional array with associative arrays containing img link and alt text).
     * Empty slots are represented by associative array with empty strings
     * @return array<int,mixed>
     */
    public function graphic(): array
    {
        $gridGraphic = [];
        for ($row = 0; $row < 5; $row++) {
            for ($col = 0; $col < 5; $col++) {
                $gridGraphic[$row][$col] = $this->slotGraphic($row, $col);
            }
        }

        return $gridGraphic;
    }
}
