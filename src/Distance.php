<?php

namespace Nextbyte\Distance;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Distance
{
    /**
     * @var float
     */
    public $length;

    /**
     * @var string
     */
    public $lengthText;

    /**
     * @var float
     */
    public $lengthBeforeOffset;

    /**
     * @var float
     */
    public $lengthOffset;

    /**
     * Duration in seconds
     *
     * @var int
     */
    public $duration;

    /**
     * Duration in human readable text
     *
     * @var string
     */
    public $durationText;

    /**
     * @var array
     */
    public $data;

    protected function __construct(array $attributes)
    {
        foreach ($attributes as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
            }
        }
    }

    public static function create(array $attributes): Distance
    {
        return new static($attributes);
    }

    public function toArray() : array
    {
        return get_object_vars($this);
    }
}
