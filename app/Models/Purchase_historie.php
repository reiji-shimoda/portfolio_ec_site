<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_historie extends Model
{
    protected $fillable = ["file_path", "name", "price", "volume", "seller_id", "buyer_id"];
}
