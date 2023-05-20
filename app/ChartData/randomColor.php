<?php

namespace App\ChartData;

class RandomColor
{
    public static function  random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
