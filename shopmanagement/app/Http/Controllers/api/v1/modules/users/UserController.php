<?php

namespace App\Http\Controllers\api\v1\modules\users;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $statusCode = 500;
        $response = [];

        $credentials = $request->only('email', 'password');


        $user = User::check($credentials);
        if ($user) {
            $level = $user->staffLevel();
            if (!$level) {

            }
        }
        return Response::json($response, $statusCode);

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }


    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        JWTAuth::invalidate($request->input('token'));
    }

    public function insert()
    {
        User::insert(['name' => 'bao', 'email' => 'bao@gmail.com', 'password' => Hash::make('123456')]);
    }

}
