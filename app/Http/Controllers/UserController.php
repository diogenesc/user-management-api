<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

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
        $validator= Validator::make($request->all(), $this->rules());
        if($validator->fails())
            return response()->json(['message' => "Some fields are invalid or missing"])->setStatusCode(500);

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
        try {
            $validator= Validator::make($request->all(), $this->rules());
            if($validator->fails())
                return response()->json(['message' => "Some fields are invalid or missing"])->setStatusCode(500);

            $userToUpdate = User::findOrFail($id);

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
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "User not found"])->setStatusCode(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $userToDelete = User::findOrFail($id);

            $userToDelete->delete();

            return ["message" => "User deleted"];
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "User not found"])->setStatusCode(404);
        }
    }

    public function rules() {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
        ];
    }
}
