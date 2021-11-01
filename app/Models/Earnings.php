<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Earnings extends Model
{
    use Sortable;

    //テーブル名
    protected $table = 'earnings';

    //可変項目
    protected $fillable =
    [
        'date',
        'create_user',
        'update_user',
        'created_at',
        'updated_at',
        'delete_flg',
    ];

    public $sortable =[
        'date',
    ];
}
