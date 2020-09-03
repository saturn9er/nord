<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CashierService as Service;
use Illuminate\Support\Facades\Session;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashiers = Service::getCashiers();
        return view('agent.users.cashiers.index')->with(compact('cashiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.users.cashiers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:agents',
            'password' => 'required|min:6|confirmed',
        ]);

        Service::createCashier($request);

        Session::flash('create_success');
        return redirect('agent/users/cashiers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cashier = Service::getCashierById($id);

        return view('agent.users.cashiers.edit')->with(compact('cashier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'password' => 'nullable|min:6|max:191',
        ]);

        $name       = $request->name;
        $email      = $request->email;
        $password   = $request->password;

        Service::updateCashier($id, $name, $email, $password);

        Session::flash('edit_success');

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Service::deleteCashierById($id) == 1)
        {
            Session::flash('delete_success');
            return back();
        }

        Session::flash('delete_fail');
        return back();
    }
}
