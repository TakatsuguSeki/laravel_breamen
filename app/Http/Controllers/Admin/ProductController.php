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
                ->sortable()
                ->get();
        return view('product.product_list', ['products' => $products]);
    }
    /**
     * 商品詳細を表示する
     * @param int $id
     * @return View
    */
    public function productDetail($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('productList'));
        }
        return view('product.product_detail', ['product' => $product]);
    }
    /**
     * 商品登録画面を表示する
     * @return View
    */
    public function productAdd()
    {
        return view('product.form');
    }
    /**
     * 商品を登録する
     * @return View
    */
    public function productStore(Request $request)
    {
        dd($request->all());
        Product::create();
        \Session::flash('err_msg', 'ブログを登録しました。');
        return redirect(route('productList'));
    }
    public function productConf()
    {

    }
    public function productDone()
    {

    }
}
