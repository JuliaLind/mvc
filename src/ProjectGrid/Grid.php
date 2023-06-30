<?php

namespace App\ProjectGrid;

/**
 * Class representing a grid for cards
 */
class Grid
{
    use AddCardTrait;
    use CardCountTrait;
    use GraphicTrait;
    use RemoveCardTrait;
    use RowsColsTrait;
}
