<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //adminで登録したデータを取り出す
        $items = DB::table('upload_images')->get();
        //カートにはいっているデータ
        $cartItem = DB::table('carts')->get();
        $cartItemCount = DB::table('carts')->count();
        //在庫がすべてないか確認する用の変数
        $count = 0;

        return view('home', compact('items', 'cartItem', 'cartItemCount', 'count'));
    }
}
