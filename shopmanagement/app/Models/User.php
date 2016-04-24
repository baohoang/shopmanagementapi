<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public static function checkAccount($params)
    {
        $user = User::where('email', $params['email'])->first();
        if ($user != null) {
            $check = Hash::check($params['password'], $user->password);
            if ($check) {
                return $user;
            }
        }
        return false;
    }

    public function isStaff()
    {
        $staff = ShopStaff::where('user_id', $this->id)->first();
        if ($staff != null) {
            return $staff;
        }
        return false;
    }

}
