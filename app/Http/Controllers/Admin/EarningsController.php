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
    private $formItems = ['date', 'id', 'earnings_id', 'product_id', 'num'];

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
     * セッションに情報を保存する
    */
    public function earningsAddPost(Request $request)
    {
        $input = $request->only($this->formItems);
        //セッションへの書き込み
        $request->session()->put('form_input', $input);

        return redirect(route('earningsConfirm'));
    }

    /**
     * 売上編集画面を表示する
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
    /**
     * セッションに情報を保存する
    */
    public function earningsEditPost(Request $request)
    {
        $input = $request->only($this->formItems);

        //セッションへの書き込み
        $request->session()->put('form_input', $input);

        return redirect(route('earningsConfirm'));
    }

    /**
     * 確認画面を表示する
    */
    public function earningsConfirm(Request $request)
    {
        //セッションから取得
        $user_id = Auth::id();
        $input = $request->session()->get('form_input');

        $product = Product::where('id', '=', $input['product_id'])->get();

        return view('earnings.earnings_confirm',['input' => $input, 'product' => $product, 'user_id' => $user_id]);
    }

    /**
     * 売上を新規登録する
    */
    public function earningsStore(Request $request)
    {
        //セッションから取得
        $input = $request->session()->get('form_input');

        //セッションの情報をDBに登録
        \DB::beginTransaction();
        try {
            //売上を登録
            Earnings::create($input);
            //売上詳細を登録
            //ここには上記登録したのちのearnings_id(id)をもとに登録する。
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
        //セッションを空にする
        $request->session()->forget("form_input");

        \Session::flash('err_msg', '売上を登録しました。');
        return redirect(route('earningsList'));
    }

    /**
     * 更新する
    */
    public function earningsUpdate(Request $request)
    {
        //セッションから取得
        $input = $request->session()->get('form_input');
        //古い情報があれば削除

        //セッションの情報をDBに登録
        \DB::beginTransaction();
        try {
            //売上を登録
            Earnings::create($input);
            //売上詳細を登録
            //ここには上記登録したのちのearnings_id(id)をもとに登録する。
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
        //セッションを空にする
        $request->session()->forget("form_input");

        \Session::flash('err_msg', '売上を更新しました。');
        return redirect(route('earningsList'));
    }
}
