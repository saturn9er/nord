<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 27/03/2018
 * Time: 9:03 PM
 */

namespace App\Services;
use App\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AgentService
{
    public static function getAgents()
    {
        $agents = Agent::select('id', 'name', 'email')->paginate(10);
        return $agents;
    }

    public static function getAgentById($id)
    {
        return Agent::select('id', 'name', 'email')->where('id', $id)->first();

    }

    public static function createAgent($request)
    {
        $agent = new Agent();
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->password = bcrypt($request->password);
        $agent->save();
    }

    public static function updateAgent($id,$name, $email, $password)
    {
        $agent = Agent::where('id', $id)->first();

        $agent->name    = $name;

        if($agent->email != $email)
        {
            $validator = ['email' => $email];
            Validator::make($validator, [
                'email' => 'unique:agents'
            ])->validate();

            $agent->email = $email;
        };

        if(!empty($password))
        {
            $agent->password = Hash::make($password);
            Session::flash('password_success');
        }

        $agent->save();
    }

    public static function deleteAgentById($id)
    {
        return Agent::where('id', $id)->delete();
    }
}