<?php

namespace Nextbyte\Distance\Facades;

use Illuminate\Support\Facades\Facade;

class GeocodeDistance extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'geocode-distance';
    }
}
