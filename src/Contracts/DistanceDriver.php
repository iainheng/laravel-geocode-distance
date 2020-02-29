<?php

namespace Nextbyte\Distance\Contracts;


interface DistanceDriver
{
    /**
     * Calculate distance between 2 coordinates
     *
     * @param $latitude1
     * @param $longitude1
     * @param $latitude2
     * @param $longitude2
     * @return \Nextbyte\Distance\Distance
     */
    public function distance($latitude1, $longitude1, $latitude2, $longitude2);
}
