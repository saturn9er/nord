<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Services\PassengerEditService as EditService;

class PassengerController extends Controller
{
    public function edit()
    {
        $passenger = EditService::getPassengerData();
        return view('passenger.edit')->with(compact('passenger'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;

        EditService::edit($name, $email, $password);

        Session::flash('success');

        return back();
    }
}
