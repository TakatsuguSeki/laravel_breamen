<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Earnings;
use App\Models\EarningsDetail;
use Illuminate\Support\Facades\DB;


class EarningsController extends Controller
{
    /**
     * 商品一覧を表示する
     *
     * @return View
    */
    public function earningsList()
    {
        $earnings = DB::select("SELECT earnings_detail.earnings_id as id, earnings.date, SUM(num) as totalnum , SUM(num * price) as totalprice FROM earnings_detail INNER JOIN earnings ON earnings_detail.earnings_id = earnings.id WHERE DATE_FORMAT(earnings.date, '%Y-%m') = '2021-10' GROUP BY earnings_detail.earnings_id, earnings.date");
        return view('earnings.earnings_list', ['earnings' => $earnings]);
    }
    public function earningsEdit()
    {

    }
    public function earningsConf()
    {

    }
    public function earningsDone()
    {

    }
}
