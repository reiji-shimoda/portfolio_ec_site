<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadImage;

class UploadImageController extends Controller
{
    function upload(Request $request)
    {
        $request->validate([
			'image' => 'required|file|image|mimes:png,jpeg'
		]);
		$upload_image = $request->file('image');
	
		if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('uploads',"public");
			//画像の保存に成功したらDBに記録する
			if($path){
				UploadImage::create([
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path,
                    "name" => $request->name,
                    "price" => $request->price,
                    "description" => $request->description,
                    "stock" => $request->stock,
                    "seller_id" => $request->seller_id
				]);
			}
		}
		return view("/upload_success");
    }
}
