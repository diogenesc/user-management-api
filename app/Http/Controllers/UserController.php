<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\BadRequestException;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = User::all();

        return response()->json($allUsers)->header("X-Total-Count", $allUsers->count());
    }

    /**
     * Display a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }
    }
    
    /**
     * Store a newly created user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(), $this->rules());

        if($validator->fails())
            throw new BadRequestException();

        $userToSave = new User;

        $userToSave->name = $request->name;
        $userToSave->cpf = $request->cpf;
        $userToSave->birthday = $request->birthday;
        $userToSave->email = $request->email;
        $userToSave->phone_number = $request->phone_number;
        $userToSave->address = $request->address;
        $userToSave->city = $request->city;
        $userToSave->state = $request->state;

        $userToSave->save();

        return response()->json($userToSave);
    }

    /**
     * Update the specified user in database.
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
                throw new BadRequestException();

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
            throw new UserNotFoundException();
        }
    }

    /**
     * Remove the user from database.
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
            throw new UserNotFoundException();
        }
    }

    // Rules for request validation
    public function rules() {
        $email_regex = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/';
        $cpf_regex = '/\d{3}\.\d{3}\.\d{3}\-\d{2}/';

        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:255', 'regex:' . $cpf_regex],
            'birthday' => ['required', 'date'],
            'email' => ['required', 'string', 'max:255', 'regex:' . $email_regex],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
        ];
    }
}
