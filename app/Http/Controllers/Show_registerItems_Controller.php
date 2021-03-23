<?php

namespace App\Http\Controllers;

use App\Models\UploadImage;
use App\Models\Admin;
use App\Models\Purchase_history;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class Show_registerItems_Controller extends Controller
{
    public function index(Request $request)
    {
        $items = DB::table('upload_images')->get();

        return view('show_registerItems', compact('items'));
    }

    public function adminindex()
    {
        return view('admin');
    }

    public function purchase_notiflcation()
    {
        $items = DB::table('purchase_histories')->get();
        $users = DB::table('users')->get();

        return view('purchase_notiflcation', compact('items', 'users'));
    }
}
