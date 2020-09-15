<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','name','description','purchase_price','sale_price','available',
        'category_id'];

}
