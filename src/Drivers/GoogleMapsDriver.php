<?php

namespace Nextbyte\Distance\Drivers;

use Carbon\Carbon;
use GoogleMaps\GoogleMaps;
use Nextbyte\Distance\Distance;

class GoogleMapsDriver extends Driver
{
    /**
     * @var GoogleMaps
     */
    protected $googleMaps;

    /**
     * Create a new GoogleMaps driver instance.
     *
     * @param GoogleMaps $googleMaps
     * @return void
     */
    public function __construct(GoogleMaps $googleMaps)
    {
        $this->googleMaps = $googleMaps;
    }

    /**
     * @inheritDoc
     */
    public function distance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $response = $this->googleMaps->load('distancematrix')
            ->setParam ([
                'origins'    => "{$latitude1},{$longitude1}",
                'destinations' => "{$latitude2},{$longitude2}"
            ])
            ->get();

        return Distance::create($this->parseResponse(json_decode($response)));
    }

    /**
     * @param object $response
     * @return array
     */
    protected function parseResponse($response)
    {
        $durationInSecs = data_get($response, 'rows.0.elements.0.duration.value');

        return [
            'length' => data_get($response, 'rows.0.elements.0.distance.value') / 1000,
            'lengthText' => data_get($response, 'rows.0.elements.0.distance.text'),
            'duration' => $durationInSecs,
            'durationText' => data_get($response, 'rows.0.elements.0.duration.text'),
            'data' => $response
        ];
    }
}
