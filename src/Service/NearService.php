<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 18:44
 */
namespace App\Service;

class NearService
{
    /**
     * @param $lat
     * @param $lng
     * @param $radius
     * @return array
     */
    public function getLatitudeLongitude(float $lat, float $lng, int $radius)
    {
        $distance = (int)$radius;
        $earthRadius = 6371;
        // $lat1 = deg2rad($lat);
        // $lon1 = deg2rad($lng);
        // $bearing = deg2rad(0);

        // $lat2 = asin(sin($lat1) * cos($distance / $earthRadius) + cos($lat1) * sin($distance / $earthRadius) * cos($bearing));
        // $lon2 = $lon1 + atan2(sin($bearing) * sin($distance / $earthRadius) * cos($lat1), cos($distance / $earthRadius) - sin($lat1) * sin($lat2));

        $new_latitude  = $lat  + ($distance / $earthRadius) * (180 / pi());
        $new_longitude = $lng + ($distance / $earthRadius) * (180 / pi()) / cos($lat * pi()/180);

        return ['lat' => /* rad2deg($lat2) */$new_latitude, 'lng' => /* rad2deg($lon2) */  $new_longitude];
    }
}
