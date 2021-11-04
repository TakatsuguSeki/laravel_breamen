<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Earnings;
use App\Models\EarningsDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EarningsController extends Controller
{
    /**
     * 売上一覧を表示する
     *
     * @return View
    */
    public function earningsList()
    {
        $earnings = DB::select("SELECT earnings_detail.earnings_id as id, earnings.date, SUM(num) as totalnum , SUM(num * price) as totalprice FROM earnings_detail INNER JOIN earnings ON earnings_detail.earnings_id = earnings.id WHERE DATE_FORMAT(earnings.date, '%Y-%m') = '2021-10' GROUP BY earnings_detail.earnings_id, earnings.date ORDER BY earnings.date DESC");
        return view('earnings.earnings_list', ['earnings' => $earnings]);
    }
    /**
     * 売上登録画面を表示する
     * @return View
    */
    public function earningsAdd()
    {
        $user_id = Auth::id();
        $products = Product::where('delete_flg', 0)->get();
        return view('earnings.earnings_form', ['products' => $products, 'user_id' => $user_id]);
    }
    /**
     * 商品編集画面を表示する
     * @param int $id
     * @return View
    */
    public function earningsEdit($id)
    {
        //セレクトボックス用商品取得
        $products = Product::where('delete_flg', 0)->get();
        $earnings = Earnings::find($id);
        $earnings_detail = EarningsDetail::where('earnings_id', '=', $id)->get();
        $user_id = Auth::id();

        if (is_null($earnings)) {
            \Session::flash('err_msg', 'データがありません。');
            return redirect(route('earningsList'));
        }
        return view('earnings.earnings_edit', ['products' => $products, 'earnings' => $earnings, 'earnings_detail' => $earnings_detail, 'user_id' => $user_id]);
    }
}
