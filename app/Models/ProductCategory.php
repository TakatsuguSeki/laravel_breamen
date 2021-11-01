<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //テーブル名
    protected $table = 'product_category';

    //可変項目
    protected $fillable =
    [
        'name',
        'img',
        'turn',
        'create_user',
        'update_user',
        'created_at',
        'updated_at',
        'delete_flg',
    ];
}
