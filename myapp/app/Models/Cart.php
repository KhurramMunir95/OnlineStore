<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{   
    protected $fillable=['color', 'size', 'quantity', 'price' , 'product_id', 'user_id'];
}
