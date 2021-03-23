<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $fillable = ["file_name", "file_path", "name", "price", "description", "stock", "seller_id"];
}
