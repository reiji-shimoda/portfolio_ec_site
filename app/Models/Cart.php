<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ["file_path", "name", "price", "count", "upload_images_id", "seller_id", "buyer_id"];
}
