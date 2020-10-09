<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $casts=['color' => 'array', 'size' => 'array'];
    protected $fillable = ['name', 'price', 'quantity', 'sale', 'color', 'size', 'category_id'];
    

}
