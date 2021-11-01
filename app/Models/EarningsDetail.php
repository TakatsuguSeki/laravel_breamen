<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EarningsDetail extends Model
{
    use Sortable;

    //テーブル名
    protected $table = 'earnings_detail';

    //可変項目
    protected $fillable =
    [
        'earnings_id',
        'product_id',
        'name',
        'price',
        'num',
    ];
}
