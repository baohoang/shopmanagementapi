<?php

namespace App\Http\Controllers\api\v1\modules\forshops\product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $customClaims = JWTAuth::parseToken()->getPayload();
        $shop_id = $customClaims['shop_id'];
        return Category::listByShop($shop_id);
    }

    public function update(Request $request)
    {
        $params = $request->all();
        $category_id = $params['id'];
        $category = Category::find($category_id);
        $category->name = $params['name'];
        if ($category->save()) {
            return response(['message' => 'success'], 200);
        }
        return response(['message' => 'error'], 500);
    }

    public function delete(Request $request)
    {
        $category_id = $request->input('category');
        $category = Category::find($category_id);
        if ($category->delete()) {
            $products = Product::where('category_id', $category->id);
            foreach ($products as $product) {
                $product->delete();
            }
            return response(['message' => 'success'], 200);
        }
        return response(['message' => 'error'], 500);
    }

    public function store(Request $request)
    {
        $params = $request->input('name');
        $customClaims = JWTAuth::parseToken()->getPayload();
        $cate = new Category();
        $cate->name = $params;
        $cate->shop_id = $customClaims['shop_id'];
        if ($cate->save()) {
            return response(['message' => 'success', 'category' => $cate], 200);
        }
        return response(['message' => 'error'], 500);
    }

}
