<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terminal;

class TerminalController extends Controller
{
    public function index()
    {
        return Terminal::all('id', 'name', 'short_name', 'location');
    }


    /**
     * Returns all destinations available for a particular terminal
     *
     */
    public function destinations($id)
    {
        return Terminal::distinct() ->select('terminals.id', 'terminals.name', 'terminals.short_name', 'terminals.location')
                                    ->join('routes', 'terminals.id', '=', 'routes.destination')
                                    ->where('routes.departure', $id)
                                    ->orderBy('terminals.id')
                                    ->get();
    }
}
