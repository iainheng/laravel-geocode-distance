<?php

namespace Nextbyte\Distance\Drivers;

use Nextbyte\Distance\Contracts\DistanceDriver;

abstract class Driver implements DistanceDriver
{
    protected function secondsToHours($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;
        return "$hours hours $minutes mins";
    }
}
