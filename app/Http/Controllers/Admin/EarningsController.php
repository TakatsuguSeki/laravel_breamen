<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EarningsController extends Controller
{
    /**
     * @return View
    */
    public function earningsList()
    {
        return view('earnings.earnings_list');
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
