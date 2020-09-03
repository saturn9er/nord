<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 30/03/2018
 * Time: 7:02 PM
 */

namespace App\Services;


class LocationService
{
    public static function implodeLocation($location)
    {
        $location = explode ( ', ', $location);
        return $location;
    }
}