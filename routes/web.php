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
//売上登録画面
Route::get('earnings_list/add', [EarningsController::class, 'earningsAdd'])->name('earningsAdd');
Route::post('earnings_list/add', [EarningsController::class, 'earningsAddPost'])->name('addPost');
//売上編集画面
Route::get('earnings_list/edit/{id}', [EarningsController::class, 'earningsEdit'])->name('earningsEdit');
Route::post('earnings_list/edit', [EarningsController::class, 'earningsEditPost'])->name('editPost');
//登録・編集確認画面
Route::get('earnings_list/confirm', [EarningsController::class, 'earningsConfirm'])->name('earningsConfirm');
Route::post('earnings_list/confirm', [EarningsController::class, 'earningsSave'])->name('earningsSave');

//売上登録
Route::post('earnings_list/store', [EarningsController::class, 'earningsStore'])->name('store');

//売上編集
Route::post('earnings_list/update', [EarningsController::class, 'earningsUpdate'])->name('update');

//商品削除
//Route::post('earnings_list/delete/{id}', [EarningsController::class, 'productDelete'])->name('delete');
