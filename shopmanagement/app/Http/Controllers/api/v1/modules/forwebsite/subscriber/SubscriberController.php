<?php
namespace App\Http\Controllers\api\v1\modules\forwebsite\subscriber;

use App\Http\Controllers\Controller;
use App\Models\Subscirber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;


/**
 * Created by PhpStorm.
 * User: HungChelsea
 * Date: 09-May-16
 * Time: 9:12 PM
 */
class SubscriberController extends Controller
{
    public function test(Request $request)
    {
        return response(['message' => 'success'], 200);
    }

    public function insertsubscriber(Request $request)
    {
        $params = $request->all();
        $objSuscriber = new Subscirber();
        $objSuscriber->name_shop = $params['name_shop'];
        $objSuscriber->category_id = $params['category_id'];
        $objSuscriber->username = $params['username'];
        $objSuscriber->phone = $params['phone'];
        $objSuscriber->address = $params['address'];
        $objSuscriber->email = $params['email'];
        $objSuscriber->password = bcrypt($params['password']);
        $objSuscriber->created_at = time();
        $objSuscriber->updated_at = time();
        if ($objSuscriber->save()) {
            return response(['message' => 'success', 'product' => $objSuscriber], 200);
        }
        return response(['message' => 'error'], 500);

    }
}