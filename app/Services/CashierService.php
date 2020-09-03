<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 27/03/2018
 * Time: 9:03 PM
 */

namespace App\Services;
use App\Cashier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CashierService
{
    public static function getCashiers()
    {
        $cashiers = Cashier::select('id', 'name', 'email')->paginate(10);
        return $cashiers;
    }

    public static function getCashierById($id)
    {
        return Cashier::select('id', 'name', 'email')->where('id', $id)->first();

    }

    public static function createCashier($request)
    {
        $cashier = new Cashier();
        $cashier->name = $request->name;
        $cashier->email = $request->email;
        $cashier->password = bcrypt($request->password);
        $cashier->save();
    }

    public static function updateCashier($id,$name, $email, $password)
    {
        $cashier = Cashier::where('id', $id)->first();

        $cashier->name    = $name;

        if($cashier->email != $email)
        {
            $validator = ['email' => $email];
            Validator::make($validator, [
                'email' => 'unique:cashiers'
            ])->validate();

            $cashier->email = $email;
        };

        if(!empty($password))
        {
            $cashier->password = Hash::make($password);
            Session::flash('password_success');
        }

        $cashier->save();
    }

    public static function deleteCashierById($id)
    {
        return Cashier::where('id', $id)->delete();
    }
}