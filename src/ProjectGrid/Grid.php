<?php

namespace App\ProjectGrid;

/**
 * Class representing 5x5 grid for placing cards, from kmom10/Project
 */
class Grid
{
    use AddCardTrait;
    use CardCountTrait;
    use GraphicTrait;
    use RemoveCardTrait;
    use RowsTrait;
    use SlotGraphicTrait;
}
