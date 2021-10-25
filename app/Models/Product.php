<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //テーブル名
    protected $table = 'product';

    //可変項目
    protected $fillable =
    [
        'product_category_id',
        'name',
        'description',
        'price',
        'img',
        'turn',
        'create_user',
        'update_user',
        'created_at',
        'updated_at',
        'delete_flg',
    ];
}
