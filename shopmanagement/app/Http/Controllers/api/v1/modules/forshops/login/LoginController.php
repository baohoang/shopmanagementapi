<?php

namespace App\Http\Controllers\api\v1\modules\forshops\login;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class LoginController extends Controller
{
    //
    public function test(Request $request){
        $statusCode = 500;
        return response(['message' => 'success'], 200);
    }
    public function login(Request $request)
    {
        $statusCode = 500;
        $response = [];

        $credentials = $request->only('email', 'password');


        $user = User::checkAccount($credentials);
        if ($user) {
            $staff = $user->isStaff();
            if ($staff) {
                $statusCode = 200;
                $menuItems = $staff->getMenuItems();
                $shop = $staff->shop;
                $response['menuItems'] = $menuItems;
                $customClaims = ['shop_id' => $shop->id];
                $token = JWTAuth::fromUser($user,$customClaims);
                $response['token'] = $token;
                $response['username'] = $user->name;
                $response['shop'] = $shop->name;
            }
        }
        return response($response, $statusCode);
    }

    public function logout(Request $request)
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        return response(['message' => 'success'], 200);
    }

    public function insert()
    {
        User::insert(['username' => 'admin', 'password' => Hash::make('1234')]);
    }
}
