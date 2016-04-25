<?php

namespace App\Http\Controllers\api\v1\modules\forshops\product;

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use JWTAuth;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        if (isset($input['functionName'])) {
            $functionName = $input['functionName'];
            if ($functionName == 'listAll') {
                $limit = $input['limit'];
                $search = $input['searchName'];
                $customClaims = JWTAuth::parseToken()->getPayload();
                $shop_id = $customClaims['shop_id'];
                return Product::listByShop($shop_id, $limit, $search);
            }
            if ($functionName == 'listByCategory') {
                $limit = $input['limit'];
                $search = $input['searchName'];
                $cate_id = $input['category_id'];
                return Product::listByCategory($cate_id, $limit, $search);
            }
        }
        return response(['message' => 'error'], 500);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            if ($file->isValid()) {
                $fileExt = $file->getClientOriginalExtension();
                $destinationPath = 'upload/images/products';
                $productId = $request->input('product_id');
                $productImage = new ProductImages();
                $productImage->product_id = $productId;
                $productImage->is_favicon = 0;
                $now = Carbon::now()->timestamp;
                $productImage->src = 'http://localhost:8086/' . $destinationPath . '/' . $now . '.' . $fileExt;
                if ($productImage->save()) {
                    $file->move($destinationPath, $productImage->src);
                    return response(['message' => 'success', 'product_image' => $productImage], 200);
                }
            }
        }
        return response(['message' => 'error'], 500);
    }

    public function deleteImage(Request $request)
    {

        $image_id = $request->input('image');
        $image = ProductImages::find($image_id);
        if ($image->delete()) {
            $str = explode('/', $image->src);
            unlink(public_path('upload/images/products/' . end($str)));
            return response(['message' => 'success'], 200);
        }
        return response(['message' => 'error'], 500);
    }

    public function update(Request $request)
    {
        $params = $request->input('product');

        $product = Product::find($params['id']);
        $product->name = $params['name'];
        $product->price = $params['price'];
        $product->colors = $params['colors'];
        $product->sale_off = $params['sale_off'];
        $product->discount = $params['discount'];
        $product->quantity = $params['quantity'];
        $product->description = $params['description'];
        $product->category_id = $params['category_id'];
        if ($product->save()) {
            if (isset($params['images'])) {
                $images = $params['images'];
                foreach ($images as $image) {
                    $img = ProductImages::find($image['id']);
                    $img->is_favicon = $image['is_favicon'];
                    $img->save();
                }
            }
            return response(['message' => 'success'], 200);
        }
        return response(['message' => 'error'], 500);

    }

    public function delete(Request $request)
    {
        $product_id = $request->input('product');
        $product = Product::find($product_id);
        if ($product->delete()) {
            return response(['message' => 'success'], 200);
        }
        return response(['message' => 'error'], 500);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $product = new Product();
        $product->name = $params['name'];
        $product->price = $params['price'];
        $product->colors = $params['colors'];
        $product->sale_off = $params['sale_off'];
        $product->discount = $params['discount'];
        $product->quantity = $params['quantity'];
        $product->description = $params['description'];
        $product->category_id = $params['category_id'];
        $customClaims = JWTAuth::parseToken()->getPayload();
        $product->shop_id = $customClaims['shop_id'];
        if ($product->save()) {
            return response(['message' => 'success', 'product' => $product], 200);
        }
        return response(['message' => 'error'], 500);
    }

}
