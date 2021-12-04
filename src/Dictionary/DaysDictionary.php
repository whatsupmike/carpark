<?php

declare(strict_types=1);

namespace App\Dictionary;

class DaysDictionary
{
    static function getLocalizedDayName(int $day): string
    {
        return match($day){
            0 => 'niedz',
            1 => 'pon',
            2 => 'wt',
            3 => 'śr',
            4 => 'czw',
            5 => 'pt',
            6 => 'sob',
        };
    }
}
