<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','name','description','purchase_price','sale_price','available','productimg',
        'category_id'];


    /**
     * Get the category of a product.
     */
    public function categoria()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
