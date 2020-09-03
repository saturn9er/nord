<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 15/03/2018
 * Time: 8:24 PM
 */

namespace App\Services;

use App\Passenger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class PassengerEditService
{
    public static function getPassengerData()
    {
        $passengerID = Auth::id();

        return Passenger::select('name', 'email')
                        ->where('id', $passengerID)
                        ->first();
    }

    public static function edit($name, $email, $password)
    {
       $passengerID = Auth::id();

       $passenger = Passenger::where('id', $passengerID)->first();

       $passenger->name = $name;
       $passenger->email = $email;
       if(!empty($password))
       {
           $passenger->password = Hash::make($password);
           Session::flash('password_success');
       }
       $passenger->save();
    }
}