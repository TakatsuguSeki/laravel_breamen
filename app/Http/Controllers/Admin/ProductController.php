<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

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
        $user_id = Auth::id();
        $product_category = ProductCategory::where('delete_flg', 0)->get();
        return view('product.form', ['product_category' => $product_category, 'user_id' => $user_id]);
    }

    /**
     * 商品を登録する
     * @return View
    */
    public function productStore(ProductRequest $request)
    {
        //商品のデータを受け取る
        $inputs =$request->all();

        \DB::beginTransaction();
        try {
            //商品を登録
            Product::create($inputs);
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', '商品を登録しました。');
        return redirect(route('productList'));
    }

    /**
     * 商品編集画面を表示する
     * @param int $id
     * @return View
    */
    public function productEdit($id)
    {
        $user_id = Auth::id();
        $product_category = ProductCategory::where('delete_flg', 0)->get();
        $product = Product::find($id);

        if (is_null($product)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('productList'));
        }
        return view('product.edit', ['product' => $product, 'product_category' => $product_category, 'user_id' => $user_id]);
    }

    /**
     * 商品を更新する
     * @return View
    */
    public function productUpdate(ProductRequest $request)
    {
        //商品のデータを受け取る
        $inputs =$request->all();

        \DB::beginTransaction();
        try {
            //商品を更新
            $product = Product::find($inputs['id']);
            $product->fill([
                'name' => $inputs['name'],
                'product_category_id' => $inputs['product_category_id'],
                'price' => $inputs['price'],
                'description' => $inputs['description'],
                'update_user' => $inputs['update_user'],
            ]);
            $product->save();
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg', '商品を更新しました。');
        return redirect(route('productList'));
    }

    /**
     * 商品削除
     * @param int $id
     * @return View
    */
    public function productDelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('productList'));
        }

        try {
            $product = Product::find($id);
            $product->fill([
                'delete_flg' => 1,
            ]);
            $product->save();
        } catch (\Throwable $e) {
            abort(500);
        }

        \Session::flash('err_msg', '削除しました。');
        return redirect(route('productList'));
    }
}
