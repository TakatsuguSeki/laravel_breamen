<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\EarningsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    //ログインフォーム表示
    Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
    //ログイン処理
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    //ホーム画面
    Route::get('home', function() {
        return view('home');
    })->name('home');
    //ログアウト
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

//商品管理画面
//商品一覧
Route::get('product_list', [ProductController::class, 'productList'])->name('productList');
//商品登録画面
Route::get('product_list/add', [ProductController::class, 'productAdd'])->name('add');
//商品登録
Route::post('product_list/store', [ProductController::class, 'productStore'])->name('store');
//商品詳細
Route::get('product_list/{id}', [ProductController::class, 'productDetail'])->name('productDetail');
//商品編集
Route::get('product_list/edit/{id}', [ProductController::class, 'productEdit'])->name('productEdit');
Route::post('product_list/update', [ProductController::class, 'productUpdate'])->name('update');
//商品削除
Route::post('product_list/delete/{id}', [ProductController::class, 'productDelete'])->name('delete');

//売上管理画面
//売上一覧
Route::get('earnings_list', [EarningsController::class, 'earningsList'])->name('earningsList');
//売上登録・編集
Route::post('earnings_edit', [EarningsController::class, 'earningsEdit'])->name('earningsEdit');
//登録・編集確認
Route::post('earnings_conf', [EarningsController::class, 'earningsConf'])->name('earningsConf');
//登録・編集完了
Route::post('earnings_done', [EarningsController::class, 'earningsDone'])->name('earningsDone');
