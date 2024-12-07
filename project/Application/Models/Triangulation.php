<?php

namespace Models;
class Triangulation
{

    /*** convert latitude and longitude to XYZ coordinates ***/
    /***
     * @param float $lat
     * @param float $lon
     * @return array (x, y, z)
     */
    protected function toXYZ(float $lat, float $lon): array
    {
        $latRad = deg2rad($lat);
        $lonRad = deg2rad($lon);

        $x = self::EARTH_RADIUS * cos($latRad) * cos($lonRad);
        $y = self::EARTH_RADIUS * cos($latRad) * sin($lonRad);
        $z = self::EARTH_RADIUS * sin($latRad);

        return [$x, $y, $z];
    }

    /*** calculate distance between two points ***/
    /***
     * @param array $point1
     * @param array $point2
     * @return float
     */
    protected function calculate(array $point1, array $point2): float
    {
        // convert latitude and longitude to cartesian coordinates
        $cartsianPoints = array_map(
            function ($point) {
                return $this->toXYZ($point['lat'], $point['lon']);
            },
            [$point1, $point2]
        );
    }

}
