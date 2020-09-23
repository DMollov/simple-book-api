<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * [Login - check if user credentials match those in our database.]
     * @bodyParam  email required The email of the user.
     * @bodyParam  password required The password of the user.
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['status' => 'Invalid login credentials.']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response()->json([
            'user' => Auth::user(),
            'access_token' => $accessToken
        ]);
    }

    /**
     * [Create a new user in the database.]
     * @bodyParam  name required The name of the user.
     * @bodyParam  email required The email of the user.
     * @bodyParam  password required The password of the user.
     * @bodyParam  is_author required Is the user an author?
     * @bodyParam  notifications required Enable notifications for the user?
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:8|max:255|confirmed',
            'is_author' => 'required|boolean',
            'notifications' => 'required|boolean',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_author' => $request->is_author,
            'notifications' => $request->notifications,
        ]);


        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'access_token' => $accessToken
        ]);
    }

    /**
     * [Returns a collection of authors.]
     */

    public function authors()
    {
        $users = User::where('is_author', '1')->select('id', 'name')->get();

        return $users;
    }

}
