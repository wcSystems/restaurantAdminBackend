<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use  App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
        return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {

            $user = new User;
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->img_profile = $request->input('img_profile');
            $user->role_id = $request->input('role_id');
            $user->master = $request->input('master');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->api_token = str_random(60);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Update a user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        // validate incoming request
        $this->validate($request, [
            'id' => 'required',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'role_id' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $user = new User;
            $user->id = $request->input('id');
            $user = User::findOrFail($user->id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Not Find!', 'user_id' => $user->id, 'error' => $e], 409);
        }
        try {
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->img_profile = $request->input('img_profile');
            $user->role_id = $request->input('role_id');
            $user->master = $request->input('master');
            $user->status = $request->input('status');
            if (!$request->input('password') === '') {
                $plainPassword = $request->input('password');
                $user->password = app('hash')->make($plainPassword);
            }

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'UPDATE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Updte Failed!', 'error' => $e], 409);
        }
    }

    /**
     * Delete a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Not Find!', 'user_id' => $id, 'error' => $e], 409);
        }
        try {
            $user->delete();
            return response()->json(['user' => $user, 'message' => 'DELETE'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Delete Failed!', 'error' => $e], 409);
        }
    }
}
