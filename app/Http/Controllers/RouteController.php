<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;
use App\Services\RouteService as Service;
use Illuminate\Support\Facades\Session;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Service::getRoutes();
        return view('agent.routes.index')->with(compact('routes'));
    }

    public function create()
    {
        $terminals = Service::getTerminals();
        return view('agent.routes.create')->with(compact('terminals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'departure' => 'required|numeric',
            'destination' => 'required|numeric',
            'name' => 'required|string|unique:routes',
            'departure_time' => 'required|string|max:5|min:4',
            'arrival_time' => 'required|string|max:5|min:4',
        ]);

        if($request->departure == $request->destination)
        {
            Session::flash('terminals_match');
            return back();
        }

        if(preg_match('/([01]?[0-9]|2[0-3]):[0-5][0-9]/u', $request->departure_time)
        && preg_match('/([01]?[0-9]|2[0-3]):[0-5][0-9]/u', $request->arrival_time))
        {
            $route = new Route();
            $route->name = mb_strtoupper($request->name);
            $route->departure = $request->departure;
            $route->destination = $request->destination;
            $route->departure_time = new \DateTime($request->departure_time);
            $route->arrival_time = new \DateTime($request->arrival_time);
            $route->save();

            Session::flash('success');
            return back();
        }
    }

    public function show()
    {

    }

    public function edit($route = null)
    {
        $route = Service::getRouteById($route);
        return view('agent.routes.edit')->with(compact('route'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'departure' => 'required|numeric',
            'destination' => 'required|numeric',
            'name' => 'required|string',
            'departure_time' => 'required|string|max:5|min:4',
            'arrival_time' => 'required|string|max:5|min:4',
        ]);

        if($request->departure == $request->destination)
        {
            Session::flash('terminals_match');
            return back();
        }

        if(preg_match('/([01]?[0-9]|2[0-3]):[0-5][0-9]/u', $request->departure_time)
            && preg_match('/([01]?[0-9]|2[0-3]):[0-5][0-9]/u', $request->arrival_time))
        {
            $route = Route::where('name', $request->name)->first();
            $route->name = mb_strtoupper($request->name);
            $route->departure = $request->departure;
            $route->destination = $request->destination;
            $route->departure_time = new \DateTime($request->departure_time);
            $route->arrival_time = new \DateTime($request->arrival_time);
            $route->save();

            Session::flash('success');
            return back();
        }
    }

    public function destroy($route = null)
    {
        $route = Route::where('id', $route)->delete();

        if($route == 1)
        {
            Session::flash('delete_success');
            return back();
        }

        Session::flash('delete_fail');
        return back();

    }

}
