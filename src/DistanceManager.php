<?php

namespace Nextbyte\Distance;

use GoogleMaps\GoogleMaps;
use Illuminate\Support\Manager;
use Nextbyte\Distance\Contracts\DistanceDriver;
use Nextbyte\Distance\Drivers\GoogleMapsDriver;
use Nextbyte\Distance\Drivers\NullDriver;

/**
 * Class DistanceManager
 *
 * @package Nextbyte\Distance
 * @method DistanceDriver driver($driver = null)
 */
class DistanceManager extends Manager
{
    /**
     * Get a driver instance.
     *
     * @param  string|null  $name
     * @return \Nextbyte\Distance\Contracts\DistanceDriver
     */
    public function vendor($name = null)
    {
        return $this->driver($name);
    }

    /**
     * @return GoogleMapsDriver
     */
    public function createGoogleMapsDriver()
    {
        return new GoogleMapsDriver($this->container->make(GoogleMaps::class));
    }

    /**
     * Create a Null Distance driver instance.
     *
     * @return \Nextbyte\Distance\Drivers\NullDriver
     */
    public function createNullDriver()
    {
        return new NullDriver;
    }

    /**
     * Get the default Distance driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->container['config']['distance.default'] ?? 'null';
    }
}
