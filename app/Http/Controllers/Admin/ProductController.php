<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * 商品一覧を表示する
     *
     * @return View
    */
    public function productList()
    {
        $products = Product::where('delete_flg', 0)
                ->orderBy('id', 'desc')
                ->get();
        return view('product.product_list', ['products' => $products]);
    }
    public function productEdit()
    {

    }
    public function productConf()
    {

    }
    public function productDone()
    {

    }
}
