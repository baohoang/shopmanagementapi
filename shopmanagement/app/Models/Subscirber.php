<?php

namespace App\Models;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Subscirber extends Model
{
    //
    use SoftDeletes;
    protected $table = 'subscriber';
    protected $hidden = ['created_at', 'updated_at'];


}
