<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 19/03/2018
 * Time: 4:26 PM
 */

namespace App\Services;


use App\Route;
use App\Terminal;

class RouteService
{
    public static function getRoutes()
    {
        $routes = Route::select('routes.id', 'routes.name', 'departure.name as departure', 'destination.name as destination', 'routes.departure_time', 'routes.arrival_time')
                    ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
                    ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
                    ->orderBy('routes.id')
                    ->paginate(10);

        return $routes;
    }

    public static function getRouteById($route)
    {
        $route = Route::where('id', $route)->first();
        return $route;
    }

    public static function getTerminals()
    {
        $terminals = Terminal::select('id', 'name')->orderBy('name')->get();

        return $terminals;
    }
}