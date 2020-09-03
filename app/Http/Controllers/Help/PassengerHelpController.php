<?php

namespace App\Http\Controllers\Help;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PassengerHelpController extends Controller
{
    public function __invoke()
    {
        return view('passenger.help.help');
    }
}
