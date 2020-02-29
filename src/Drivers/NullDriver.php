<?php

namespace Nextbyte\Distance\Drivers;

use Nextbyte\Distance\Distance;

class NullDriver extends Driver
{
    /**
     * @inheritDoc
     */
    public function distance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $rawDistance = $this->haversineDistance($latitude1, $longitude1, $latitude2, $longitude2);
        $offset = $this->distanceOffset($rawDistance);
        $distance = $rawDistance + $offset;

        return Distance::create([
            'length' => (float) number_format($distance, 2),
            'lengthText' => number_format($distance, 2) . ' km',
            'lengthOffset' => (float) number_format($offset, 2),
            'lengthBeforeOffset' => (float) number_format($rawDistance, 2),
        ]);
    }

    /**
     * Calculate distance between 2 coordinates with haversine formula
     *
     * @param $latitude1
     * @param $longitude1
     * @param $latitude2
     * @param $longitude2
     * @return float|int
     */
    protected function haversineDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earth_radius = 6371;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
    }

    /**
     * Adjust distance offset calculated
     *
     * @param $distance
     *
     * @return float|int
     */
    protected function distanceOffset($distance)
    {
        if ($distance <= 20) {
            return $distance * 0.55;
        } else if ($distance <= 30) {
            return $distance * 0.45;
        } else if ($distance <= 40) {
            return $distance * 0.38;
        } else if ($distance <= 50) {
            return $distance * 0.28;
        }

        return $distance * 0.18;
    }
}
