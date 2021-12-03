<?php

declare(strict_types=1);

namespace App\Dictionary;

class GridTileDictionary
{
    public const DESK_TOP_OCCUPIED = 1;
    public const DESK_BOTTOM_OCCUPIED = 2;
    public const DESK_LEFT_OCCUPIED = 3;
    public const DESK_RIGHT_OCCUPIED = 4;

    public const DESK_TOP_FREE = 5;
    public const DESK_BOTTOM_FREE = 6;
    public const DESK_LEFT_FREE = 7;
    public const DESK_RIGHT_FREE = 8;

    public const CORRIDOR = 9;
    public const ENTRANCE = 10;
}