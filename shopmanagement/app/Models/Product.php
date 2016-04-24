<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];

    public function images()
    {
        return $this->hasMany('\App\Models\ProductImages', 'product_id');
    }

    public static function listByShop($shop_id, $limit, $search)
    {
        $query = Product::where('shop_id', $shop_id);

        if (isset($limit)) {
            if (isset($search) && $search != '') {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
            $paginate = $query->paginate($limit);
            foreach ($paginate as $key => $val) {
                $val->images;
            }
            return $paginate;
        } else {
            return $query->get()->images;
        }

    }

    public static function listByCategory($cate_id, $limit, $search)
    {
        $query = Product::where('category_id', $cate_id);
        if (isset($limit)) {
            if (isset($search) && $search != '') {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
            return $query->paginate($limit);
        }
        return $query->get();
    }
}
