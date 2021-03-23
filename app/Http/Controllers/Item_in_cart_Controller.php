<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Purchase_historie;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Item_in_cart_Controller extends Controller
{
    //カート入れるボタン
    public function item_in_cart(Request $request)
    {
        $item = DB::table('upload_images')->find($request->id);
        //在庫計算
        $stockCalculation = $item->stock - $request->count;
        Cart::create([
			"file_path" => $request->path,
            "name" => $request->name,
            "price" => $request->price,
            "count" => $request->count,
            "upload_images_id" =>$request->id,
            "buyer_id" =>$request->user_id,
            "seller_id" =>$item->seller_id,
        ]);
        
        //在庫更新
        DB::table('upload_images')->where('id', $request->id)
            ->update([
                "stock" => $stockCalculation,
            ]);

        return redirect('home');  
    }

    public function item_purchase(Request $request)
    {
        //購入ボタン
        if(isset($_POST['purchase_button']))
        {
            $cartInItems = DB::table('carts')->get();
            foreach($cartInItems as $cartInItem)
            {
                $totalPrice = $cartInItem->price * $cartInItem->count;

                Purchase_historie::create([
                    "file_path" => $cartInItem->file_path,
                    "name" => $cartInItem->name,
                    "price" => $totalPrice,
                    "volume" => $cartInItem->count,
                    "buyer_id" =>$cartInItem->buyer_id,
                    "seller_id" =>$cartInItem->seller_id,
                ]);
            }
                
            //cartの中をすべて削除する
            Cart::query()->delete();

            return view('purchase_success');
        }
        //削除ボタン
        else if(isset($_POST['empty_button']))
        {
            $cartInItem = DB::table('carts')->find($request->id);
            $item = DB::table('upload_images')->find($cartInItem->upload_images_id);
            //在庫計算
            $stockCalculation = $item->stock + $cartInItem->count;

            DB::table('upload_images')->where('id', $cartInItem->upload_images_id)
                ->update([
                    "stock" => $stockCalculation,
                ]);

            //ボタンを押した商品のcartデータを削除する
            Cart::where('id', $request->id)->delete();

            return redirect('purchase');
        }

        
    }

    public function cart_click()
    {
        $cartInItems = DB::table('carts')->get();
        //合計金額用変数
        $totalAmount = 0;
        return view('purchase', compact('cartInItems', 'totalAmount'));
    }

}
