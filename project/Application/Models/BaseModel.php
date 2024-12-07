<?php

namespace Models;
abstract class BaseModel
{
    protected const EARTH_RADIUS = 6371;
    // convert latitude and longitude to cartesian coordinates without body

    /***
     * @param float $latitude
     * @param float $longitude
     * @return array (x, y, z)
     */
    abstract protected function toXYZ(float $latitude, float $longitude): array;

    // calculate distance between two points

    /***
     * @param array $point1
     * @param array $point2
     * @return float
     */
    abstract protected function calculate(array $point1, array $point2): float;
}
