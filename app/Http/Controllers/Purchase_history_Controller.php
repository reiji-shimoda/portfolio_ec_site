<?php

namespace App\Http\Controllers;
use App\Models\Purchase_history;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Purchase_history_Controller extends Controller
{
    public function index()
    {
        $purchaseHistoryItems = DB::table('purchase_histories')->get();
        //表示件数制限用
        $counter = 1;

        return view('purchase_history', compact('purchaseHistoryItems', 'counter'));
    }
}
