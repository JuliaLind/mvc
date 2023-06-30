<?php

namespace App\ProjectGrid;

/**
 * Class representing 5x5 grid for placing cards
 */
class Grid
{
    use AddCardTrait;
    use CardCountTrait;
    use GraphicTrait;
    use RemoveCardTrait;
    use RowsColsTrait;
    use SlotGraphicTrait;
}
