<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopStaff extends Model
{

    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['deleted_at'];

    public function staffLevel()
    {
        return $this->belongsTo('\App\Models\StaffLevel', 'level');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo('\App\Models\Shop', 'shop_id');
    }

    public function getMenuItems()
    {
        $menuItems = MenuItem::where('level', '>=', $this->level)->get(['name', 'position', 'router_name','fa_icon']);
        return $menuItems;
    }
}
