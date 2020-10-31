<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userToStore = new User;

        $userToStore->name = $request->name;
        $userToStore->cpf = $request->cpf;
        $userToStore->birthday = $request->birthday;
        $userToStore->email = $request->email;
        $userToStore->phone_number = $request->phone_number;
        $userToStore->address = $request->address;
        $userToStore->city = $request->city;
        $userToStore->state = $request->state;

        $userToStore->save();

        return response()->json($userToStore);
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
        $userToUpdate = User::find($id);

        $userToUpdate->name = $request->name;
        $userToUpdate->cpf = $request->cpf;
        $userToUpdate->birthday = $request->birthday;
        $userToUpdate->email = $request->email;
        $userToUpdate->phone_number = $request->phone_number;
        $userToUpdate->address = $request->address;
        $userToUpdate->city = $request->city;
        $userToUpdate->state = $request->state;

        $userToUpdate->save();

        return $userToUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
